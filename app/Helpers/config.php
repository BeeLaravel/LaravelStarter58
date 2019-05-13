<?php
use App\Models\System\Config;

// type system|application|module|organization|department|site|role|user
// storage_type database[mysql[mariadb|percona]|pgsql|sqlite|sqlsrv|oracle|db2|...]|redis|mongodb|ini|xml|array
function configure($key, $value, $type='system', $unique_slug='unknow', $storage_type='database') { // 配置
	switch ( $storage_type ) {
		case 'database':
			if ( is_null($key) ) {
				return Config::where([
					'type' => $type,
					'unique_slug' => $unique_slug,
				])->pluck('value', 'key');
			} else if ( is_null($value) ) {
				return Config::where([
					'type' => $type,
					'unique_slug' => $unique_slug,
					'key' => $key,
				])->value('value');
			} else {
				$data = Config::where([
					'type' => $type,
					'unique_slug' => $unique_slug,
					'key' => $key,
				])->first();

				if ( $data ) {
					return Config::where([
						'type' => $type,
						'unique_slug' => $unique_slug,
						'key' => $key,
					])->update(['value' => $value]);
				} else {
					return Config::create([
						'type' => $type,
						'unique_slug' => $unique_slug,
						'key' => $key,
						'value' => $value,
					]);
				}
			}
		break;
		case 'redis':
		break;
		case 'mongodb':
		break;
		default:
			throw new Exception("Error Config Type: " . $storage_type, 1);
		break;
	}
}
function configure_other($type, $unique_slug, $key=null, $value=null) { // 配置
	return configure($key, $value, $type, $unique_slug);
}

function configure_system($system_slug, $key=null, $value=null) { // 系统配置
	return configure($key, $value, 'system', $system_slug);
}
function configure_application($application_slug, $key=null, $value=null) { // 应用配置
	return configure($key, $value, 'application', $application_slug);
}
function configure_module($module_slug, $key=null, $value=null) { // 模块配置
	return configure($key, $value, 'module', $module_slug);
}

function configure_organization($organization_slug, $key=null, $value=null) { // 机构配置
	return configure($key, $value, 'organization', $organization_slug);
}
function configure_department($department_slug, $key=null, $value=null) { // 部门配置
	return configure($key, $value, 'department', $department_slug);
}
function configure_site($site_slug, $key=null, $value=null) { // 站点配置
	return configure($key, $value, 'site', $site_slug);
}

function configure_role($role_slug, $key=null, $value=null) { // 角色配置
	return configure($key, $value, 'role', $role_slug);
}
function configure_user($user_slug, $key=null, $value=null) { // 用户配置
	return configure($key, $value, 'user', $user_slug);
}
