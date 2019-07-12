<?php
namespace App\Console\Commands\Service;

class WebSocketsClient extends Command {
    protected $signature = 'service:websocketsclient';
    protected $description = 'WebSocket SSL Service [Swoole[default]|Workerman]';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        echo "service:websocketsclient";
    }
}
