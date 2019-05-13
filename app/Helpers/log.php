<?php
use App\Models\System\LogRoute;
use App\Models\System\LogDatabase;

// type system|application|module|controller|action
function log_route($log, $type='database') { // 记录日志 - 路由日志
	switch ( $type ) {
		case 'database':
			LogRoute::create($log);
			// LogRoute::create([
				// 'system' => $log['system'],
				// 'application' => $log['application'],
				// 'module' => $log['module'],
				// 'controller' => $log['controller'],
				// 'action' => $log['action'],

				// 'url' => $log['url'],
				// 'http' => $log['http'],
				// 'description' => $log['description'],
				// 'status' => $log['status'],
				// 'result' => $log['result'],
			// ]);
		break;
		default:
		break;
	}
}
// operation_type record|table|view|index|trigle|procedure|function|database
// type insert|delete|update|create|drop|alter|function|database
function log_database($log, $type='database') { // 记录日志 - 数据库日志
	switch ( $type ) {
		case 'database':
			LogDatabase::create($log);
			// LogDatabase::create([
				// 'operation_type' => $log['operation_type'],
				// 'type' => $log['type'],
				// 'sql' => $log['sql'],
				// 'description' => $log['description'],
				// 'status' => $log['status'],
				// 'result' => $log['result'],
			// ]);
		break;
		default:
		break;
	}
}
