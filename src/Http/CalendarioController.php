<?php

namespace DigitalsiteSaaS\Calendario\Http;
use DigitalsiteSaaS\Calendario\Calendar;
use DigitalsiteSaaS\Calendario\Tipo;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use DB;

use Illuminate\Http\Request;
class CalendarioController extends Controller{

 public function __construct(){
  $this->middleware('auth');
 }

 public function index(){
  $tiposweb = DB::table('events')
  ->join('tipo_evento','tipo_evento.tipo','=','events.class')
  ->get();
  return view('calendario::calendarioSD')->with('tiposweb', $tiposweb);
 }

 public function majo() {
 {$my_id = Auth::user()->id;
 $calendario = \DigitalsiteSaaS\Usuario\Usuario::find($my_id)->Events;
 echo json_encode(
 array(
 "success"=> 1,
 "result"=>$calendario));}
 }

 public function tipos(){
  $tipos = Tipo::all();
  return view('calendario::tipos')->with('tipos', $tipos);
 }

 public function create(){
  date_default_timezone_set('America/Bogota');
   
   $calendario = new Calendar;
   $calendario->title = Input::get('title');
   $calendario->slug = Str::slug($calendario->title);
   $calendario->body = Input::get('body');
   $calendario->url = Input::get('url');
   $calendario->class = Input::get('class');
   $calendario->end_old = Input:: get ('end');
   $calendario->start_old = Input:: get ('start');
   $calendario->end = strtotime($calendario->end_old).'000';
   $calendario->start = strtotime($calendario->start_old).'000';
   $calendario->usuario_id = Input:: get ('metro');
   $calendario->imagen = Input:: get ('FilePath');
   $calendario->lugar = Input:: get ('lugar');
   $calendario->save();
   return Redirect('gestion/calendario')->with('status', 'ok_create');
 }

 public function createtipo() {
  $calendario = new Tipo;
  $calendario->tipo = Input::get('tipo');
  $calendario->color = Input::get('color');
  $calendario->save();
  return Redirect('gestion/tipos/calendario')->with('status', 'ok_create');
 }

 public function updatetipo($id) {
  $input = Input::all();
  $calendario = Tipo::find($id);
  $calendario->tipo = Input::get('tipo');
  $calendario->color = Input::get('color');
  $calendario->save();
  return Redirect('/gestion/tipos/calendario')->with('status', 'ok_update');
 }

 public function editipo($id){
  $tipos = Tipo::find($id);
  return view('calendario::editar-tipo')->with('tipos', $tipos);
 }

 public function edit($id){
  $eventos = DB::table('tipo_evento')
  ->join('events','events.class','=','tipo_evento.tipo')
  ->where('events.id','=',$id)->get();
  return view('calendario::editar')->with('eventos', $eventos);
 }

 public function editar($id){
  $eventos = DB::table('events')
  ->join('tipo_evento','events.class','=','tipo_evento.tipo')
  ->where('events.id','=',$id)->get();
  $tipos = DB::table('tipo_evento')->get();
  return view('calendario::editar-evento')->with('eventos', $eventos)->with('tipos', $tipos);
 }

 public function delete($eventos_id) {
  $eventos = Calendar::find($eventos_id);
  $eventos->delete();
  return Redirect('gestion/calendario')->with('status', 'ok_delete');
 }

 public function deletetipo($id) {
  $eventos = Tipo::find($id);
  $eventos->delete();
  return Redirect('gestion/tipos/calendario')->with('status', 'ok_delete');
 }
 
 public function update($id) {
  $input = Input::all();
  $calendario = Calendar::find($id);
  $calendario->title = Input::get('title');
  $calendario->slug = Str::slug($calendario->title);
  $calendario->body = Input::get('body');
  $calendario->url = Input::get('url');
  $calendario->class = Input::get('class');
  $calendario->end_old = Input:: get ('end');
  $calendario->start_old = Input:: get ('start');
  $calendario->end = strtotime($calendario->end_old).'000';
  $calendario->start = strtotime($calendario->start_old).'000';
  $calendario->imagen = Input:: get ('FilePath');
  $calendario->usuario_id = Input:: get ('metro');
  $calendario->lugar = Input:: get ('lugar');
  $calendario->save();
  return Redirect('gestion/calendario/editar/'.$calendario->id)->with('status', 'ok_update');
 }

 public function registros(){
  $registros = DB::table('events')
  ->join('comunidad_registro','comunidad_registro.evento_id','=','events.id')
  ->get();
   return view('calendario::registros')->with('registros', $registros);
 }
}