<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\AdminController;

class UpdateExpiredBookingsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:update-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update expired bookings and related room statuses';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $adminController = new AdminController();
        $result = $adminController->updateExpiredBookings();

        if ($result['success']) {
            $this->info($result['message']);
        } else {
            $this->error($result['message']);
        }
    }
}
