<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ShortLink;


class CleanUpExpiredShortUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-up-expired-short-url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean Up of expired short links';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info("Cron Job running at ". now());
        ShortLink::cleanExpiredShortLinks();
        $this->info('Clean Up Expired short links.');
    }
}
