<?php

Route::get('imbachat/api/v1/users/{ids}', 'ImbaSynergy\imbachatwidget\Controllers\apiChat@getuser');
Route::post('imbachat/api/v1/auth_users', 'ImbaSynergy\imbachatwidget\Controllers\apiChat@authUser');
Route::get('imbachat/jwt', 'ImbaSynergy\imbachatwidget\Components\ImbaChat@getJWT');

?>