<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'email' => ['required', 'string', 'email',  'max:255'],
        'password' => ['required', 'string', 'alpha_num',  'min:6',  'max:255'],
        ];
    }
    public function messages()
    {
        return [
        "email.required" =>  "※メールアドレスが入力されていません",
        "email.email" =>  "※メールアドレスの形式でご入力ください",
        "password.required"  =>  "※パスワードが入力されていません",
        "password.min"  =>  "※文字以上入力してください",
        "password.alpha_num"  =>  "※半角数字、英語で入力してください",
        ];
    }
}
