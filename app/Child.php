<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Child extends Model
{
    protected $table = 'children';
    protected $guarded  = [];

    public function guardians()
    {
        return $this->belongsToMany('App\Guardian', 'children_guardians', 'child_id', 'guardian_id')
        ->withPivot('relationship');
    }
}
