<?php

namespace App\Console\Commands;

use App\BeneficiaryModel;
use App\DistrictModel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Excel;
use App\AnmTargetDataModel;

class ReadExcelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $open = public_path().'/ExcelUpload';

        if ($files = glob($open . "/*")) {
            foreach ($files as $filePath)
            {
                $path = $filePath;

                $filename = substr($path, strrpos($path, '/') + 1);

                $counter = 0;

                $sheetName = Excel::load($path, function($sheet) use(&$counter) {
                    $sheet->each(function($sheet) use(&$counter) {
                        $counter++;
                    });
                })->getSheetNames();


                if($counter > 1) {
                    $district_name = AnmTargetDataModel::where('filename', $filename)->pluck('district')->first();

                    $district_name = trim(strtolower($district_name));

                    $district_id = DistrictModel::where('district_name', 'LIKE', $district_name)->pluck('id')->first();

                    $arrayList = array();
                    $arrayData = array();

                    foreach ($sheetName as $key => $sheet) {
                        if ($key == 0) {
                            continue;
                        }

                        $data = Excel::selectSheets($sheet)->load($path, function($sheet) use(&$counter) {
                            $sheet->each(function ($sheet) use (&$counter) {
                                $counter++;
                            });
                        })->get()->toArray();

                        if($sheet == "beneficiary_details") {
                            foreach ($data as $key => $mob) {
                                foreach ($mob as $k => $v) {
                                    if ($k == "phc_name") {
                                        continue;
                                    }
                                    $arrayList['beneficary_mobile_number'] = $v;
                                    $arrayList['district_id'] = $district_id;
                                    $arrayList['phc_name'] = $k;
                                    $arrayList['created_at'] = Carbon::now();

                                    $arrayData[] = $arrayList;

                                }

                            }
                            BeneficiaryModel::insert($arrayData); //Inserting Data into Beneficiary Table
                        }
                    }
                }
            }
        } else {
            dd('no files');
        }
    }
}
