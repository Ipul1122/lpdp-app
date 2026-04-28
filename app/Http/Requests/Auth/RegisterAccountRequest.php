<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password; 

class RegisterAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required', 
                'string', 
                'confirmed',
                // Menggunakan objek Password untuk validasi yang lebih kompleks
                Password::min(8)
                    ->letters()   // Wajib ada huruf
                    ->mixedCase() // Wajib ada huruf kapital & kecil
                    ->numbers()   // Wajib ada angka
                    ->symbols(),  // Wajib ada simbol
            ], 
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
            // Tambahkan pesan custom jika diinginkan (opsional)
            'password'          => 'Password harus minimal 8 karakter dan mengandung huruf kapital, angka, serta simbol.',
        ];
    }
}