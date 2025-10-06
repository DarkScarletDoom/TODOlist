<x-layouts.app :title="__('Edit Task')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <!-- Основной контент -->
        <div>
            <!-- Форма редактирования задачи -->
            <div class="lg:col-span-1">
                <div class="rounded-xl border border-neutral-200 bg-zinc-50 dark:bg-zinc-900 p-6 dark:border-neutral-700 dark:bg-neutral-800">
                    <div class="mb-6 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-neutral-900 dark:text-white">Редактировать задачу</h2>
                        <a href="{{ route('tasks.index') }}"
                           class="text-sm text-neutral-500 hover:text-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-300">
                            ← Назад к списку
                        </a>
                    </div>

                    <form class="space-y-4" action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="title" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                Название задачи *
                            </label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="w-full rounded-lg border dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 px-4 py-2 text-neutral-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white dark:focus:border-blue-400 @error('title') border-red-500 dark:border-red-400 @enderror"
                                placeholder="Что нужно сделать?"
                                value="{{ old('title', $task->title) }}"
                            >
                            @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                Описание
                            </label>
                            <textarea
                                name="description"
                                id="description"
                                rows="3"
                                class="w-full rounded-lg border dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 px-4 py-2 text-neutral-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white dark:focus:border-blue-400 @error('description') border-red-500 dark:border-red-400 @enderror"
                                placeholder="Детали задачи..."
                            >{{ old('description', $task->description) }}</textarea>
                            @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="priority" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                Приоритет *
                            </label>
                            <select
                                name="priority"
                                id="priority"
                                class="w-full rounded-lg border dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 px-4 py-2 text-neutral-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white dark:focus:border-blue-400 @error('priority') border-red-500 dark:border-red-400 @enderror"
                            >
                                <option value="">Выберите приоритет</option>
                                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Низкий</option>
                                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Средний</option>
                                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Высокий</option>
                            </select>
                            @error('priority')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="hidden" name="completed" value="0">
                            <input
                                type="checkbox"
                                name="completed"
                                id="completed"
                                value="1"
                                class="rounded dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 text-blue-600 focus:ring-blue-500 dark:border-neutral-600 dark:bg-neutral-700 @error('completed') border-red-500 dark:border-red-400 @enderror"
                                {{ old('completed', $task->completed) ? 'checked' : '' }}
                            >
                            <label for="completed" class="text-sm font-medium text-neutral-700 dark:text-neutral-300">
                                Задача выполнена
                            </label>
                        </div>
                        @error('completed')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <div class="flex gap-3">
                            <button
                                type="submit"
                                class="flex-1 rounded-lg bg-blue-600 px-4 py-2 font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600"
                            >
                                Сохранить изменения
                            </button>
                            <a href="{{ route('tasks.index') }}"
                               class="flex-1 rounded-lg border border-neutral-300 bg-white px-4 py-2 font-medium text-neutral-700 text-center transition-colors hover:bg-neutral-50 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white dark:hover:bg-neutral-600">
                                Отмена
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
