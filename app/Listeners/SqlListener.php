<?php
namespace App\Listeners;

use Illuminate\Database\Events\QueryExecuted;

class SqlListener {
    public function __construct() {}

    public function handle(QueryExecuted $event) {
        $sql = str_replace("?", "'%s'", $event->sql);
        // $sql = vsprintf($sql, $event->bindings);
        $log = '[' . date('Y-m-d H:i:s') . '] ' . $sql . "\r\n";
        $filepath = storage_path('logs'.DIRECTORY_SEPARATOR.'sql.log');
        file_put_contents($filepath, $log, FILE_APPEND);
    }
}
