<?php
namespace App\Console\Commands\Service;

class WechatOfficial extends Command {
    protected $signature = 'service:wechatofficial';
    protected $description = 'Wechat Official Service [Swoole[default]|Workerman]';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        echo "service:wechatofficial";
    }
}
