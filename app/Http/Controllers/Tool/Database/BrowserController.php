<?php

namespace App\Http\Controllers\Tool\Database;

use Illuminate\Http\Request;
// model
use App\Models\Server\Protocol;
use App\Models\Server\Server;

use Illuminate\Database\Connectors\ConnectionFactory;

use PDO;

class BrowserController extends Controller
{
    public function __construct(ConnectionFactory $factory) {
        parent::__construct();

        $this->factory = $factory;
    }

    public function index() {
        $types = Protocol::database()->pluck('title', 'slug');

    	return view('tool.database.browser', compact('types'));
    }
    public function server($type='mysql') {
        return Server::where('type', $type)->get()->toJson();
    }
    public function table($server_id=8) {
        $server = Server::find($server_id);

        $username = 'root';
        $password = 'root';
        $database = 'laravel_starter58';
        $charset = 'utf8mb4';
        $collation = 'utf8mb4_general_ci';
        $prefix = '';
    
        $db = $this->factory->make([
            'driver' => $server->type,
            'host' => $server->host,
            'port' => $server->port,
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

        return $db->table('information_schema.tables')->where('table_schema', $database)->get()->toJson();
    }
}
