<?php

namespace App\Http\Controllers;

use Dompdf\Exception;
use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\PhcTranslationModel;
use App\DistrictModel;

use App\AnmDetailsModel;
use Illuminate\Support\Facades\DB;
use Anam\PhantomMagick\Converter;
use Illuminate\Support\Facades\URL;

class WeblinkController extends Controller
{

    public function index($id)
    {
        $anm_target_data = AnmTargetDataModel::select('district','phc_name','phc_hin','moic_name','moic_hin','moic_mobile_number','anm_name','anm_hin','subcenter_hindi',
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


        $lstAnmCategory = array();
//        dd($targetDataVariable);
        foreach ($targetDataVariable as $value){
//            if( strpos($value['anm_hin'], ',') !== false ) {
//                $multipleAnms = explode(',',$value['anm_hin']);
//                $anmArray = array();
//                foreach($multipleAnms as $anm){
//                    if(array_key_exists($anm,$anm_detail)){
//                        $anmName = $anm_detail[$anm];
//                    }else{
//                        $anmName = $anm;
//                    }
//                    $anmArray[] = $anmName;
//                }
//                $value['anm_name'] = implode('&#93;',$anmArray);
//            }else{
//                if(array_key_exists($value['anm_name'],$anm_detail)){
//                    $value['anm_name'] = $anm_detail[$value['anm_name']];
//                }else{
//                    $value['anm_name'] = 'test1';
//                }
//            }

            $lstAnmCategory[$value['performer_category']][] = $value;
        }

        $lstData = array();

        if(!empty($lstAnmCategory['TOP'])){
            $lstData['phc_name'] = $lstAnmCategory['TOP'][0]['phc_hin'];
        }
        if(!empty($lstAnmCategory['MIDDLE'])){
            $lstData['phc_name'] = $lstAnmCategory['MIDDLE'][0]['phc_hin'];
        }
        if(!empty($lstAnmCategory['BOTTOM'])){
            $lstData['phc_name'] = $lstAnmCategory['BOTTOM'][0]['phc_hin'];
        }

        if($type == 'anm')
        {
            foreach($lstAnmCategory as $key => $value)
            {
                $lstValue = array();
                $lstUniqueSubcenter = array();
                foreach ($value as $uniqueValue)
                {
                    if(in_array($uniqueValue['subcenter_hindi'],$lstUniqueSubcenter)){
                        continue;
                    }
                    $lstUniqueSubcenter[] = $uniqueValue['subcenter_hindi'];
                    $lstValue[] = $uniqueValue;
                }
                foreach ($lstValue as $anm => $details)
                {
                    if(! next($lstValue))
                    {
                        $lstData[$key]['end'] = $details['subcenter_hindi'];
                    }
                    else
                    {
                        $lstData[$key]['subcenter'][] = $details['subcenter_hindi'];
                    }
                }
            }
        }

            if(!empty($targetDataVariable)){

                $scenario = $targetDataVariable[0]['scenerio'];
                $scenes = 'scenario_' . $scenario;
                if ($scenario == 1) {
                    return view('scenerio/scenerio_1', compact('lstData', 'type', 'current_month', 'next_month', 'scenes'));
                }
                if ($scenario == 2) {
                    return view('scenerio/scenerio_2', compact('lstData', 'current_month', 'type', 'next_month', 'scenes'));
                }
                if ($scenario == 3) {
                    return view('scenerio/scenerio_3', compact('current_month', 'lstData', 'type', 'next_month', 'scenes'));
                }
                if ($scenario == 4) {
                    return view('scenerio/scenerio_4', compact('current_month', 'lstData', 'type', 'next_month', 'scenes'));
                }
                if ($scenario == 5) {
                    return view('scenerio/scenerio_5', compact('current_month', 'lstData', 'type', 'next_month', 'scenes'));
                }
                if ($scenario == 6) {
                    return view('scenerio/scenerio_6', compact('current_month', 'lstData', 'type', 'next_month', 'scenes'));
                }
                if ($scenario == 7) {
                    return view('scenerio/scenerio_7', compact('current_month', 'lstData', 'type', 'next_month', 'scenes'));
                }
                if ($scenario == 8) {
                    return view('scenerio/scenerio_8', compact('current_month', 'lstData', 'type', 'next_month'));
                }

            }else{
                abort(404);
            }

    }

    public function downloadImage()
    {
        $url = URL::previous();

        Converter::make($url)
            ->toJpg()
            ->download('anm.jpg');
    }
}
