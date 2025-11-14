<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'gender' => 'required|in:male,female',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'login' => 'required|string|unique:users,login|max:255',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'firstname.required' => 'Имя обязательно для заполнения',
            'lastname.required' => 'Фамилия обязательна для заполнения',
            'gender.required' => 'Выберите пол',
            'email.required' => 'Email обязателен для заполнения',
            'email.unique' => 'Пользователь с таким email уже существует',
            'phone.required' => 'Телефон обязателен для заполнения',
            'login.required' => 'Логин обязателен для заполнения',
            'login.unique' => 'Пользователь с таким логином уже существует',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен быть не менее 6 символов',
        ];
    }
}
