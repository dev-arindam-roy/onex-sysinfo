<?php

return [

    /**
     * If you want to disable the route for the system information view page
     * 
     * available options: true, false
     * 
     * default: true
     */

    'is_route_enabled' => true, 
    
    
    /**
     * If you want to change the route prefix
     * 
     */
    'route_prefix' => 'onex',
    

    /**
     * If you want to change the route name
     * 
     * default: check-sysinfo
     */
    'route_name' => 'check-sysinfo',


    /**
     * If you want to use a authentication process access the system information view page
     */
    'authentication' => [
        'is_enabled' => env('ONEX_SYSINFO_AUTH_ENABLED', false),
        'login_id' => env('ONEX_SYSINFO_ID', 'onexadmin'),
        'password' => env('ONEX_SYSINFO_PASSWORD', 'onexpassword')
    ]
];