<?php

use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(MediaController::class)
    ->prefix('media-uploader')
    ->group(function () {

        Route::middleware('access_token')->group(function () {
            Route::post('/', 'upload');
        });

        // TODO add microservices url check
        Route::get('/', 'getPath');
        Route::get('/validate', 'validatePath');
    });
