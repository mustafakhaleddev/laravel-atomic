<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'AtomicController@index')->name('dashboard');
Route::redirect('/atomicModel/', '/');
Route::get('/atomicModel/{model}', 'AtomicModelController@AtomicModelIndex')->name('AtomicModelIndex');
Route::get('/atomicModel/{model}/create', 'AtomicModelController@NewAtomicModel')->name('NewAtomicModel');
Route::post('/atomicModel/{model}/', 'AtomicModelController@AtomicModelStore')->name('AtomicModelStore');
Route::get('/atomicModel/{model}/datatable', 'AtomicModelController@ModelDatatable')->name('datatable');
Route::get('/atomicModel/{model}/{id}', 'AtomicModelController@AtomicModelView')->name('AtomicModelView');
Route::get('/atomicModel/{model}/{id}/edit', 'AtomicModelController@AtomicModelEdit')->name('AtomicModelEdit');
Route::get('/atomicModel/{model}/{id}/unset/{column}', 'AtomicModelController@AtomicUnsetModelColumn')->name('AtomicUnsetModelColumn');
Route::get('/atomicModel/{model}/{id}/delete', 'AtomicModelController@AtomicModelDelete')->name('AtomicModelDelete');
Route::put('/atomicModel/{model}/{id}/edit', 'AtomicModelController@AtomicModelUpdate')->name('AtomicModelUpdate');
Route::get('/atomicModel/{model}/{id}/actions/{action}', 'AtomicModelController@AtomicModelAction')->name('AtomicModelAction');
