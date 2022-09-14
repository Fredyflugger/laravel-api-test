<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class NotebookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Описываем и возвращаем JSON
        return [
            'id' => $this->id,
            'name' => $this->name,
            'company' => $this->company,
            'phone' => $this->phone,
            'email' => $this->email,
            'birthDate' => $this->birth_date,
            'photo' => $this->photo,
        ];
    }
}
