<?php

use App\Http\Controllers\API\V1\ArticleController;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\AuthorController;
use App\Http\Controllers\API\V1\BlogController;
use App\Http\Controllers\API\V1\TestController;
use Illuminate\Http\Request;
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

Route::group(['prefix' => 'v1', 
  'middleware' => ['auth:sanctum'],
], function() {
   
    // Articles 
    Route::apiResource('articles', ArticleController::class);

    // Test Alanıdır 
    Route::apiResource('test', TestController::class);

    // Test için yapılmıştır 
    Route::apiResource('blog', BlogController::class);


    Route::get('/blogTest/{blog}/{name}', [BlogController::class, 'tekBlogGetir']);


    /**
     * {test} parametresi adı ile model dosyasının adi ile aynı olmak zorunda ve 
     * test parametresi mutlaka id almalı eğer id ile eşleştirilmek istenmeze 
     * ozaman routerservice providerındaki bind methodu kullanılabilir.
     */
    Route::get('/test/{test}/{name}', [TestController::class, 'test']);


    // Authors
    Route::get('/authors/{user}', [AuthorController::class,'show'])->name('authors');

    Route::post('/auth/login', [AuthController::class, 'loginUser']);

});

