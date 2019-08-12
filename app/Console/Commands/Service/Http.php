<?php
namespace App\Console\Commands\Service;

use Illuminate\Support\Collection;

class Http extends Command {
    protected $signature = 'service:http';
    protected $description = 'Wechat Personal Service [Swoole[default]|Workerman]';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        
    }
}
