<?php
namespace App\Console\Commands\Service;

class WebSocketClient extends Command {
    protected $signature = 'service:websocketclient';
    protected $description = 'websocket Service Client [Swoole[default]|Workerman]';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        echo "service:websocket";
    }
}
