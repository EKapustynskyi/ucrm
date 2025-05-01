<?php

use App\Http\Controllers\Api\V1\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
//    Route::apiResource('tasks', TasksController::class);
    Route::get('/tasks', [TasksController::class, 'index']);
    Route::post('/tasks', [TasksController::class, 'store']);
    Route::get('/tasks/{id}', [TasksController::class, 'show']);
    Route::put('/tasks/{id}', [TasksController::class, 'update']);
    Route::delete('/tasks/{id}', [TasksController::class, 'destroy']);
    Route::patch('/tasks/{id}', [TasksController::class, 'complete']);

});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test-check', function () {
    return response()->json(['ok' => true]);
});
