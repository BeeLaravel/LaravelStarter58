<?php
namespace App\Console\Commands\Test;

use App\Models\RBAC\User;

class WorkflowBrexis extends Command {
    protected $signature = 'workflow:brexis';
    protected $description = 'workflow use brexis';

    public function __construct() {
        parent::__construct();
    }
    public function handle() {
        echo "workflow:brexis";
    }
}
