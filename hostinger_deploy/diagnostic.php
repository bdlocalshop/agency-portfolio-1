<?php
// Diagnostic Test & Auto-Healer for Hostinger Deployment
header('Content-Type: text/html; charset=utf-8');

$actionMessage = null;
$actionError = null;
$envFile = __DIR__ . '/.env';

// Clear cached config if exists
$cachedConfigFound = false;
if (file_exists(__DIR__ . '/bootstrap/cache/config.php')) {
    $cachedConfigFound = true;
    @unlink(__DIR__ . '/bootstrap/cache/config.php');
}
if (file_exists(__DIR__ . '/bootstrap/cache/routes-v7.php')) {
    @unlink(__DIR__ . '/bootstrap/cache/routes-v7.php');
}

// 1. Handle Updating Database Credentials directly via form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_db'])) {
    $newHost = trim($_POST['db_host'] ?? 'localhost');
    $newDb = trim($_POST['db_database'] ?? '');
    $newUser = trim($_POST['db_username'] ?? '');
    $newPass = trim($_POST['db_password'] ?? '');

    // Test PDO connection first
    try {
        $dsn = "mysql:host={$newHost};port=3306;dbname={$newDb};charset=utf8mb4";
        $testPdo = new PDO($dsn, $newUser, $newPass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 4,
        ]);

        // If PDO succeeded, save to .env
        if (file_exists($envFile)) {
            $content = file_get_contents($envFile);
            $content = preg_replace('/^DB_HOST=.*$/m', "DB_HOST={$newHost}", $content);
            $content = preg_replace('/^DB_DATABASE=.*$/m', "DB_DATABASE={$newDb}", $content);
            $content = preg_replace('/^DB_USERNAME=.*$/m', "DB_USERNAME={$newUser}", $content);
            $content = preg_replace('/^DB_PASSWORD=.*$/m', "DB_PASSWORD=\"{$newPass}\"", $content);
            file_put_contents($envFile, $content);
            $actionMessage = "Database credentials tested successfully and updated in .env!";
        }
    } catch (\Throwable $e) {
        $actionError = "Connection failed with these credentials: " . $e->getMessage();
    }
}

// 2. Handle Auto-Fix Actions
if (isset($_GET['action'])) {
    if ($_GET['action'] === 'clear_cache') {
        @unlink(__DIR__ . '/bootstrap/cache/config.php');
        @unlink(__DIR__ . '/bootstrap/cache/routes-v7.php');
        $actionMessage = "Cleared bootstrap cache files.";
    }
}

$phpVersion = PHP_VERSION;
$phpOk = version_compare(PHP_VERSION, '8.2.0', '>=');

// Read .env
$envExists = file_exists($envFile);
$dbHost = 'localhost';
$dbPort = '3306';
$dbName = '';
$dbUser = '';
$dbPass = '';

if ($envExists) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#')) continue;
        if (str_contains($line, '=')) {
            [$key, $val] = explode('=', $line, 2);
            $key = trim($key);
            $val = trim($val, " \t\n\r\0\x0B\"'");
            if ($key === 'DB_HOST') $dbHost = $val;
            if ($key === 'DB_PORT') $dbPort = $val;
            if ($key === 'DB_DATABASE') $dbName = $val;
            if ($key === 'DB_USERNAME') $dbUser = $val;
            if ($key === 'DB_PASSWORD') $dbPass = $val;
        }
    }
}

// Check Extensions
$requiredExtensions = ['pdo', 'pdo_mysql', 'curl', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json', 'fileinfo'];
$extStatus = [];
foreach ($requiredExtensions as $ext) {
    $extStatus[$ext] = extension_loaded($ext);
}

// Check Writable Directories
$dirsToCheck = [
    'storage/logs' => __DIR__ . '/storage/logs',
    'storage/framework/views' => __DIR__ . '/storage/framework/views',
    'storage/framework/sessions' => __DIR__ . '/storage/framework/sessions',
    'storage/framework/cache/data' => __DIR__ . '/storage/framework/cache/data',
    'bootstrap/cache' => __DIR__ . '/bootstrap/cache',
];

$dirStatus = [];
foreach ($dirsToCheck as $label => $path) {
    if (!is_dir($path)) @mkdir($path, 0775, true);
    $testFile = $path . '/.perm_test_' . uniqid();
    $written = @file_put_contents($testFile, 'test');
    if ($written !== false) {
        @unlink($testFile);
        $dirStatus[$label] = true;
    } else {
        $dirStatus[$label] = false;
    }
}

// 1. Raw PDO Test
$rawPdoOk = false;
$rawPdoError = null;
$projectCount = null;

if (!empty($dbName) && !empty($dbUser)) {
    try {
        $dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";
        $pdo = new PDO($dsn, $dbUser, $dbPass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 4,
        ]);
        $rawPdoOk = true;

        $stmt = $pdo->query("SELECT count(*) as cnt FROM projects");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $projectCount = $row['cnt'] ?? 0;
    } catch (\Throwable $e) {
        $rawPdoError = $e->getMessage();
    }
}

// 2. Autoload & Laravel App Boot
$autoloadOk = false;
$appOk = false;
$laravelDbOk = false;
$laravelDbError = null;
$siteSettingOk = false;
$siteSettingDetails = null;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
    $autoloadOk = true;

    if (file_exists(__DIR__ . '/bootstrap/app.php')) {
        try {
            $app = require __DIR__ . '/bootstrap/app.php';
            $appOk = is_object($app);

            // Test Laravel's DB Connection
            try {
                $db = $app->make('db');
                $db->connection()->getPdo();
                $laravelDbOk = true;

                // Test SiteSetting Query (Exact query from HomeController)
                try {
                    $setting = \App\Models\SiteSetting::current();
                    $siteSettingOk = true;
                    $siteSettingDetails = $setting->agency_name . ' - ' . $setting->hero_headline;
                } catch (\Throwable $st) {
                    $laravelDbError = "SiteSetting query failed: " . $st->getMessage();
                }
            } catch (\Throwable $de) {
                $laravelDbError = $de->getMessage();
            }
        } catch (\Throwable $ae) {
            $appError = $ae->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server & Database Diagnostics</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #0f172a; color: #f8fafc; padding: 30px 20px; }
        .container { max-width: 840px; margin: 0 auto; background: #1e293b; border-radius: 12px; padding: 24px; border: 1px solid #334155; box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
        h1 { margin-top: 0; color: #38bdf8; font-size: 24px; border-bottom: 1px solid #334155; padding-bottom: 12px; }
        .item { display: flex; justify-content: space-between; align-items: center; padding: 12px; border-bottom: 1px solid #334155; }
        .badge { padding: 4px 10px; border-radius: 6px; font-weight: 600; font-size: 13px; }
        .badge-ok { background: #166534; color: #bbf7d0; }
        .badge-fail { background: #991b1b; color: #fecaca; }
        .notice-box { padding: 14px; border-radius: 8px; margin: 16px 0; font-size: 14px; }
        .notice-success { background: #064e3b; color: #a7f3d0; border: 1px solid #059669; }
        .notice-error { background: #450a0a; color: #fecaca; border: 1px solid #dc2626; }
        code { background: #334155; padding: 2px 6px; border-radius: 4px; color: #f1f5f9; font-size: 13px; }
        a.btn, button.btn { display: inline-block; background: #0284c7; color: white; text-decoration: none; padding: 10px 18px; border-radius: 6px; font-weight: 600; font-size: 14px; border: none; cursor: pointer; }
        a.btn:hover, button.btn:hover { background: #0369a1; }
        .form-card { background: #0f172a; border: 1px solid #334155; border-radius: 8px; padding: 18px; margin-top: 20px; }
        .form-group { margin-bottom: 12px; }
        .form-group label { display: block; font-size: 13px; color: #94a3b8; margin-bottom: 4px; font-weight: 600; }
        .form-group input { width: 100%; box-sizing: border-box; background: #1e293b; border: 1px solid #475569; color: white; padding: 8px 12px; border-radius: 6px; font-size: 14px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Hostinger Database & Laravel Diagnostics</h1>

    <?php if ($actionMessage): ?>
    <div class="notice-box notice-success">
        <strong>Success:</strong> <?= htmlspecialchars($actionMessage) ?>
    </div>
    <?php endif; ?>

    <?php if ($actionError): ?>
    <div class="notice-box notice-error">
        <strong>Error:</strong> <?= htmlspecialchars($actionError) ?>
    </div>
    <?php endif; ?>

    <!-- 1. DATABASE STATUS -->
    <h2 style="font-size: 18px; color: #38bdf8; margin-top: 20px;">1. Database Connection Status</h2>

    <div class="item">
        <div>
            <strong>Direct PDO Connection</strong>
            <div style="font-size: 13px; color: #94a3b8;">User: <code><?= htmlspecialchars($dbUser) ?></code> | DB: <code><?= htmlspecialchars($dbName) ?></code></div>
        </div>
        <span class="badge <?= $rawPdoOk ? 'badge-ok' : 'badge-fail' ?>"><?= $rawPdoOk ? 'CONNECTED' : 'FAILED' ?></span>
    </div>
    <?php if ($rawPdoError): ?>
    <div class="notice-box notice-error"><strong>PDO Error:</strong> <?= htmlspecialchars($rawPdoError) ?></div>
    <?php endif; ?>

    <div class="item">
        <div>
            <strong>Laravel Query Builder & Eloquent Connection</strong>
            <div style="font-size: 13px; color: #94a3b8;">Tested via <code>DB::connection()->getPdo()</code></div>
        </div>
        <span class="badge <?= $laravelDbOk ? 'badge-ok' : 'badge-fail' ?>"><?= $laravelDbOk ? 'CONNECTED' : 'FAILED' ?></span>
    </div>
    <?php if ($laravelDbError): ?>
    <div class="notice-box notice-error"><strong>Laravel Error:</strong> <?= htmlspecialchars($laravelDbError) ?></div>
    <?php endif; ?>

    <div class="item">
        <div>
            <strong>Site Settings Table (Homepage Query)</strong>
            <div style="font-size: 13px; color: #94a3b8;"><?= $siteSettingOk ? htmlspecialchars((string)$siteSettingDetails) : 'Testing `SiteSetting::current()`' ?></div>
        </div>
        <span class="badge <?= $siteSettingOk ? 'badge-ok' : 'badge-fail' ?>"><?= $siteSettingOk ? 'LOADED' : 'FAILED' ?></span>
    </div>

    <!-- 2. QUICK CREDENTIAL UPDATE FORM -->
    <div class="form-card">
        <h3 style="margin-top: 0; font-size: 16px; color: #38bdf8;">Verify or Update Database Credentials (.env)</h3>
        <p style="font-size: 13px; color: #94a3b8; margin-bottom: 14px;">
            If Laravel reports "Access denied", check your MySQL password below. You can test and save directly:
        </p>
        <form method="POST">
            <input type="hidden" name="update_db" value="1">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                <div class="form-group">
                    <label>DB_HOST</label>
                    <input type="text" name="db_host" value="<?= htmlspecialchars($dbHost) ?>" required>
                </div>
                <div class="form-group">
                    <label>DB_DATABASE</label>
                    <input type="text" name="db_database" value="<?= htmlspecialchars($dbName) ?>" required>
                </div>
                <div class="form-group">
                    <label>DB_USERNAME</label>
                    <input type="text" name="db_username" value="<?= htmlspecialchars($dbUser) ?>" required>
                </div>
                <div class="form-group">
                    <label>DB_PASSWORD</label>
                    <input type="text" name="db_password" value="<?= htmlspecialchars($dbPass) ?>" placeholder="Enter MySQL Password" required>
                </div>
            </div>
            <button type="submit" class="btn" style="margin-top: 10px;">Test & Save to .env</button>
        </form>
    </div>

    <!-- 3. HOMEPAGE LINK -->
    <div style="margin-top: 30px; text-align: center;">
        <a href="/" class="btn" style="padding: 12px 28px; font-size: 16px;">&larr; Open Homepage (index.php)</a>
    </div>
</div>
</body>
</html>
