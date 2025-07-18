<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMajorRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:10|unique:majors,short_name,' . $this->route('major')->id,
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama jurusan wajib diisi.',
            'name.string' => 'Nama jurusan harus berupa teks.',
            'name.max' => 'Nama jurusan maksimal 255 karakter.',
            'short_name.required' => 'Nama singkat jurusan wajib diisi.',
            'short_name.string' => 'Nama singkat jurusan harus berupa teks.',
            'short_name.max' => 'Nama singkat jurusan maksimal 10 karakter.',
            'short_name.unique' => 'Nama singkat jurusan sudah digunakan.',
        ];
    }
}