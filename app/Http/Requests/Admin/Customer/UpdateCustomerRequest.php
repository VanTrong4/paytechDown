<?php

namespace App\Http\Requests\Admin\Customer;


class UpdateCustomerRequest extends CreateCustomerRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email',  'max:255', 'unique:customers,email,' . $this->route('customer')->id],
        ];
    }
}
