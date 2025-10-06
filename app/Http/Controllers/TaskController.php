<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $tasks = $request->user()->tasks();
        $completedCount = $request->user()->tasks()->where('completed', true)->count();
        $highPriorityTasksCount = $request->user()->tasks()->where('priority', Task::PRIORITY_HIGH)->count();
        $tasks = $tasks->paginate(5);

        return view('dashboard', [
            'tasks' => $tasks,
            'all_tasks_count' => $tasks->total(),
            'completed_tasks_count' => $completedCount,
            'high_priority_tasks_count' => $highPriorityTasksCount,
        ]);
    }

    public function create(): View
    {
        return view('create_task');
    }

    public function store(StoreUpdateTaskRequest $request): RedirectResponse
    {
        Task::create([
                'user_id' => Auth::id(),
                ...$request->validated()
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Задача успешно создана!');
    }

    public function edit(int $id): View
    {
        $task = Auth::user()->tasks()->findOrFail($id);

        return view('edit_task', ['task' => $task]);
    }

    public function update(StoreUpdateTaskRequest $request, int $id): RedirectResponse
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        $validated = $request->validated();

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Запись успешно обновлена');
    }

    public function destroy(int $id): RedirectResponse
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Запись успешно удалена');
    }
}
