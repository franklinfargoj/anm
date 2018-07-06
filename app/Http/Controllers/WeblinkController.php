<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\PhcTranslationModel;
use App\DistrictModel;

use App\AnmDetailsModel;

class WeblinkController extends Controller
{

    public function index($id)
    {
        $anm_target_data = AnmTargetDataModel::select('district','phc_name','moic_name','moic_mobile_number','anm_name',
                                                'anm_mobile_number','performer_category','scenerio')
                                                ->where('weblink',$id)
                                                ->get()
                                                ->toArray();

        $phc_hindi = PhcTranslationModel::where('phc_name',$anm_target_data[0]['phc_name'])
                                ->pluck('phc_translation','phc_name')->toArray();


        $district_id = DistrictModel::select('id')
                            ->where('district_name',$anm_target_data[0]['district'])
                            ->get()
                            ->toArray();

        $anm_detail =  AnmDetailsModel::where('district_id',$district_id[0]['id'])
                            ->pluck('anm_translation','anm_name')->toArray();

        $lstAnmCategory = array();

        foreach ($anm_target_data as $value){
            if(array_key_exists($value['phc_name'],$phc_hindi)){
                $value['phc_name'] = $phc_hindi[$value['phc_name']];
            }else{
                $value['phc_name'] = 'test';
            }

            if( strpos($value['anm_name'], ',') !== false ) {
                $multipleAnms = explode(',',$value['anm_name']);
                $anmArray = array();
                foreach($multipleAnms as $anm){
                    if(array_key_exists($anm,$anm_detail)){
                        $anmName = $anm_detail[$anm];
                    }else{
                        $anmName = $anm;
                    }
                    $anmArray[] = $anmName;
                }
                $value['anm_name'] = implode(',',$anmArray);
            }else{
                if(array_key_exists($value['anm_name'],$anm_detail)){
                    $value['anm_name'] = $anm_detail[$value['anm_name']];
                }else{
                    $value['anm_name'] = 'test1';
                }
            }
            $lstAnmCategory[$value['performer_category']][] = $value;
        }


        $scenario = $anm_target_data[0]['scenerio'];
        if($scenario == 1){
            $top_names = array();
            $top =array();
            $middle =array();
            $bottom =array();
            if(!empty($lstAnmCategory)) {
                foreach ($lstAnmCategory as $key => $value){
                    if($key == 'TOP'){
                        foreach ($value as $v){
                            $top[] = $v['anm_name'];
                        }
                        $top_names = implode(',',$top);
                    }


                    if($key == 'MIDDLE'){
                        foreach ($value as $v){
                            $middle[] = $v['anm_name'];
                        }
                        $middle_names = implode(',',$middle);
                    }


                    if($key == 'BOTTOM'){
                        foreach ($value as $v){
                            $bottom[] = $v['anm_name'];
                        }
                        $bottom_names = implode(',',$bottom);
                    }

                }
            }
            $count_top=count($top);
            $count_middle=count($middle);
            $count_bottom=count($bottom);

            $top_names_last = end($top);
            $top_names_except_last = rtrim($top_names,','.end($top));

            $middle_names_last = end($middle);
            $middle_names_except_last = rtrim($middle_names,','.end($middle));

            $bottom_names_last = end($bottom);
            $bottom_names_except_last = rtrim($bottom_names,','.end($bottom));

            $data = [
                'top_names_last'  => $top_names_last,
                'top_names_except_last'   => $top_names_except_last,
                'middle_names_last' => $middle_names_last,
                'middle_names_except_last' => $middle_names_except_last,
                'bottom_names_last' => $bottom_names_last,
                'bottom_names_except_last' => $bottom_names_except_last
            ];
            return view('scenerio/scenerio_1',$data);
        }

        if($scenario == 2){
            return view('scenerio/scenerio_2',compact('lstAnmCategory'));
        }
        if($scenario == 3){
            return view('scenerio/scenerio_3',compact('lstAnmCategory'));
        }
        if($scenario == 4){
            return view('scenerio/scenerio_4',compact('lstAnmCategory'));
        }
        if($scenario == 5){
            return view('scenerio/scenerio_5',compact('lstAnmCategory'));
        }
        if($scenario == 6){
            return view('scenerio/scenerio_6',compact('lstAnmCategory'));
        }
        if($scenario == 7){
            return view('scenerio/scenerio_7',compact('lstAnmCategory'));
        }
        if($scenario == 8){
            return view('scenerio/scenerio_8',compact('lstAnmCategory'));
        }

    }
}
