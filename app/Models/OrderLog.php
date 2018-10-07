<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
   protected $fillable = ['status', 'comments'];

   public $timestamps = false;

   public static function boot()
   {
       parent::boot();

       static::creating(function ($model){
          $model->created_at = Carbon::now();
       });
   }
}
