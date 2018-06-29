<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Excel;
use File;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function importFile(Request $request)
    {
        $this->validate($request, array('sample_file' => 'required'));
        if ($request->hasFile('sample_file')) {
            $extension = File::extension($request->sample_file->getClientOriginalName(''));

            if ($extension == "xlsx" || $extension == "xls") {
                $path = $request->file('sample_file')->getRealPath();
                $data = \Excel::selectSheets('target_data')->load($path)->get()->toArray();
                //$data = \Excel::selectSheets('anm_translations')->load($path)->get()->toArray();
                //$data = \Excel::selectSheets('beneficiary_details')->load($path)->get()->toArray();
                //$data = \Excel::selectSheets('phc_translations')->load($path)->get()->toArray();
                if (count($data)>0) {
                    foreach ($data as $key => $value) {


                        $arr[] = [
                            'district' => $value["district"],
                            'block' => $value["block"],
                            'phc_name' =>($value["phc_name"]),
                            'moic_name' =>($value["moic_name"]),
                            'moic_mobile_number' =>($value["moic_phone_number"]),
                            'anm_name' =>($value["anm_name"]),
                            'anm_mobile_number' =>($value["anm_phone_number"]),
                            'performer_category' =>($value["performer_category"]),
                            'scenerio' =>($value["scenario"]),
                            'created_at'=>Carbon::now()->toDateTimeString()
                        ];
                    }
                    if (!empty($arr)) {

                        dd($request->file('sample_file'));


                        $inserted = DB::table('anm_target_data')->insert($arr);

                        if($inserted){

                            //   Storage::putFileAs('ExcelUpload',$request->file('sample_file'),time() .'_'. $request->sample_file->getClientOriginalName());
                            //  Storage::putFileAs('ExcelUpload',$request->file('sample_file'), time() .$request->sample_file->getClientOriginalName());
                            //Storage::put('avatars/1', $fileContents);
                        }
                    }

                }
            } else {
                Session::flash('error', 'File is a ' . $extension . ' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    }


}
