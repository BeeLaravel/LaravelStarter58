<?php
namespace App\Console\Commands\Tool;

use Illuminate\Console\Command;

class GeneratePassword extends Command {
    protected $signature = 'tool:genpass
        {--length=10 : Password Length}';
    protected $description = 'Generate Password';

    public function __construct() {
        parent::__construct();
    }
    public function handle() {
        $name = $this->ask('What is your name?');

        $language = $this->choice('Which language do you program in?', [
            'PHP',
            'Ruby',
            'Python',
        ]);

        $this->line('Your name is '.$name.' and you program in '.$language.'.');
    }
}
