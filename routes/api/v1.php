<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TasksController;

Route::prefix('v1')->group(function () {
//    Route::apiResource('tasks', TasksController::class);
    Route::get('/tasks', [TasksController::class, 'index']);
    Route::post('/tasks', [TasksController::class, 'store']);
    Route::get('/tasks/{id}', [TasksController::class, 'show']);
    Route::put('/tasks/{id}', [TasksController::class, 'update']);
    Route::delete('/tasks/{id}', [TasksController::class, 'destroy']);
    Route::patch('/tasks/{id}', [TasksController::class, 'complete']);
});

?>
