<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SourceUrl;

class SelectUrl extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:select';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Select url and save url';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $SourceUrl = SourceUrl::inRandomOrder()->first();
        $this->call('url:save', ['url' => $SourceUrl->url]);
        $this->info($SourceUrl->url);
    }

}
