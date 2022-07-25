<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'author' => 'required',
            'content' => 'nullable',
            'rate' => 'nullable',
            'totalpages' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'img' => 'mimes:jpeg,png,jpg',
            'audio' => 'mimes:mp3',
            'tags' => 'nullable',
            'file' => 'mimes:pdf,msword'
        ];
    }
}