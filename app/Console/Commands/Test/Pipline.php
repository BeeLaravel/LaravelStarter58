<?php
namespace App\Console\Commands\Test;

use Illuminate\Pipeline\Pipeline;
use Closure;
use App\Models\RBAC\User;

class Pipline extends Command {
    protected $signature = 'pipline';
    protected $description = 'Pipline';

    public function __construct() {
        parent::__construct();
    }
    public function handle() {
        $pipe = function ($process, Closure $next) {
            return $next($process);
        };

        echo (new Pipeline)->send(new User())->through([$pipe])->then(function ($process) {
        });
    }
}
