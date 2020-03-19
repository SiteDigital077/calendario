<?php

namespace DigitalsiteSaaS\Calendario;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model{
 protected $table = 'events';
 public $timestamps = true;

 public function users(){
  return $this->belongsTo('Usuario');
 }
}