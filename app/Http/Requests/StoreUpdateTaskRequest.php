<?php
declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'min:3'],
            'description' => ['nullable', 'string', 'max:1000'],
            'priority' => ['required', Rule::in(array_keys(Task::getPriorities()))],
            'completed' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле "Название задачи" обязательно для заполнения.',
            'title.string' => 'Название задачи должно быть строкой.',
            'title.max' => 'Название задачи не должно превышать 255 символов.',
            'title.min' => 'Название задачи должно содержать минимум 3 символа.',

            'description.string' => 'Описание должно быть текстом.',
            'description.max' => 'Описание не должно превышать 1000 символов.',

            'priority.required' => 'Поле "Приоритет" обязательно для выбора.',
            'priority.in' => 'Выбран некорректный приоритет.',
        ];
    }
}
