<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\BeneficiaryModel;
use App\DistrictModel;

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

        $processData = AnmTargetDataModel::select('id','block','phc_name','weblink','beneficiary_code','moic_code', 'anm_custom_msg', 'moic_custom_msg', 'beneficiary_custom_msg')
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
        $anm_target_data = AnmTargetDataModel::select('*')
                                            ->where('status','Y')
                                            ->where('filename','LIKE',$file_name)
                                            ->get()
                                            ->toArray();

        $beneficiary = $anm_target_data[0]['block'];
        $weblink = $anm_target_data[0]['weblink'];
        $anm_custom_msg = $anm_target_data[0]['anm_custom_msg'];
        $combination = $anm_custom_msg.$weblink;
        $beneficiary =array($beneficiary,$weblink,$anm_custom_msg,$combination);

        $beneficiary_data = BeneficiaryModel::select('beneficary_details.*','master_district.district_name')
                                            ->join('master_district','beneficary_details.district_id', '=', 'master_district.id')
                                            ->where('beneficary_details.filename','LIKE',$file_name)
                                            ->get()
                                            ->toArray();

        \Excel::create('Target_data', function($excel) use($anm_target_data,$beneficiary_data,$beneficiary) {

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
                    'Combination'
                ];

                foreach ($anm_target_data as $value) {
                    $excelData[] = array(
                        $value['district'],
                        $value['block'],
                        $value['phc_name'],
                        $value['moic_name'],
                        $value['moic_mobile_number'],
                        $value['anm_name'],
                        $value['anm_mobile_number'],
                        $value['performer_category'],
                        $value['scenerio'],
                        $value['weblink'],
                        $value['anm_custom_msg'],
                        $value['anm_custom_msg'].$value['weblink']
                    );
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });

            $excel->sheet('beneficiary', function($sheet) use($beneficiary_data,$beneficiary) {
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
                    $excelData[] = array(
                        $value['district_name'],
                        $beneficiary[0],
                        $value['phc_name'],
                        $value['beneficary_mobile_number'],
                        $beneficiary[1],
                        $beneficiary[2],
                        $beneficiary[3]
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
