<?php 
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){

Route::get('/dashboard',function(){
    return "welcome Atef From Admin Route file";
});



});
