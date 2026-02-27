<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class employees extends Model
{
   use HasFactory, Notifiable, HasUuids;

   protected $fillable = [
      'name',
      'company_id',
      'email'
   ];

   public $incrementing = false;
   protected $keyType = 'string';

   public function company() {
    return $this->belongsTo(companies::class);
}
}
