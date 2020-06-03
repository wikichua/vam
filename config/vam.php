<?php

return [
    /* customization */
    'custom_controller_namespace' => 'App\Http\Controllers\Admin',
    'custom_controller_dir' => 'Http/Controllers/Admin',
    /* end customization */

    // 'namespace' => "\Wikichua\VAM",
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