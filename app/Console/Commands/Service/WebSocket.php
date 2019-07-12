<?php
namespace App\Console\Commands\Service;

class WebSocket extends Command {
    protected $signature = 'service:websocket';
    protected $description = 'websocket Service [Swoole[default]|Workerman]';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        echo "service:websocket";
    }
}
