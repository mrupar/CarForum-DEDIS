<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ForumThread;
use App\Models\User;

class ForumPost extends Model
{
    protected $table = 'forum_post';

    public $timestamps = false;

    protected $fillable = [
        'thread_id',
        'author_id',
        'content',
        'date_created'
    ];

    protected $casts = [
        'date_created' => 'datetime',
    ];

    /* =========================
       Relationships
       ========================= */

    public function thread()
    {
        return $this->belongsTo(ForumThread::class, 'thread_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
