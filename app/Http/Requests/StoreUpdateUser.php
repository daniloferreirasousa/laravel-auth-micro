<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUser extends FormRequest
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
        $uuid = $this->uuid;

        $rules = [
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', "unique:users,email,{$uuid},uuid"],
            'password'  => ['required', 'min:4', 'max:16'],
        ];

        if($this->method() == 'PUT') {
            $rules['password'] = ['nullable', 'min:4', 'max:16'];
        }

        return $rules;
    }
}
