<?php

Route::get('/', function (){
    return view('home');
})->middleware("auth");
Route::any('{slug}', function(){
    return view('welcome');
});


////Route::get("{any}", function(){
////    return "call";
////})->where("any", ".*");
///
Route::get('{path}', function (){
    return view('welcome');
})->where('path','([A-z\d\-\/_.]+)?');
//
//
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//



Route::get("/storage", function (){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return "storage linked";
});
