<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'prefix',
        'register_date',
        'email',
        'fullname',
        'phonenumber',
        'note'
    ];

    protected $casts = [
        'register_date' =>  'date'
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function lastApplication()
    {
      return $this->hasOne(Application::class)->orderBy('created_at', 'DESC');
    }
}
