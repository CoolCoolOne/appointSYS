<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Slot;
use Carbon\Carbon;

class DeletePastSlots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-past-slots';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old slots every day on midnight';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now()->addHour();

        $deletedCount = Slot::where('slot_datetime', '<', $now)->delete();

        $this->info("{$deletedCount} old slots deleted successfully.");
    }
}
