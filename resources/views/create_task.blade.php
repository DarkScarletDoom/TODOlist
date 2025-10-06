<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <!-- Основной контент bg-wh листа -->
        <div>
            <!-- Форма добавления задачи -->
            <div class="lg:col-span-1">
                <div class="rounded-xl border border-neutral-200 bg-zinc-50 dark:bg-zinc-900 p-6 dark:border-neutral-700 dark:bg-neutral-800">
                    <h2 class="mb-6 text-lg font-semibold text-neutral-900 dark:text-white">Добавить задачу</h2>

                    <form class="space-y-4" action="{{ route('tasks.store') }}" method="POST">
                        @csrf

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
                                value="{{ old('title') }}"
                                required
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
                            >{{ old('description') }}</textarea>
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
                                required
                            >
                                <option value="">Выберите приоритет</option>
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Низкий</option>
                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Средний</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Высокий</option>
                            </select>
                            @error('priority')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="w-full rounded-lg bg-blue-600 px-4 py-2 font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600"
                        >
                            Добавить задачу
                        </button>
                    </form>
                </div>
            </div>
</x-layouts.app>
