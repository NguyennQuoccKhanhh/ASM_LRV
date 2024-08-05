<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'catelogue_id',
        'title',
        'slug',
        'sku',
        'image_post',
        'description',
        'content',
        'view',
        'is_show_home',
        'published_at',
    ];

    protected $casts = [
        'is_show_home' => 'boolean',
    ];
    public function catelogue()
    {
        return $this->belongsTo(Catelogue::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Carbon::parse($value)->format('d/m/Y H:i:s'),
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Carbon::parse($value)->format('d/m/Y H:i:s'),
        );
    }
    public function scopeSearchByTitle($query, $title)
    {
        return $query->where('title', 'LIKE', "%{$title}%");
    }
}
