<?php
namespace App\Console\Commands\Service;

class WebSockets extends Command {
    protected $signature = 'service:websockets';
    protected $description = 'WebSocket SSL Service [Swoole[default]|Workerman]';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        echo "service:websockets";
    }
}
