<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\PhcTranslationModel;
use App\DistrictModel;

use App\AnmDetailsModel;
use Illuminate\Support\Facades\DB;

class WeblinkController extends Controller
{

    public function index($id)
    {
        $anm_target_data = AnmTargetDataModel::select('district','phc_name','moic_name','moic_mobile_number','anm_name',
                                                'anm_mobile_number','performer_category','scenerio')
                                                ->where('weblink',$id)
                                                ->get()
                                                ->toArray();


        $month_details = DB::table('master_months')
            ->pluck('month_translated', 'month_english')->toArray();

        $current_month = date('F');

        if(array_key_exists($current_month, $month_details))
        {
            $current_month = $month_details[$current_month];
        }

        $next_month = date('F',strtotime('first day of +1 month'));

        if(array_key_exists($next_month, $month_details))
        {
            $next_month = $month_details[$next_month];
        }

        $targetDataVariable = array();
        $anm_moic_code = array();
        $anm_beneficiary_code = array();

        $targetDataVariable = $anm_target_data;
        $type = 'anm';

        if(empty($anm_target_data) && empty($targetDataVariable))
        {
            $anm_moic_code = AnmTargetDataModel::select('district','phc_name','moic_name','moic_mobile_number','anm_name',
                'anm_mobile_number','performer_category','scenerio')
                ->where('moic_code',$id)
                ->get()
                ->toArray();

            $type = 'moic';
            $targetDataVariable = $anm_moic_code;
        }
        if(empty($anm_moic_code) && empty($targetDataVariable)){

            $anm_beneficiary_code = AnmTargetDataModel::select('district','phc_name','moic_name','moic_mobile_number','anm_name',
                'anm_mobile_number','performer_category','scenerio')
                ->where('beneficiary_code',$id)
                ->get()
                ->toArray();
            $type = 'beneficiary';
            $targetDataVariable =  $anm_beneficiary_code;
        }
        if(empty($anm_beneficiary_code) && empty($targetDataVariable))
        {
            dd('No relevant data exists');
        }

        $phc_hindi = PhcTranslationModel::where('phc_name',$targetDataVariable[0]['phc_name'])
                                ->pluck('phc_translation','phc_name')->toArray();


        $district_id = DistrictModel::select('id')
                            ->where('district_name',$targetDataVariable[0]['district'])
                            ->get()
                            ->toArray();

        $anm_detail =  AnmDetailsModel::where('district_id',$district_id[0]['id'])
                            ->pluck('anm_translation','anm_name')->toArray();

        $lstAnmCategory = array();

        foreach ($targetDataVariable as $value){
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
                $value['anm_name'] = implode('&#93;',$anmArray);
            }else{
                if(array_key_exists($value['anm_name'],$anm_detail)){
                    $value['anm_name'] = $anm_detail[$value['anm_name']];
                }else{
                    $value['anm_name'] = 'test1';
                }
            }
            $lstAnmCategory[$value['performer_category']][] = $value;
        }

//        dd($lstAnmCategory);

        $lstData = array();

        if(!empty($lstAnmCategory['TOP'])){
            $lstData['phc_name'] = $lstAnmCategory['TOP'][0]['phc_name'];
        }
        if(!empty($lstAnmCategory['MIDDLE'])){
            $lstData['phc_name'] = $lstAnmCategory['MIDDLE'][0]['phc_name'];
        }
        if(!empty($lstAnmCategory['BOTTOM'])){
            $lstData['phc_name'] = $lstAnmCategory['BOTTOM'][0]['phc_name'];
        }

        if($type == 'anm')
        {
            foreach($lstAnmCategory as $key => $value)
            {
                foreach ($value as $anm => $details)
                {
                    if(! next($value))
                    {
                        $lstData[$key]['end'] = $details['anm_name'];
                    }
                    else
                    {
                        $lstData[$key]['anm_name'][] = $details['anm_name'];
                    }
                }
            }
        }

        if($type == 'moic')
        {
            foreach($lstAnmCategory as $key => $value)
            {
                foreach ($value as $anm => $details)
                {
                    if(! next($value))
                    {
                        $lstData[$key]['end'] = $details['moic_name'];
                    }
                    else
                    {
                        $lstData[$key]['anm_name'][] = $details['moic_name'];
                    }
                }
            }
        }

        if($type == 'beneficiary')
        {
            $lstData['end'] = null;

            $lstData['anm_name'][] = null;

        }
        $scenario = $targetDataVariable[0]['scenerio'];
        if($scenario == 1){
            return view('scenerio/scenerio_1', compact('lstData', 'type', 'current_month', 'next_month'));
        }
        if($scenario == 2){
            return view('scenerio/scenerio_2',compact('lstData', 'current_month', 'type', 'next_month'));
        }
        if($scenario == 3){
            return view('scenerio/scenerio_3',compact('current_month', 'lstData', 'type', 'next_month'));
        }
        if($scenario == 4){
            return view('scenerio/scenerio_4',compact('current_month', 'lstData', 'type', 'next_month'));
        }
        if($scenario == 5){
            return view('scenerio/scenerio_5',compact('current_month', 'lstData', 'type', 'next_month'));
        }
        if($scenario == 6){
            return view('scenerio/scenerio_6',compact('current_month', 'lstData', 'type', 'next_month'));
        }
        if($scenario == 7){
            return view('scenerio/scenerio_7',compact('current_month', 'lstData', 'type', 'next_month'));
        }
        if($scenario == 8){
            return view('scenerio/scenerio_8',compact('current_month', 'lstData', 'type', 'next_month'));
        }

    }
}
