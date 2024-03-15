<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentRequest extends FormRequest
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
            'description' => [
                'string',
                'required'
            ],
            'user_id' => [
                'integer',
                'required',
                Rule::exists(User::class, 'id')
            ],
            'post_id' => [
                'integer',
                'required',
                Rule::exists(Post::class, 'id')
            ]
        ];
    }
}
