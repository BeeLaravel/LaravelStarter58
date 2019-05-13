<?php

namespace App\Console\Commands\Tool;

use Illuminate\Console\Command;

use Illuminate\Database\Connectors\ConnectionFactory;

use \PDO;

class Export extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tool:export {table} {file} {--type=txt} {--indent=\t}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export data to deferent file type';

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
                    $db = $this->factory->make([
                        'driver' => $driver,
                        'host' => $host,
                        'port' => $port,
                        'username' => $username,
                        'password' => $password,
                        'database' => $database,
                        'charset' => $charset,
                        'collation' => $collation,
                        'prefix' => $prefix,
                        'prefix_indexes' => true,
                        'unix_socket' => '',
                        'strict' => true,
                        'engine' => null,
                        'options' => extension_loaded('pdo_mysql') ? array_filter([
                            PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                        ]) : [],
                    ]);

                    $data = $db->table($table)->get();
                    $data = json_decode(json_encode($data), true); // 转换为数组
                    $data = unflating($data, ['type', 'slug']);
                    $data = unleveling($data, $indent);

                    if ( file_put_contents($file, $data) ) {
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
}
