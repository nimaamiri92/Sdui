<?php

namespace App\Console\Commands;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveOutdatedNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'deleting all news entries older than 14 days which runs every day.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(News $news)
    {
        parent::__construct();
        $this->news = $news;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->news->where('created_at','<=', Carbon::now()->subDays(14))->delete();
    }
}
