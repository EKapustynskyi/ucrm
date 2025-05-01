<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use App\Http\Resources\TasksResource;
use App\Models\Tasks;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TasksResource::collection(Tasks::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTasksRequest $request)
    {
        $tasks = Tasks::create($request->validated());
        return TasksResource::make($tasks);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): TasksResource
    {
        $task = Tasks::find($id);
        if (!$task) {
            // Повертаємо API JSON 404
            abort(response()->json(['message' => 'Task not found'], 404));
        }
        return TasksResource::make($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTasksRequest $request, $id)
    {
//        $tasks = Tasks::update($request->validated());
        $tasks = Tasks::find($id);
        $tasks->update($request->validated());
        return TasksResource::make($tasks);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tasks = Tasks::find($id);
        $tasks->delete();
        $tasks->refresh();
        return response()->noContent();
    }

    public function complete(Request $request, $id)
    {
        $tasks = Tasks::find($id);
        $tasks->is_completed = $request->is_completed;
        $tasks->save();
        return TasksResource::make($tasks);
    }
}
