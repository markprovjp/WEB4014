<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleNhapSV extends FormRequest
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
            'hoten' => ['required', 'min:3', 'max:20'],
            'tuoi' => 'required|integer|min:16|max:100',
            'ngaysinh' => ['required', 'date'],
            'email' => ['required', 'email'],
            'sdt' => ['required', 'regex:/^0[0-9]{9}$/'],
            'diachi' => ['required', 'string'],
            'gioitinh' => ['required', 'in:nam,nu'],
        ];
    }

    public function messages(): array
    {
        return [
            'hoten.required' => 'Họ tên không được để trống',
            'hoten.min' => 'Họ tên phải có ít nhất 3 ký tự',
            'hoten.max' => 'Họ tên không được vượt quá 20 ký tự',
            'tuoi.required' => 'Tuổi không được để trống',
            'tuoi.integer' => 'Tuổi phải là một số nguyên',
            'tuoi.min' => 'Tuổi phải lớn hơn hoặc bằng 16',
            'tuoi.max' => 'Tuổi phải nhỏ hơn hoặc bằng 100',
            'ngaysinh.required' => 'Ngày sinh không được để trống',
            'ngaysinh.date' => 'Ngày sinh không hợp lệ',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'sdt.required' => 'Số điện thoại không được để trống',
            'sdt.regex' => 'Số điện thoại không hợp lệ',
            'diachi.required' => 'Địa chỉ không được để trống',
            'gioitinh.required' => 'Giới tính không được để trống',
            'gioitinh.in' => 'Giới tính không hợp lệ',
        ];
    }

    public function attributes(): array
    {
        return [
            'hoten' => 'Họ tên',
            'tuoi' => 'Tuổi',
            'ngaysinh' => 'Ngày sinh',
            'email' => 'Email',
            'sdt' => 'Số điện thoại',
            'diachi' => 'Địa chỉ',
            'gioitinh' => 'Giới tính',
        ];
    }
}
