<?php
namespace App\Console\Commands\Test;

use App\Models\RBAC\User;

class WorkflowPicr extends Command {
    protected $signature = 'workflow:picr';
    protected $description = 'workflow use picr';

    public function __construct() {
        parent::__construct();
    }
    public function handle() {
        echo "workflow:picr";
    }
}
