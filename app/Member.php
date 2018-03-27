<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * Get the member lists
     */
    public function lists()
    {
        return $this->hasMany(ListMember::class, 'member_id');
    }
}
