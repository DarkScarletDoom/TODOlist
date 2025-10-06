<x-layouts.app :title="__('Dashboard')">
    @if (session('success'))
        <div id="flash-message" style="
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 15px 20px;
        border-radius: 5px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        max-width: 300px;
        z-index: 9999;
        font-family: Arial, sans-serif;
        font-size: 14px;
    ">
            {{ session('success') }}
            <button onclick="document.getElementById('flash-message').remove()" style="
            background: transparent;
            border: none;
            font-weight: bold;
            font-size: 16px;
            line-height: 1;
            color: #155724;
            float: right;
            cursor: pointer;
            margin-left: 10px;
        ">×</button>
        </div>

        <script>
            setTimeout(() => {
                const flash = document.getElementById('flash-message');
                if (flash) {
                    flash.style.transition = 'opacity 0.5s ease';
                    flash.style.opacity = '0';
                    setTimeout(() => flash.remove(), 500);
                }
            }, 5000);
        </script>
    @endif

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <!-- Статистика -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <!-- Карточка Всего задач -->
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 bg-zinc-50 dark:bg-zinc-900 p-6 dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-blue-100 p-3 dark:bg-blue-900/30">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Всего задач</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $all_tasks_count ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Карточка Выполнено -->
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 bg-zinc-50 dark:bg-zinc-900 p-6 dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-green-100 p-3 dark:bg-green-900/30">
                        <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Выполнено</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $completed_tasks_count ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Карточка высокий приоритет -->
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 bg-zinc-50 dark:bg-zinc-900 p-6 dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-orange-100 p-3 dark:bg-orange-900/30">
                        <svg class="h-6 w-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">С высоким приоритетом</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $high_priority_tasks_count ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Основной контент bg-wh листа -->
        <div>
            <!-- Список задач -->
            <div class="lg:col-span-3">
                <div class="rounded-xl border border-neutral-200 bg-zinc-50 dark:bg-zinc-900 p-6 dark:border-neutral-700 dark:bg-neutral-800">
                    <div class="mb-6 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-neutral-900 dark:text-white">Мои задачи</h2>
                    </div>

                    <!-- Список задач -->
                    <div class="space-y-3">
                        @if($all_tasks_count > 0 && isset($tasks))
                            @foreach($tasks as $task)
                                <div class="rounded-lg border border-neutral-200 bg-zinc-50 dark:bg-zinc-900 p-4 transition-all hover:shadow-sm dark:border-neutral-600 dark:bg-neutral-700/50 {{ $task->completed ? 'border-green-200 bg-green-50 dark:bg-green-900/20 dark:border-green-800' : '' }}">
                                    <div class="flex items-start gap-4">
                                        <!-- Контент задачи -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between gap-2">
                                                <div class="flex items-center gap-2">
                                                    <h3 class="font-medium text-neutral-900 dark:text-white {{ $task->completed ? 'line-through text-neutral-500 dark:text-neutral-400' : '' }}">
                                                        {{ $task->title ?? '' }}
                                                    </h3>

                                                    <!-- Бейдж "Выполнено" -->
                                                    @if($task->completed)
                                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800 dark:bg-green-900/50 dark:text-green-300">
                                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            Выполнено
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="flex items-center gap-2">
                                                    <!-- Бейдж приоритета -->
                                                    @php
                                                        $colors = [
                                                            'high' => 'text-red-600 bg-red-100 dark:bg-red-900/30',
                                                            'medium' => 'text-yellow-600 bg-yellow-100 dark:bg-yellow-900/30',
                                                            'low' => 'text-green-600 bg-green-100 dark:bg-green-900/30',
                                                        ];
                                                        $colorPriority = $colors[$task->priority ?? ''] ?? 'bg-neutral-100 dark:bg-neutral-800';
                                                    @endphp
                                                    <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium {{ $colorPriority }} {{ $task->completed ? 'opacity-70' : '' }}">
                                                        {{ $task->getPriorityNameAttribute() ?? '' }}
                                                    </span>
                                                </div>
                                            </div>

                                            <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400 {{ $task->completed ? 'opacity-60' : '' }}">
                                                {{ $task->description ?? '' }}
                                            </p>

                                            <div class="mt-2 flex items-center gap-4 text-xs text-neutral-500 dark:text-neutral-400 {{ $task->completed ? 'opacity-60' : '' }}">
                                                <span>Создано: {{ $task->created_at ? Carbon\Carbon::create($task->created_at)->format('Y-m-d H:i') : '' }}</span>
                                                @if($task->completed && $task->completed_at)
                                                    <span class="text-green-600 dark:text-green-400 font-medium">
                                                        Выполнено: {{ Carbon\Carbon::create($task->completed_at)->format('Y-m-d H:i') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Действия -->
                                        <div class="flex items-center gap-2">
                                            <!-- Редактирование -->
                                            <a href="{{ route('tasks.edit', $task->id) }}"
                                               class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1.5 text-xs font-medium text-blue-700 transition-all hover:bg-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50 {{ $task->completed ? 'opacity-80' : '' }}"
                                               title="Редактировать задачу">
                                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Изменить
                                            </a>

                                            <!-- Удаление -->
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1 rounded-full bg-red-100 px-3 py-1.5 text-xs font-medium text-red-700 transition-all hover:bg-red-200 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50 {{ $task->completed ? 'opacity-80' : '' }}"
                                                        onclick="return confirm('Вы уверены, что хотите удалить эту задачу?')">
                                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Удалить
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Пустое состояние -->
                            <div class="rounded-lg border border-dashed dark:border-zinc-700 bg-neutral-50 p-8 text-center dark:border-neutral-600 dark:bg-neutral-700/30">
                                <h3 class="mt-4 text-sm font-medium text-neutral-900 dark:text-white">Поле для побед пустует</h3>
                                <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Бросьте вызов самому себе - добавьте первую цель.</p>
                            </div>
                    @endif
                    </div>

                    <!-- Пагинация -->
                    <div class="mt-6 flex items-center justify-between">
                        <!-- Информация о странице -->
                        <div class="text-sm text-neutral-500 dark:text-neutral-400">
                            Показано с {{ $tasks->firstItem() }} по {{ $tasks->lastItem() }} из {{ $tasks->total() }} задач
                        </div>

                        <!-- Кнопки пагинации -->
                        <div class="flex items-center gap-1">
                            <!-- Предыдущая страница -->
                            @if($tasks->onFirstPage())
                                <span class="flex items-center gap-1 rounded-lg border border-neutral-300 bg-neutral-100 px-3 py-2 text-sm font-medium text-neutral-400 dark:border-neutral-600 dark:bg-neutral-700 dark:text-neutral-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                    Назад
                                </span>
                            @else
                                <a href="{{ $tasks->previousPageUrl() }}" class="flex items-center gap-1 rounded-lg border border-neutral-300 bg-white px-3 py-2 text-sm font-medium text-neutral-700 transition-colors hover:bg-neutral-50 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white dark:hover:bg-neutral-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                    Назад
                                </a>
                            @endif

                            <!-- Номера страниц -->
                            <div class="flex items-center gap-1">
                                @foreach($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                                    @if($page == $tasks->currentPage())
                                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600 text-sm font-medium text-white dark:bg-blue-500">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-neutral-300 bg-white text-sm font-medium text-neutral-700 transition-colors hover:bg-neutral-50 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white dark:hover:bg-neutral-600">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Следующая страница -->
                            @if($tasks->hasMorePages())
                                <a href="{{ $tasks->nextPageUrl() }}" class="flex items-center gap-1 rounded-lg border border-neutral-300 bg-white px-3 py-2 text-sm font-medium text-neutral-700 transition-colors hover:bg-neutral-50 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white dark:hover:bg-neutral-600">
                                    Вперед
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @else
                                <span class="flex items-center gap-1 rounded-lg border border-neutral-300 bg-neutral-100 px-3 py-2 text-sm font-medium text-neutral-400 dark:border-neutral-600 dark:bg-neutral-700 dark:text-neutral-500">
                                    Вперед
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
