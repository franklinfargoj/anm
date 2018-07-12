<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\BeneficiaryModel;
use App\DistrictModel;
use App\Block;

use DataTables;

class ProcessedFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('processedfile',compact('id'));
    }


    public function fetchProcessData($id){
        $file_name = AnmTargetDataModel::select('filename')
                    ->where('id',$id)
                    ->first();

        $processData = AnmTargetDataModel::with('block')->select('id','block','phc_name','weblink','beneficiary_code','moic_code', 'anm_custom_msg', 'moic_custom_msg', 'beneficiary_custom_msg')
                                        ->where('status','Y')
                                        ->where('filename','LIKE',$file_name['filename'])
                                        ->get()
                                        ->toArray();

        $db = Datatables::of($processData);
        $db->addColumn('sr_no', function ($processData){ static $i = 0; $i++; return $i; }) ->rawColumns(['id']);


        $db->addColumn('weblink', function ($processData){
            return url('/weblink/'.$processData["weblink"]);
        })->rawColumns(['weblink']);


        $db->addColumn('beneficiarycode', function ($processData){
            return config('app.url').'/weblink/'.$processData["beneficiary_code"];
        }) ->rawColumns(['beneficiarycode']);

        $db->addColumn('moiccode', function ($processData){
            return config('app.url').'/weblink/'.$processData["moic_code"];
        }) ->rawColumns(['moiccode']);


        return $db->make(true);
    }



   public function export($request){

        $file = AnmTargetDataModel::select('filename')
                    ->where('id',$request)
                    ->first();
        $file_name = $file['filename'];

        $anm_target_data = AnmTargetDataModel::with(['district', 'block'])->select('*')
                                            ->where('status','Y')
                                            ->where('filename','=',$file_name)
                                            ->get()
                                            ->toArray();

       $weblink = AnmTargetDataModel::where('filename','=',$file_name)
                                ->pluck('weblink','phc_name')
                                ->toArray();
       
       $block=AnmTargetDataModel::select('block')->where('filename',$file_name)->first();
       $block_id = $block['block'];
       $block_n = Block::select('block_name')->where('id',$block_id)->first();
       $block_name = $block_n['block_name'];


        $beneficiary_data = BeneficiaryModel::select('beneficary_mobile_number','district_id','phc_name','master_district.district_name')
                                              ->join('master_district','beneficary_details.district_id', '=', 'master_district.id')
                                              ->where('filename','=',$file_name)
                                              ->get()
                                              ->toArray();

        \Excel::create('Target_data', function($excel) use($anm_target_data,$beneficiary_data,$block_name,$weblink) {

            $excel->sheet('target_data', function($sheet) use($anm_target_data) {
                $excelData = [];
                $excelData[] = [
                    'District',
                    'Block',
                    'Phc Name',
                    'MOIC Name',
                    'MOIC Phone Number',
                    'ANM Name',
                    'ANM Phone Number',
                    'Performer Category',
                    'Scenario',
                    'Weblink',
                    'Anm cutomised message',
                    'MOIC cutomised message',
                    'Combination'
                ];

                foreach ($anm_target_data as $value) {
                    $excelData[] = array(
                        $value['district']['district_name'],
                        $value['block']['block_name'],
                        $value['phc_name'],
                        $value['moic_name'],
                        $value['moic_mobile_number'],
                        $value['anm_name'],
                        $value['anm_mobile_number'],
                        $value['performer_category'],
                        $value['scenerio'],
                        $value['weblink'],
                        $value['anm_custom_msg'],
                        $value['moic_custom_msg'],
                        $value['anm_custom_msg'].$value['weblink']
                    );
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });

            $excel->sheet('beneficiary', function($sheet) use($beneficiary_data,$block_name,$weblink) {
                $excelData = [];
                $excelData[] = [
                    'District',
                    'Block',
                    'Phc Name',
                    'Beneficiary Phone Number',
                    'Weblink',
                    'Text message',
                    'Combination'
                ];

                foreach ($beneficiary_data as $value) {

                    if(array_key_exists($value['phc_name'],$weblink)){
                        $weblink_text = $weblink[$value['phc_name']];
                    }else{
                        $weblink_text = null;
                    }

                    $excelData[] = array(
                        $value['district_name'],
                        $block_name,
                        $value['phc_name'],
                        $value['beneficary_mobile_number'],
                        $weblink_text,
                        "message",
                        "combination"
                    );
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });

        })->download('xlsx');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
