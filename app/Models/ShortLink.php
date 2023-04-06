<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShortLink extends Model
{
    use HasFactory;

    protected $table = 'shortlinks';

    protected $fillable = ['url','short_url','user_id', 'expiry_at'];

    protected $casts = [
        'expiry_at' => 'datetime'
    ];

    /**
     * Get the user that owns the link.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the short link with domain
     */
    protected function fullUrl(): Attribute
    {
        dd('testing');
        return Attribute::make(
            get: fn (string $value, array $attributes) => 'http://localhost/' . $attributes['short_url'],
        );
    }

    public static function cleanExpiredShortLinks()
    {
        $expiredLinks = ShortLink::where('expires_at', '<=', now())->get();
        foreach ($expiredLinks as $link) {
            $link->delete();
        }
    }
}
