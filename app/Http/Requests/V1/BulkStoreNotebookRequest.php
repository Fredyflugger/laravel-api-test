<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreNotebookRequest extends FormRequest
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
        // Описываем поля которые прийдут в bulk запрос
        return [
            '*.name' => ['required'],
            '*.phone' => ['required'],
            '*.email' => ['required', 'email'],
            '*.birthDate' => ['nullable', 'date_format:Y-m-d H:i:s'],
            '*.photo' => ['nullable'],
            '*.company' => ['nullable'],
        ];
    }
    // записываем данные из JSON birthDate в birth_date. На выходе запись birthDate не отправляется в запросе.
    protected function prepareForValidation() {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj['birth_date'] = $obj['birthDate'];

            $data[] = $obj;
        }

        $this->merge($data);
    }
}
