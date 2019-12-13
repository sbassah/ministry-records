<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Guardian extends Model
{
    protected $guarded  = [];

    public function children()
    {
        return $this->belongsToMany('App\Child', 'children_guardians', 'guardian_id', 'child_id')
        ->withPivot('relationship');
    }
}
