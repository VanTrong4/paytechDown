<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'prefix',
        'email',
        'fullname',
        'phonenumber',
        'note'
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
