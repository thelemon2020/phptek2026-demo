<?php

namespace App\Console\Commands;

use App\Models\MirrorLog;
use Illuminate\Console\Command;

class WipeMirrorLogs extends Command
{
    protected $signature = 'mirror:wipe';

    protected $description = 'Delete all mirror log entries';

    public function handle(): int
    {
        $count = MirrorLog::query()->count();
        MirrorLog::query()->delete();
        $this->info("Deleted {$count} mirror log entries.");

        return self::SUCCESS;
    }
}
