<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Issue;

class StoreIssueRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'project_id' => ['required','exists:projects,id'],
            'title' => ['required','string','max:255'],
            'description' => ['required','string'],
            'status' => ['required','in:'.implode(',', Issue::STATUSES)],
            'priority' => ['required','in:'.implode(',', Issue::PRIORITIES)],
            'due_date' => ['nullable','date'],
        ];
    }
}
