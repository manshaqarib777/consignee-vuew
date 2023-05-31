<?php

use App\Http\Controllers\App\Address\AddressController;

Route::group(['prefix' => 'addresses'], function () {

    Route::get('/', [AddressController::class, 'view'])
        ->name('view');
        
});
Route::resource('address', AddressController::class);
Route::get('/addresses/country', [AddressController::class, 'getCountries']);
Route::get('/addresses/consignee', [AddressController::class, 'getConsignees']);
