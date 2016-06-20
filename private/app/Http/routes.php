<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// route::method('path','controller@methodname')
Route::get('/', function () {
    if(Auth::user())
    {
    	if(Auth::user()->hak_akses=='admin')
    	{
    		return view('home');
    	}
    	else
    	{
    		return view('user');
    	}
    }
    else
    {
    	return view('login');
    }
});
Route::get('home','Crudcontroller@home');
Route::get('login', function(){
	if(Auth::user())
    {
    	if(Auth::user()->hak_akses=='admin')
    	{
    		return view('home');
    	}
    	else
    	{
    		return view('user');
    	}
    }
    else
    {
    	return view('login');
    }
});
Route::get('register', function(){
	if(Auth::user())
    {
    	if(Auth::user()->hak_akses=='admin')
    	{
    		return view('home');
    	}
    	else
    	{
    		return view('user');
    	}
    }
    else
    {
    	return view('register');
    }
});
Route::get('user', function()
{
	if(Auth::user())
    {
    	if(Auth::user()->hak_akses=='admin')
    	{
    		return view('home');
    	}
    	else
    	{
    		return view('user');
    	}
    }
    else
    {
    	return view('login');
    }
});
Route::get('logout','Crudcontroller@logout');
Route::post('login','Crudcontroller@login');
Route::post('tambahlogin','Crudcontroller@tambahlogin');
Route::post('prosestambah','Crudcontroller@tambahdata');
Route::get('read', 'Crudcontroller@lihatdata');
Route::get('hapus/{id}','Crudcontroller@hapusdata');
Route::get('formedit/{id}','Crudcontroller@editdata');
Route::post('prosesedit','Crudcontroller@proseseditdata');