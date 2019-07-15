<?php
namespace App\Console\Commands\Test;

class Command extends \Illuminate\Console\Command {
	protected $signature = 'test';
    protected $description = '测试';

    public function __construct() {
        parent::__construct();
    }
}
