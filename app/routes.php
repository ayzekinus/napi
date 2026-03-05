<?php

Route::get('/', 'index@home');
Route::get('/index/home', 'index@home');

Route::Controller('/index', 'index');
Route::Controller('/post', 'post');
Route::Controller('/tools', 'tools');
Route::Controller('/rapor', 'rapor');
//Route::Controller('/giris', 'giris');

Route::ajax('/giris/kontrol', 'giris@kontrol');

//Route::getRoutes();
