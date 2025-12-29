<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ForumCategory;
use App\Models\User;
use App\Models\ForumPost;

class ForumThread extends Model
{
    protected $table = 'forum_thread';

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'content',
        'date_created'
    ];

    protected $casts = [
        'date_created' => 'datetime',
    ];

    /* =========================
       Relationships
       ========================= */

    public function category()
    {
        return $this->belongsTo(ForumCategory::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function posts()
    {
        return $this->hasMany(ForumPost::class, 'thread_id');
    }
}
