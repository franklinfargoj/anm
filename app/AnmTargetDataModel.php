<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnmTargetDataModel extends Model
{
    protected $table = "anm_target_data";
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function block(){
    	return $this->hasOne('App\Block', 'id', 'block');
    }

    public function district()
    {
    	return $this->hasOne('App\District', 'id', 'district');
    }
}
