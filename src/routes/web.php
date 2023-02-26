<?php

$onexsysRouteEnabled = true;
$onexsysRoutePrefix = 'onex';
$onexsysRouteName = 'check-sysinfo';

$publishedConfigFilePath = config_path('onex-sysinfo.php');
if (file_exists($publishedConfigFilePath)) {
    $onexsysRouteEnabled = !empty(config('onex-sysinfo.is_route_enabled')) ? config('onex-sysinfo.is_route_enabled') : true;
    $onexsysRoutePrefix = !empty(config('onex-sysinfo.route_prefix')) ? config('onex-sysinfo.route_prefix') : '';
    $onexsysRouteName = !empty(config('onex-sysinfo.route_name')) ? config('onex-sysinfo.route_name') : 'check-sysinfo'; 
}

if ($onexsysRouteEnabled) {
    Route::group(['namespace' => 'Onex\Sysinfo\Http\Controllers', 'prefix' => $onexsysRoutePrefix, 'middleware' => ['web']], function() use($onexsysRouteName) {
        Route::get($onexsysRouteName, 'OnexSysinfoController@index');
        Route::post('onexsysinfo-adminaccess', 'OnexSysinfoController@onexsysinfoAdminaccess')->name('onexsysinfoAdminaccess');
        Route::get('onexsysinfo-adminaccess/logout', 'OnexSysinfoController@onexsysinfoAdminLogout')->name('onexsysinfoAdminLogout');
    });
}
