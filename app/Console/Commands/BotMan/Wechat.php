<?php
namespace App\Console\Commands\BotMan;

use Illuminate\Console\Command;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

class Wechat extends Command {
    protected $signature = 'botman:wechat';
    protected $description = 'BotMan Wechat';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $config = [
            // "telegram" => [
            //    "token" => "TOKEN"
            // ]
        ];

        DriverManager::loadDriver(\BotMan\Drivers\WeChat\WeChatDriver::class);

        $botman = BotManFactory::create($config);
        $botman->hears('hello', function (BotMan $bot) {
            $bot->reply('Hello yourself.');
        });

        $botman->listen();
    }
}
