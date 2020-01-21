<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChurchClass extends Model
{
    protected  $guarded =[];
    
    public function teachers(){
  
        return $this->hasOne('App\Teacher');
    }   

}
