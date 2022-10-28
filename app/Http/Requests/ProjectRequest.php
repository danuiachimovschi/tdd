<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
        ];
    }

    public function createProduct()
    {
        auth()->user()->projects()->create([
            'title' => $this->title,
            'description' => $this->description,
            'id_owner' => auth()->id()
        ]);
    }
}
