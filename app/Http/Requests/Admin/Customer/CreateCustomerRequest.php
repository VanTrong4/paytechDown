<?php

namespace App\Http\Requests\Admin\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateCustomerRequest extends FormRequest
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
          'email' => ['required', 'string', 'email',  'max:255', 'unique:customers'],
          'fullname' => ['required', 'string', 'max:255'],
          'phonenumber' => ['required'],
        ];
    }
    public function messages()
    {
      return
        [
          'fullname'  =>  '※名前を入力してください',
          "email.required" =>  "※メールアドレスが入力されていません",
          "email.email" =>  "※メールアドレスの形式でご入力ください",
          "email.unique" =>  "※メールアドレスが一致しません",
          "phonenumber"  =>  "※携帯番号が入力されていません",
        ];
    }
}
