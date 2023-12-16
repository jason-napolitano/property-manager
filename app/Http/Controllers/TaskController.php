<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests;
use App\Models\Task;
use Illuminate\Http;
use Inertia\Response;

class TaskController extends Controller
{
    public function index(): Response
    {
        $tasks = Task::withTrashed()->paginate(env('APP_DEFAULT_PAGINATION'));
        $categories = Category::withoutTrashed()->get();

        foreach ($tasks as $task) {
            $task['category'] = $task->category;
        }

        return inertia('dashboard/tasks/index', [
            'categories' => $categories,
            'tasks'      => $tasks,
        ]);
    }

    public function show(Task $task): Response
    {
        return inertia('dashboard/tasks/show', [
            'task' => $task
        ]);
    }

    public function store(Requests\CreateTaskRequest $request): Http\RedirectResponse
    {
        $request->validated();

        Task::create([
            'description' => $request['description'],
            'category_id' => $request['category_id'],
            'exemptable'  => $request['exemptable'] ?? false,
            'price'       => $request['price'],
            'name'        => $request['name'],
        ]);

        return back();
    }

    public function update(Requests\UpdateTaskRequest $request, Task $task): Http\RedirectResponse
    {
        return back();
    }

    public function destroy(Task $task): Http\RedirectResponse
    {
        $task->delete();
        return back();
    }

    public function restore(Task $task): Http\RedirectResponse
    {
        $task->restore();
        return back();
    }
}
