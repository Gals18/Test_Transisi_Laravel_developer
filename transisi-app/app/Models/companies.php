<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class companies extends Model
{
   use HasFactory, Notifiable, HasUuids;

   protected $fillable = [
      'name',
      'email',
      'logo',
      'website'
   ];

   public $incrementing = false;
   protected $keyType = 'string';

   public function employees()
   {
      return $this->hasMany(employees::class);
   }
}
