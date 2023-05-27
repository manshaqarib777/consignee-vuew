<?php

use App\Http\Controllers\App\Crud\CrudController;
use App\Http\Controllers\App\DatatableController;

Route::view('/datatable', 'tables.datatable');

Route::group(['prefix' => 'tables'], function () {

    Route::get('/functional', [CrudController::class, 'view'])
        ->name('functional');
        
});

Route::resource('crud', CrudController::class);

Route::get('/datatable/name', [CrudController::class, 'getNameFromDatatable']);
