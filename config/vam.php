<?php

return [
    /* customization */
    'custom_controller_namespace' => 'App\Http\Controllers\Admin',
    'custom_controller_dir' => 'Http/Controllers/Admin',
    /* end customization */

    'hidden_auth_route_names' => [
        'password_email' => false,
        'password_request' => false,
        'password_reset' => false,
        'password_confirm' => false,
        'login' => false,
        'register' => false,
        'logout' => false,
    ],

    'model_namespace' => 'app',
    'controller_namespace' => '\Wikichua\VAM\Http\Controllers',
    'api_route_dir' => 'routes/routers',
    'vue_route_dir' => 'js/routers',
    'routes_dir' => 'routes/web.php',
    'models' => [
        'user' => '\App\User',
        'role' => '\Wikichua\VAM\Models\Role',
        'permission' => '\Wikichua\VAM\Models\Permission',
        'setting' => '\Wikichua\VAM\Models\Setting',
        'activity_log' => '\Wikichua\VAM\Models\ActivityLog',
    ],
    'stub_path' => 'vendor/wikichua/vam/stubs',
];