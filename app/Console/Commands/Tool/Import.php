<?php

namespace App\Console\Commands\Tool;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Illuminate\Database\Connectors\ConnectionFactory;

use \PDO;

class Import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tool:import {table} {file} {--type=txt} {--indent=\t}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from deferent source';

    protected $factory = '';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ConnectionFactory $factory)
    {
        parent::__construct();

        $this->factory = $factory;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $table = $this->input->getArgument('table');
        $file = base_path($this->input->getArgument('file'));
        $type = $this->input->getOption('type');
        $indent = $this->input->getOption('indent');

        $driver = 'mysql';
        $host = '127.0.0.1';
        $port = 3306;
        $username = 'root';
        $password = 'root';
        $database = 'laravel_starter58';
        $prefix = '';
        $charset = 'utf8mb4';
        $collation = 'utf8mb4_unicode_ci';

        switch ( $type ) {
            case 'txt':
                try {
                    $data = leveling(file_get_contents($file), $indent);
                    $data = flating($data, ['type', 'slug']);

                    foreach ( $data as $key => $item ) {
                        $data[$key]['title'] = $item['slug'];
                        $data[$key]['created_at'] = date('Y-m-d H:i:s');
                    }

                    $db = $this->factory->make([
                        'driver' => $driver,
                        'host' => $host,
                        'port' => $port,
                        'username' => $username,
                        'password' => $password,
                        'database' => $database,
                        'prefix' => $prefix,
                        'charset' => $charset,
                        'collation' => $collation,
                        'prefix_indexes' => true,
                        'unix_socket' => '',
                        'strict' => true,
                        'engine' => null,
                        'options' => extension_loaded('pdo_mysql') ? array_filter([
                            PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                        ]) : [],
                    ]);

                    $return = $db->table($table)->insert($data);
                    if ( $return ) {
                        echo "Success!\n";
                    } else {
                        echo "Error!\n";
                    }
                } catch ( \Exception $e ) {
                    echo $e->getMessage()."\n";
                }
            break;
            default:
                echo "不支持的类型：{$type}！\n";
        }
    }
    protected function getArguments()
    {
        return [
            ['type', InputArgument::REQUIRED, 'The type of the source'],
        ];
    }
    protected function getOptions()
    {
        return [
            ['sync', null, InputOption::VALUE_NONE, 'Indicates that job should be synchronous'],
        ];
    }
}
// php artisan tool:import --type=txt --indent='    ' server_protocols docs/sources/protocol.txt
