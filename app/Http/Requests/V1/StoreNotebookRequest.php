<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotebookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Меняем на true что бы тестировать без авторизации
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // Описываем поля, которые прийдут в запросе.
        return [
            'name' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'birthDate' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'photo' => ['nullable'],
            'company' => ['nullable'],
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'birth_date' => $this->birthDate
        ]);
    }
}
