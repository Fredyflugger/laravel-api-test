<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotebookRequest extends FormRequest
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
        $method = $this->method();

        if ($method == 'PUT') {
            // Если метод PUT то все поля придут в запросе.
            return [
                'name' => ['required'],
                'phone' => ['required'],
                'email' => ['required', 'email'],
                'birthDate', ['nullable', 'date_format:Y-m-d H:i:s'],
                'photo', ['nullable'],
                'company', ['nullable'],
            ];
        } else {
            // иначе может быть только метод PATCH. Не все поля могут прийти в запросе.
            return [
                'name' => ['sometimes', 'required'],
                'phone' => ['sometimes', 'required'],
                'email' => ['sometimes', 'required', 'email'],
                'birthDate' => ['sometimes', 'nullable', 'date_format:Y-m-d H:i:s'],
                'photo' => ['sometimes', 'nullable'],
                'company' => ['sometimes', 'nullable'],
            ];
        }
    }

    protected function prepareForValidation() {
        if ($this->birthDate) {
            $this->merge([
                'birth_date' => $this->birthDate
            ]);
        }
    }
}
