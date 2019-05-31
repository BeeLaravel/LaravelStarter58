<?php
namespace App\Console\Commands\Tool;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\Models\Config\Configure as ThisModel;

class Config extends Command {
    protected $signature = 'tool:config';
    protected $description = 'Read config files to database';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $list = glob(config_path()."/*.php");

        $data = [];
        foreach ( $list as $item ) {
            $data[] = [
                'title' => pathinfo($item, PATHINFO_BASENAME),
                'slug' => pathinfo($item, PATHINFO_BASENAME),
                'content' => file_get_contents($item),
            ];
        }
        ThisModel::insert($data);
    }
    protected function getArguments() {
        return [];
    }
    protected function getOptions() {
        return [];
    }
}
// php artisan tool:config

