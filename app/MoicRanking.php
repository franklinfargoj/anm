<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoicRanking extends Model
{
    protected $table = "moic_ranking";
    protected $primaryKey = 'id';
    protected $fillable = ['block','phc_en','phc_hin','dr_name_en','dr_name_hin','mobile','email','scenerio','uploaded_file','ranking_pdf'];
}
