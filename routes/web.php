<?php
use Illuminate\Support\Facades\Storage;



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

// normaly this would be a get request as well but we have data coming in

$router->group(['prefix' => 'data'], function ($router) {
    
    $router->post('/', 'DataController@show');
    $router->get('/labels', 'DataController@index');
});

$router->get('/{route:.*}/', function () {
    $data = Storage::get('/data.txt');
    return view('app', compact('data'));
});