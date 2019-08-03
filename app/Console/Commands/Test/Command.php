<?php
namespace App\Console\Commands\Test;

class Command extends \Illuminate\Console\Command {
	protected $signature = 'test';
    protected $description = '测试';

    public function __construct() {
        parent::__construct();
    }
}
// $name = $this->ask('What is your name?');
// $language = $this->choice('Which language do you program in?', [
//     'PHP',
//     'Ruby',
//     'Python',
// ]);
// $this->line('Your name is '.$name.' and you program in '.$language.'.');
