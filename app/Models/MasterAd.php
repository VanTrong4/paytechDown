<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterAd extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'code',
    'name',
    'remarks',
  ];
}
