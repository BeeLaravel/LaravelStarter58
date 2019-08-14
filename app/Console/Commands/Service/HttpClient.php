<?php
namespace App\Console\Commands\Service;

use Illuminate\Support\Collection;

class HttpClient extends Command {
    protected $signature = 'service:http_client';
    protected $description = 'Wechat Personal Service [Swoole[default]|Workerman]';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        
    }
}
