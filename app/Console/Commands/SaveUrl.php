<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Yangqi\Htmldom\Htmldom;
use App\SourceHtml;
use App\SourceUrl;

class SaveUrl extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:save {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save url';

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
        $time = time();
        $url = $this->argument('url');
        $SourceUrl = SourceUrl::where('url', $url)->get();

        if ($SourceUrl->isEmpty()) {
            $SourceUrl = new SourceUrl();
            $SourceUrl->url = $url;
            $SourceUrl->save();
        } else {
            $SourceUrl = $SourceUrl->first();
        }
        $html = new Htmldom($SourceUrl->url);
        $SourceHtml = new SourceHtml();
        $SourceHtml->html = htmlspecialchars($html);
        $SourceHtml->source_url_id = $SourceUrl->id;
        $SourceHtml->save();
//          ['url_id' => $SourceUrl->id, 'html_id' => $SourceHtml->id];
        $this->info($SourceUrl->id);
        $this->info($SourceHtml->id);
        $this->info('Time: ' . (time() - $time));
    }

}
