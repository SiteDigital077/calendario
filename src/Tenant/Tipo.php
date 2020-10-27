<?php

namespace DigitalsiteSaaS\Calendario\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model{ 

 use UsesTenantConnection;

 protected $table = 'tipo_evento';
 public $timestamps = false;
}