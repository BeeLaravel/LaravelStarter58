<?php
namespace App\Console\Commands\Tool;

use Illuminate\Console\Command;

class GeneratePassword extends Command {
    protected $signature = 'tool:genpass
        {--length=10 : Password Length}';
    protected $description = 'Generate Password 生成密码';

    public function __construct() {
        parent::__construct();
    }
    public function handle() {
        $password = "";

        $candidate = <<<EOT
ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789,./;'[]\-=<>?:"{}|_+!@#$%^&*()~`
EOT;
        $candidate_length = strlen($candidate);
        $length = $this->option('length');
        
        for ( $i=0; $i<$length; $i++ ) {
            $position = rand(0, $candidate_length-1);
            $password .= $candidate[$position];
        }

        echo $password;
    }
}
