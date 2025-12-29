<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ForumThread;

class ForumCategory extends Model
{
    protected $table = 'forum_category';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'date_created'
    ];

    protected $casts = [
        'date_created' => 'datetime',
    ];

    public function threads()
    {
        return $this->hasMany(ForumThread::class, 'category_id');
    }
}
