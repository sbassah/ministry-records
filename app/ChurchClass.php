<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChurchClass extends Model
{
    
    
    public function teachers(){
  
        return $this->hasOne('App\Teacher');
    }   

}
