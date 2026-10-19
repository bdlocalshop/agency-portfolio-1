<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'new';
    public const STATUS_CONTACTED = 'contacted';
    public const STATUS_ARCHIVED = 'archived';
    public const STATUS_CLOSED = 'closed';

    protected $fillable = [
        'name',
        'email',
        'service_type',
        'budget_range',
        'message',
        'ip_address',
        'status',
    ];

    /**
     * Scope for new / unread inquiries.
     */
    public function scopeNew($query)
    {
        return $query->where('status', self::STATUS_NEW);
    }

    /**
     * Scope for ordered inquiries.
     */
    public function scopeRecent($query)
    {
        return $query->orderByDesc('created_at');
    }
}
