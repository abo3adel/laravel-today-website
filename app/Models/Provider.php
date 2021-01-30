<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    use HasFactory;
    use sluggable;

    const PENDING = 0;
    const APPROVED = 1;
    const Rejected = 2;

    public $timestamps = false;

    protected $guarded = [];

    protected $hidden = [
        'id',
        'user_id',
        'status',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            "slug" => [
                "source" => "title",
            ],
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * get image_url or default image if not present
     *
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        return is_null($this->image) || empty($this->image)
            ? "https://images.test/users/8.jpg"
            : $this->image;
    }

    public function isPending(): bool
    {
        return $this->status === self::PENDING;
    }

    public function isRejected(): bool
    {
        return $this->status === self::Rejected;
    }

    public function isApproved(): bool
    {
        return $this->status === self::APPROVED;
    }

    public function setStatus(int $status): bool
    {
        return $this->update(compact('status'));
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'provider_slug', 'slug');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
