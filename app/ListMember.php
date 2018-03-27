<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListMember extends Model
{
    /**
     * Get the member info
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    /**
     * Get the list info
     */
    public function list()
    {
        return $this->belongsTo(MemberList::class, 'list_id');
    }
}
