<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Izinkan semua tamu (guest) untuk mengakses form ini
        return true; 
    }

    public function rules(): array
    {
        return [
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            // Rule 'confirmed' otomatis akan mencari field 'password_confirmation' di form
            'password' => ['required', 'string', 'min:8', 'confirmed'], 
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 8 karakter.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
        ];
    }
}