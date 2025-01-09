<?php

use Illuminate\Support\Facades\Route;
use Lightit\Backoffice\Employee\App\Controllers\ListEmployeeController;
use Lightit\Backoffice\Employee\App\Controllers\StoreEmployeeController;
use Lightit\Backoffice\Task\App\Controllers\ListTaskController;
use Lightit\Backoffice\Task\App\Controllers\GetTaskController;
use Lightit\Backoffice\Task\App\Controllers\StoreTaskController;
use Lightit\Backoffice\Task\App\Controllers\UpdateTaskController;
use Lightit\Shared\App\Exceptions\InvalidActionException;


// Frontend Routes
Route::view('/', 'layouts.app');

Route::prefix('employees')->name('employees.')->group(static function () {
    Route::get('/', ListEmployeeController::class)->name('index');
    Route::post('/', StoreEmployeeController::class)->name('store');
});

Route::prefix('tasks')->name('tasks.')->group(static function () {
    Route::get('/', ListTaskController::class)->name('index');
    Route::post('/', StoreTaskController::class)->name('store');
    Route::get('/{task}', GetTaskController::class)->name('show');
    Route::patch('/{task}', UpdateTaskController::class)->name('update');
});


Route::get('invalid', static fn() => throw new InvalidActionException("Is not valid"));

Route::get('{unknown}', static fn() => view('layouts.app'))->where('unknown', '^(?!api).*$');
