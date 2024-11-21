<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:100',
            'username' => 'required|string|min:5|max:100|unique:users, username',
            'password' => 'required|string|min:6|max:100',
            'email' => 'required|string|min:5|max:100|email|unique:users, email',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
