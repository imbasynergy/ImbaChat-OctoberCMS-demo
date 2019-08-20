<?php

Route::post('imbachat/api/v1/auth_users', 'ImbaSynergy\imbachatwidget\Controllers\apiChat@authUser');
Route::get('imbachat/api/v1/users/{ids}', 'ImbaSynergy\imbachatwidget\Controllers\apiChat@getuser');
Route::get('imbachat/api/v1', 'ImbaSynergy\imbachatwidget\Controllers\apiChat@getApiVersion');
Route::get('imbachat/api/v1/search/{key}', 'ImbaSynergy\imbachatwidget\Controllers\apiChat@search');
 
Route::get('imbachat/jwt', 'ImbaSynergy\imbachatwidget\Components\ImbaChat@getJWT');
 