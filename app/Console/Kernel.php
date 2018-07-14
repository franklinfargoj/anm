<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ReadExcelCommand::class,
        Commands\MoicSMSGeneration::class,
        Commands\MoicSmsDispatch::class,
        Commands\MoicTargettedSmsDispatch::class,
        Commands\BeneficiarySmsDispatch::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('custom:command')->everyFiveMinutes();
        $schedule->command('moic:sms_create')->everyFiveMinutes();
        //$schedule->command('moic:sms_dispatch')->hourly();
        //$schedule->command('moic:targetted_sms')->hourly();
        //$schedule->command('beneficiary:sms_dispatch')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
