<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Http\Requests\TaskFormRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index(Request $request, TaskService $service)
    {
        return $service->userTasks($request->all());
    }

    public function store(TaskFormRequest $request,TaskService $service)
    {
        $task =  $service->create($request->validated());

        event(new TaskCreated($task));

        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return ['success' => true];
    }

    public function setStatus(Task $task,$status)
    {
        $task->update(['status' => $status]);
        Log::info($task);
        return $task;
    }
}
