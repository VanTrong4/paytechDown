<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'prefix',
        'status',
        'customer_id',

        'company_name',
        'prefect',
        'city',
        'company_size',
        'receivable_capital',
        'business_history',
        'number_of_transactions',
        'has_contract',
        'quick_was_used',
        'billing',
        'percent',
        'fundraising_percent',
        'fundraising_price',

        'address',
        'phonenumber',
        'email',
        'company',
        'fullname',
        'amount',
        'format',
        'company_office',
        'company_address',
        'company_other',
        'company_phone_my',
        
        'photo_id_1',
        'photo_id_2',
        'photo_bill',
        'photo_item',
    ];

    protected static function boot() 
    {
        parent::boot();
        static::creating(function ($model) {
            $model->prefix = prefix() ?: 'top';
            $customer = Customer::whereEmail($model->email)->first();
            if(!$customer){
                $customer = Customer::create([
                    'register_date' =>  Carbon::now(),
                    'prefix'  =>  $model->prefix,
                    'email' =>  $model->email,
                    'fullname'  =>  $model->fullname,
                    'phonenumber' =>  $model->phonenumber,
                ]);
            };
            $model->customer_id = $customer->id;
        });
    }

    public function customer()
    {
        return $this -> belongsTo(Customer::class);
    }
}
