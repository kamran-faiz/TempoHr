<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Designation extends Model
{
   protected $fillable =[
    'name',
    'description',
    'department_id',
   ];

   public function department()
{
    return $this->belongsTo(Department::class);
}
}


 
