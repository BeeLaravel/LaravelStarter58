<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin name
    |--------------------------------------------------------------------------
    |
    | This value is the name of laravel-admin, This setting is displayed on the
    | login page.
    |
    */
    'name' => 'Laravel-admin',

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin logo
    |--------------------------------------------------------------------------
    |
    | The logo of all admin pages. You can also set it as an image by using a
    | `img` tag, eg '<img src="http://logo-url" alt="Admin logo">'.
    |
    */
    'logo' => '<b>Laravel</b> admin',

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin mini logo
    |--------------------------------------------------------------------------
    |
    | The logo of all admin pages when the sidebar menu is collapsed. You can
    | also set it as an image by using a `img` tag, eg
    | '<img src="http://logo-url" alt="Admin logo">'.
    |
    */
    'logo-mini' => '<b>La</b>',

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin bootstrap setting
    |--------------------------------------------------------------------------
    |
    | This value is the path of laravel-admin bootstrap file.
    |
    */
    'bootstrap' => app_path('Admin/bootstrap.php'),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin route settings
    |--------------------------------------------------------------------------
    |
    | The routing configuration of the admin page, including the path prefix,
    | the controller namespace, and the default middleware. If you want to
    | access through the root path, just set the prefix to empty string.
    |
    */
    'route' => [

        'prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'),

        'namespace' => 'App\\Admin\\Controllers',

        'middleware' => ['web', 'admin'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin install directory
    |--------------------------------------------------------------------------
    |
    | The installation directory of the controller and routing configuration
    | files of the administration page. The default is `app/Admin`, which must
    | be set before running `artisan admin::install` to take effect.
    |
    */
    'directory' => app_path('Admin'),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin html title
    |--------------------------------------------------------------------------
    |
    | Html title for all pages.
    |
    */
    'title' => 'Admin',

    /*
    |--------------------------------------------------------------------------
    | Access via `https`
    |--------------------------------------------------------------------------
    |
    | If your page is going to be accessed via https, set it to `true`.
    |
    */
    'https' => env('ADMIN_HTTPS', false),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin auth setting
    |--------------------------------------------------------------------------
    |
    | Authentication settings for all admin pages. Include an authentication
    | guard and a user provider setting of authentication driver.
    |
    | You can specify a controller for `login` `logout` and other auth routes.
    |
    */
    'auth' => [

        'controller' => App\Admin\Controllers\AuthController::class,

        'guard' => 'admin',

        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => Encore\Admin\Auth\Database\Administrator::class,
            ],
        ],

        // Add "remember me" to login form
        'remember' => true,

        // Redirect to the specified URI when user is not authorized.
        'redirect_to' => 'auth/login',

        // The URIs that should be excluded from authorization.
        'excepts' => [
            'auth/login',
            'auth/logout',
            'locale', // laravel-admin-extensions/multi-language
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin upload setting
    |--------------------------------------------------------------------------
    |
    | File system configuration for form upload files and images, including
    | disk and upload path.
    |
    */
    'upload' => [

        // Disk in `config/filesystem.php`.
        'disk' => 'admin',

        // Image and file upload path under the disk above.
        'directory' => [
            'image' => 'images',
            'file'  => 'files',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin database settings
    |--------------------------------------------------------------------------
    |
    | Here are database settings for laravel-admin builtin model & tables.
    |
    */
    'database' => [

        // Database connection for following tables.
        'connection' => '',

        // User tables and model.
        'users_table' => 'admin_users',
        'users_model' => Encore\Admin\Auth\Database\Administrator::class,

        // Role table and model.
        'roles_table' => 'admin_roles',
        'roles_model' => Encore\Admin\Auth\Database\Role::class,

        // Permission table and model.
        'permissions_table' => 'admin_permissions',
        'permissions_model' => Encore\Admin\Auth\Database\Permission::class,

        // Menu table and model.
        'menu_table' => 'admin_menu',
        'menu_model' => Encore\Admin\Auth\Database\Menu::class,

        // Pivot table for table above.
        'operation_log_table'    => 'admin_operation_log',
        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table'       => 'admin_role_users',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table'        => 'admin_role_menu',
    ],

    /*
    |--------------------------------------------------------------------------
    | User operation log setting
    |--------------------------------------------------------------------------
    |
    | By setting this option to open or close operation log in laravel-admin.
    |
    */
    'operation_log' => [

        'enable' => true,

        /*
         * Only logging allowed methods in the list
         */
        'allowed_methods' => ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'],

        /*
         * Routes that will not log to database.
         *
         * All method to path like: admin/auth/logs
         * or specific method to path like: get:admin/auth/logs.
         */
        'except' => [
            'admin/auth/logs*',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Indicates whether to check route permission.
    |--------------------------------------------------------------------------
    */
    'check_route_permission' => true,

    /*
    |--------------------------------------------------------------------------
    | Indicates whether to check menu roles.
    |--------------------------------------------------------------------------
    */
    'check_menu_roles'       => true,

    /*
    |--------------------------------------------------------------------------
    | User default avatar
    |--------------------------------------------------------------------------
    |
    | Set a default avatar for newly created users.
    |
    */
    'default_avatar' => '/vendor/laravel-admin/AdminLTE/dist/img/user2-160x160.jpg',

    /*
    |--------------------------------------------------------------------------
    | Admin map field provider
    |--------------------------------------------------------------------------
    |
    | Supported: "tencent", "google", "yandex".
    |
    */
    'map_provider' => 'google',

    /*
    |--------------------------------------------------------------------------
    | Application Skin
    |--------------------------------------------------------------------------
    |
    | This value is the skin of admin pages.
    | @see https://adminlte.io/docs/2.4/layout
    |
    | Supported:
    |    "skin-blue", "skin-blue-light", "skin-yellow", "skin-yellow-light",
    |    "skin-green", "skin-green-light", "skin-purple", "skin-purple-light",
    |    "skin-red", "skin-red-light", "skin-black", "skin-black-light".
    |
    */
    'skin' => 'skin-blue-light',

    /*
    |--------------------------------------------------------------------------
    | Application layout
    |--------------------------------------------------------------------------
    |
    | This value is the layout of admin pages.
    | @see https://adminlte.io/docs/2.4/layout
    |
    | Supported: "fixed", "layout-boxed", "layout-top-nav", "sidebar-collapse",
    | "sidebar-mini".
    |
    */
    'layout' => ['sidebar-mini', 'sidebar-collapse'],

    /*
    |--------------------------------------------------------------------------
    | Login page background image
    |--------------------------------------------------------------------------
    |
    | This value is used to set the background image of login page.
    |
    */
    'login_background_image' => '',

    /*
    |--------------------------------------------------------------------------
    | Show version at footer
    |--------------------------------------------------------------------------
    |
    | Whether to display the version number of laravel-admin at the footer of
    | each page
    |
    */
    'show_version' => true,

    /*
    |--------------------------------------------------------------------------
    | Show environment at footer
    |--------------------------------------------------------------------------
    |
    | Whether to display the environment at the footer of each page
    |
    */
    'show_environment' => true,

    /*
    |--------------------------------------------------------------------------
    | Menu bind to permission
    |--------------------------------------------------------------------------
    |
    | whether enable menu bind to a permission
    */
    'menu_bind_permission' => true,

    /*
    |--------------------------------------------------------------------------
    | Enable default breadcrumb
    |--------------------------------------------------------------------------
    |
    | Whether enable default breadcrumb for every page content.
    */
    'enable_default_breadcrumb' => true,

    /*
    |--------------------------------------------------------------------------
    | Enable/Disable assets minify
    |--------------------------------------------------------------------------
    */
    'minify_assets' => [

        // Assets will not be minified.
        'excepts' => [

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Enable/Disable sidebar menu search
    |--------------------------------------------------------------------------
    */
    'enable_menu_search' => true,

    /*
    |--------------------------------------------------------------------------
    | Alert message that will displayed on top of the page.
    |--------------------------------------------------------------------------
    */
    'top_alert' => '',

    /*
    |--------------------------------------------------------------------------
    | The global Grid action display class.
    |--------------------------------------------------------------------------
    */
    'grid_action_class' => \Encore\Admin\Grid\Displayers\DropdownActions::class,
    'extension_dir' => app_path('Admin/Extensions'),
    'extensions' => [
        'api-tester' => [
            'prefix' => 'api',
            'guard'  => 'api',
            // 'user_retriever' => function ($id) {
            //     return \App\User::find($id);
            // },
        ],
        'file-manager' => [
            'disk' => 'public'
        ],
        'media-manager' => [
            'disk' => 'public'
        ],
        'ueditor' => [
            'enable' => true,
            'config' => [
                'initialFrameHeight' => 400, // 例如初始化高度
            ],
            // 'field_type' => 'xxxEditor',
        ],
        'wang-editor' => [
            'enable' => true,
            'config' => [
                'uploadImgServer' => '/upload'
            ]
        ],
        'json-editor' => [
            'enable' => true,
            'config' => [
                'mode' => 'tree',
                'modes' => ['code', 'form', 'text', 'tree', 'view'], // allowed modes
            ],
        ],
        'simditor' => [
            'enable' => true,
            'config' => [
                'upload' => [
                    'url' => '/admin/api/upload', # example api route: admin/api/upload
                    'fileKey' => 'upload_file',
                    'connectionCount' => 3,
                    'leaveConfirm' => 'Uploading is in progress, are you sure to leave this page?'
                ],
                'tabIndent' => true,
                'toolbar' => ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment'],
                'toolbarFloat' => true,
                'toolbarFloatOffset' => 0,
                'toolbarHidden' => false,
                'pasteImage' => true,
                'cleanPaste' => false,
            ]
        ],
        'tencent-map' => [
            'enable' => true,
            'api_key' => env('TENCENT_MAP_API_KEY')
        ],
        'latlong' => [
            'enable' => true,
            'default' => 'google',
            'providers' => [
                'google' => [
                    'api_key' => '',
                ],
                'yadex' => [
                    'api_key' => '',
                ],
                'baidu' => [
                    'api_key' => 'xck5u2lga9n1bZkiaXIHtMufWXQnVhdx',
                ],
                'tencent' => [
                    'api_key' => 'VVYBZ-HRJCX-NOJ4Z-ZO3PU-ZZA2J-QPBBT',
                ],
                'amap' => [
                    'api_key' => '3693fe745aea0df8852739dac08a22fb',
                ],
            ]
        ],
        'multi-language' => [
            'enable' => true,
            'languages' => [
                'en' => 'English',
                'zh-CN' => '简体中文',
            ],
            'default' => 'zh-CN',
        ],
        'echarts' => [
            'enable' => true,
        ],
        'composer-viewer' => [
            'enable' => true,
        ],
        'env-manager' => [
            'enable' => true
        ],
        'phpinfo' => [
            'enable' => true,
            'what' => INFO_ALL,
            //'path' => '~phpinfo',
        ],
        'python-editor' => [
            'enable' => true,
            'config' => [
            ]
        ],
        'php-editor' => [
            'enable' => true,
            'config' => [
            ]
        ],
        'js-editor' => [
            'enable' => true,
            'config' => [
            ]
        ],
        'css-editor' => [
            'enable' => true,
            'config' => [
            ]
        ],
    ],
];
// $form->UEditor('content');
// $form->UEditor('content')->options(['initialFrameHeight' => 800]);
// $form->xxxEditor('content');

// $form->editor('content');
// public function upload(\Illuminate\Http\Request $request) {
//     $urls = [];

//     foreach ($request->file() as $file) {
//         $urls[] = \Illuminate\Support\Facades\Storage::url($file->store('images'));
//     }

//     return [
//         "errno" => 0,
//         "data"  => $urls,
//     ];
// }

// $form->json('content');

// $form->simditor('content');

// $form->lodpod_editor('data', __('Data'))
//     ->config([
//         'widthField'     =>'width',
//         'heightField'    =>'height',
//         'backgroundField'=>'background'
//     ])
//     ->fields([
//         [
//             'id'=>'sender', 
//             'text'=>trans('admin.lodpod_editor.sender')
//         ], [
//             'id'=>'sender_mobile',
//             'text'=>trans('admin.lodpod_editor.sender_mobile')
//         ], [
//             'id'=>'sender_address',
//             'text'=>trans('admin.lodpod_editor.sender_address')
//         ], [
//             'id'=>'sender_company',
//             'text'=>trans('admin.lodpod_editor.sender_company')
//         ], [
//             'id'=>'sender_zip_code',
//             'text'=>trans('admin.lodpod_editor.sender_zip_code')
//         ],
//     ]);

// $form->tencentMap('latitude', 'longitude', '经纬度');
// $form->tencentMap('latitude', 'longitude', '经纬度')->height(500);
// $form->tencentMap('latitude', 'longitude', '经纬度')->zoom(13);
// $form->tencentMap('latitude', 'longitude', '经纬度')->default(['lat' => 90, 'lng' => 90]);

// $form->latlong('latitude', 'longitude', 'Position');
// $form->latlong('latitude', 'longitude', 'Position')->height(500);
// $form->latlong('latitude', 'longitude', 'Position')->default(['lat' => 90, 'lng' => 90]);
// $show->field('Position')->latlong('lat_column', 'long_column', $height = 400); // show

// $form->python('code');
// $form->python('code')->height(500);
// $form->python('code')->version(2);

// $form->php('code');
// $form->php('code')->height(500);

// $form->js('code');
// $form->javascript('code');
// $form->json('code');
// $form->jsond('code');
// $form->typescript('code');
// $form->js('code')->height(500);

// $form->css('code');
// $form->scss('code');
// $form->less('code');
// $form->css('code')->height(500);