<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        $id = $this->route('tag')?->id;
        return [
            'name' => ['required','string','max:50','unique:tags,name'.($id?','.$id:'')],
            'color' => ['nullable','regex:/^#?[0-9a-fA-F]{6}$/'],
        ];
    }
}
