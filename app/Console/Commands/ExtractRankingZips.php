<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MoicRanking;
use App\RankingZip;
use Chumper\Zipper\Zipper;

class ExtractRankingZips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moic:extract_zip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to extract all pdf\'s for moic rankings uploaded by user';

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
        $not_extracted = RankingZip::where('is_extracted', 0)->get();
        $cnt = count($not_extracted);
        if(count($not_extracted)){
            $months = \DB::table('master_months')->pluck('month_english', 'id');
            $zipper = new Zipper;
            echo $cnt." zips are remaining to extract.".PHP_EOL;
            foreach($not_extracted as $zip){
                if(file_exists(public_path().'/'.$zip->zip_file)){
                    $extracted_path = public_path().'/moic/rankings/'.$zip->year.'/'.strtolower($months[$zip->month]);
                    if(!is_dir($extracted_path)){
                        mkdir($extracted_path, 0777, true);
                    }
                    $zipper->make(public_path().'/'.$zip->zip_file)->folder('rankings')->extractTo($extracted_path);
                    MoicRanking::where('zip_id', $zip->id)->update(['pdf_path' => '/moic/rankings/'.$zip->year.'/'.strtolower($months[$zip->month]).'/']);
                    $zip->is_extracted = 1;
                    $zip->save();
                    echo 'Extracted successfully in moic/rankings/'.$zip->year.'/'.strtolower($months[$zip->month]);
                }else{
                    echo "File not found in directory for zip ".$zip->id;
                }
                echo PHP_EOL;
            }
        }
        echo "All zips are extracted till today".PHP_EOL;
    }
}
