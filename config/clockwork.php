<?php

return [
	'enable' => env('CLOCKWORK_ENABLE', null), // Default: null - app.debug
	'web' => env('CLOCKWORK_WEB', true), // Default: true - /__clockwork
	'web_dark_theme' => env('CLOCKWORK_WEB_DARK_THEME', false),
	'collect_data_always' => env('CLOCKWORK_COLLECT_DATA_ALWAYS', false), // Default: false
	'storage' => env('CLOCKWORK_STORAGE', 'files'), // files or sql
	'storage_files_path' => env('CLOCKWORK_STORAGE_FILES_PATH', storage_path('clockwork')),
	'storage_sql_database' => env('CLOCKWORK_STORAGE_SQL_DATABASE', storage_path('clockwork.sqlite')),
	'storage_sql_table'    => env('CLOCKWORK_STORAGE_SQL_TABLE', 'clockwork'),
	'storage_expiration' => env('CLOCKWORK_STORAGE_EXPIRATION', 60 * 24 * 7),
	'authentication' => env('CLOCKWORK_AUTHENTICATION', false),
	'authentication_password' => env('CLOCKWORK_AUTHENTICATION_PASSWORD', 'VerySecretPassword'),
	'filter' => [
		'cacheQueries', // collecting cache queries in cache-heavy might have a negative performance impact and use a lot of disk space
		'routes', // collecting routes data on every request might use a lot of disk space
		'viewsData', // collecting views data, including all variables passed to the view on every request might use a lot of disk space
	],
	'filter_uris' => [
		'/horizon/.*', // Laravel Horizon requests
		'/telescope/.*' // Laravel Telescope requests
	],
	'collect_stack_traces' => env('CLOCKWORK_COLLECT_STACK_TRACES', true), // Default: true

	/*
	|--------------------------------------------------------------------------
	| Serialization
	|--------------------------------------------------------------------------
	|
	| Configure how Clockwork serializes the collected data.
	| Depth limits how many levels of multi-level arrays and objects have
	| extended serialization (rest uses simple serialization).
	| Blackbox allows you to specify classes which contents should be never
	| serialized (eg. a service container class).
	| Lowering depth limit and adding classes to blackbox lowers the memory
	| usage and processing time.
	|
	*/

	'serialization_depth' => env('CLOCKWORK_SERIALIZATION_DEPTH', 10),

	'serialization_blackbox' => [
		\Illuminate\Container\Container::class,
		\Illuminate\Foundation\Application::class,
		\Laravel\Lumen\Application::class
	],

	/*
	|--------------------------------------------------------------------------
	| Ignored events
	|--------------------------------------------------------------------------
	|
	| Array of event names that will be ignored when collecting data for the "events" tab.
	| By default all framework-specific events are also ignored, set to false to log
	| all possible fired events.
	|
	*/

	'ignored_events' => [
	],

	/*
	|--------------------------------------------------------------------------
	| Register helpers
	|--------------------------------------------------------------------------
	|
	| This setting controls whether the "clock" helper function will be registered. You can use the "clock" function to
	| quickly log something to Clockwork or access the Clockwork instance.
	|
	*/

	'register_helpers' => env('CLOCKWORK_REGISTER_HELPERS', true),

	/*
	|--------------------------------------------------------------------------
	| Send Headers for AJAX request
	|--------------------------------------------------------------------------
	|
	| When trying to collect data the AJAX method can sometimes fail if it is
	| missing required headers. For example, an API might require a version
	| number using Accept headers to route the HTTP request to the correct
	| codebase.
	|
	*/

	'headers' => [
		// 'Accept' => 'application/vnd.com.whatever.v1+json',
	],

	/*
	|--------------------------------------------------------------------------
	| Server-Timing
	|--------------------------------------------------------------------------
	|
	| Clockwork supports the W3C Server Timing specification, which allows for
	/ collecting a simple performance metrics in a cross-browser way. Eg. in
	/ Chrome, your app, database and timeline event timings will be shown
	/ in the Dev Tools network tab.
	/ This setting specifies the max number of timeline events that will be sent.
	| When set to false, Server-Timing headers will not be set.
	| Default: 10
	|
	*/
	'server_timing' => env('CLOCKWORK_SERVER_TIMING', 10)
];

