<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>New Lead Notification</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #F8F9F6; margin: 0; padding: 24px; color: #1F241B;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 16px; border: 1px solid #E7E9E2; overflow: hidden;">
        <tr>
            <td style="padding: 24px 32px; background-color: #23271D; color: #ffffff;">
                @php $agencyName = \App\Models\SiteSetting::current()->agency_name ?? 'VackLink'; @endphp
                <h1 style="margin: 0; font-size: 20px; font-weight: 700; letter-spacing: -0.5px;">{{ $agencyName }} • New Inquiry</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 32px;">
                <p style="font-size: 15px; line-height: 1.6; margin-top: 0;">
                    You have received a new prospective client inquiry from the portfolio platform:
                </p>

                <table width="100%" border="0" cellspacing="0" cellpadding="8" style="background: #F8F9F6; border-radius: 12px; margin: 20px 0; font-size: 14px;">
                    <tr>
                        <td width="30%" style="font-weight: 600; color: #666C5E;">Sender Name:</td>
                        <td style="font-weight: 700; color: #1F241B;">{{ $inquiry->name }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #666C5E;">Work Email:</td>
                        <td><a href="mailto:{{ $inquiry->email }}" style="color: #444B39; font-weight: 600;">{{ $inquiry->email }}</a></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #666C5E;">Service Scope:</td>
                        <td style="color: #1F241B;">{{ $inquiry->service_type ?: 'General Discovery' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #666C5E;">Budget Range:</td>
                        <td style="color: #1F241B;">{{ $inquiry->budget_range ?: 'Not specified' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #666C5E;">IP Address:</td>
                        <td style="color: #666C5E;">{{ $inquiry->ip_address ?: 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #666C5E;">Submitted At:</td>
                        <td style="color: #666C5E;">{{ $inquiry->created_at->format('M d, Y - h:i A') }}</td>
                    </tr>
                </table>

                <h3 style="font-size: 15px; margin: 24px 0 8px 0; color: #1F241B;">Project Details & Message:</h3>
                <div style="background: #ffffff; border-left: 3px solid #23271D; padding: 12px 16px; font-size: 14px; line-height: 1.6; color: #374151; white-space: pre-wrap;">
{{ $inquiry->message }}
                </div>

                <div style="margin-top: 32px; text-align: center;">
                    <a href="mailto:{{ $inquiry->email }}?subject=Re:%20{{ rawurlencode($agencyName) }}%20Project%20Discovery" style="display: inline-block; background-color: #23271D; color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 600; padding: 12px 28px; border-radius: 9999px;">
                        Reply to {{ $inquiry->name }}
                    </a>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
