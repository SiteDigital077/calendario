<?php

namespace DigitalsiteSaaS\Calendario;

use Illuminate\Support\ServiceProvider;

class CalendarioServiceProvider extends ServiceProvider{
 public function register(){
  $this->app->bind('caledario', function($app) {
  return new Calendario;
  });
 }

 public function boot(){
  require __DIR__ . '/Http/routes.php';
  $this->loadViewsFrom(__DIR__ . '/../views', 'calendario');
  $this->publishes([
   __DIR__ . '/migrations/2015_07_25_000000_create_usuario_table.php' => base_path('database/migrations/2015_07_25_000000_create_usuario_table.php'),
  ]);
  }
 }
