<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
});

Route::prefix('products')->group(function () {
    Route::post('submit', 'ProductController@submit');
});