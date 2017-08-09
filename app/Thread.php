<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id'
    ];

    /**
     * return the path for this model with the id of the thread
     * example: http://forum.app/threads/24
     * @return string
     */
    public function path()
    {
        return '/threads/' . $this->id;
    }

    /**
     * a thread belongs to a user (creator)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * a thread has many replies
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }
}
