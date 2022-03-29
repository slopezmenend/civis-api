<?php

namespace App\Scripts;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Lease;

class Kernel extends ConsoleKernel {

    protected function schedule(Schedule $schedule)
{

    $schedule->call(App\Http\Controllers\ScriptController::exec())->runInBackground();

}
}


?>
