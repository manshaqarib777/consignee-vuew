<?php

use App\Http\Controllers\App\Consignee\ConsigneeController;

Route::group(['prefix' => 'consignees'], function () {

    Route::get('/', [ConsigneeController::class, 'view'])
        ->name('view');
        
});
Route::resource('consignee', ConsigneeController::class);
