<?php
namespace App\Console\Commands\Service;

use Illuminate\Support\Collection;

class ProxyClient extends Command {
    protected $signature = 'service:proxyclient';
    protected $description = 'Wechat Personal Service [Swoole[default]|Workerman]';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        
    }
}
