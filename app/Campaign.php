<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $dates = [
        'send_time'
    ];

    /**
     * Get the list info
     */
    public function list()
    {
        return $this->hasOne(MemberList::class, 'id', 'list_id');
    }
}
