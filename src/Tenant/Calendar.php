<?php

namespace DigitalsiteSaaS\Calendario\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model{

 use UsesTenantConnection;
 protected $table = 'events';
 public $timestamps = true;

 public function users(){
  return $this->belongsTo('Usuario');
 }
}


