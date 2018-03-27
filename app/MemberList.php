<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberList extends Model
{
    /**
     * Get the list members
     */
    public function members()
    {
        return $this->hasMany(ListMember::class, 'list_id');
    }
}
