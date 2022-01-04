<?php

namespace DigitalsiteSaaS\Calendario\Http;
use DigitalsiteSaaS\Calendario\Calendar;
use DigitalsiteSaaS\Calendario\Tipo;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Input;
use Illuminate\Support\Str;
use DB;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\HostnameRepository;
use Hyn\Tenancy\Repositories\WebsiteRepository;
use Session;
use Illuminate\Http\Request;
class CalendarioController extends Controller{

protected $tenantName = null;

 public function __construct(){
 

  $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
        if ($hostname){
            $fqdn = $hostname->fqdn;
            $this->tenantName = explode(".", $fqdn)[0];
        }

 }

 public function index(){
  if(!$this->tenantName){
  $tiposweb = Calendar::join('tipo_evento','tipo_evento.tipo','=','events.class')
  ->get();
  }else{
  $tiposweb = \DigitalsiteSaaS\Calendario\Tenant\Calendar::join('tipo_evento','tipo_evento.tipo','=','events.class')
  ->get();
  }

  return view('calendario::calendarioSD')->with('tiposweb', $tiposweb);
 }

 public function majo() {
 {$my_id = Auth::user()->id;
  if(!$this->tenantName){
 $calendario = \DigitalsiteSaaS\Usuario\Usuario::find($my_id)->Events;
 }else{
 $calendario = \DigitalsiteSaaS\Usuario\Tenant\Usuario::find($my_id)->Events;
 }
 echo json_encode(
 array(
 "success"=> 1,
 "result"=>$calendario));}
 }

 public function tipos(){
  if(!$this->tenantName){
  $tipos = Tipo::all();
  }else{
  $tipos = \DigitalsiteSaaS\Calendario\Tenant\Tipo::all();
  }
  return view('calendario::tipos')->with('tipos', $tipos);
 }

 public function create(){
  date_default_timezone_set('America/Bogota');
   if(!$this->tenantName){
   $calendario = new Calendar;
   }else{
   $calendario = new \DigitalsiteSaaS\Calendario\Tenant\Calendar;
   }
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
  if(!$this->tenantName){
  $calendario = new Tipo;
  }else{
  $calendario = new \DigitalsiteSaaS\Calendario\Tenant\Tipo;
  }
  $calendario->tipo = Input::get('tipo');
  $calendario->color = Input::get('color');
  $calendario->save();
  return Redirect('gestion/tipos/calendario')->with('status', 'ok_create');
 }

 public function updatetipo($id) {
  $input = Input::all();
  if(!$this->tenantName){
  $calendario = Tipo::find($id);
  }else{
  $calendario = \DigitalsiteSaaS\Calendario\Tenant\Tipo::find($id);
  }
  $calendario->tipo = Input::get('tipo');
  $calendario->color = Input::get('color');
  $calendario->save();
  return Redirect('/gestion/tipos/calendario')->with('status', 'ok_update');
 }

 public function editipo($id){
  if(!$this->tenantName){
  $tipos = Tipo::find($id);
  }else{
  $tipos = \DigitalsiteSaaS\Calendario\Tenant\Tipo::find($id); 
  }
  return view('calendario::editar-tipo')->with('tipos', $tipos);
 }

 public function edit($id){
  if(!$this->tenantName){
  $eventos = Tipo::join('events','events.class','=','tipo_evento.tipo')
  ->where('events.id','=',$id)->get();
  }else{
  $eventos = \DigitalsiteSaaS\Calendario\Tenant\Tipo::join('events','events.class','=','tipo_evento.tipo')
  ->where('events.id','=',$id)->get();
  }
  return view('calendario::editar')->with('eventos', $eventos);
 }

 public function editar($id){
  if(!$this->tenantName){
  $eventos = Calendar::join('tipo_evento','events.class','=','tipo_evento.tipo')
  ->where('events.id','=',$id)->get();
  $tipos = Tipo::all();
  }else{
  $eventos = \DigitalsiteSaaS\Calendario\Tenant\Calendar::join('tipo_evento','events.class','=','tipo_evento.tipo')
  ->where('events.id','=',$id)->get();
  $tipos = \DigitalsiteSaaS\Calendario\Tenant\Tipo::all(); 
  }
  return view('calendario::editar-evento')->with('eventos', $eventos)->with('tipos', $tipos);
 }

 public function delete($eventos_id) {
  if(!$this->tenantName){
  $eventos = Calendar::find($eventos_id);
  }else{
  $eventos = \DigitalsiteSaaS\Calendario\Tenant\Calendar::find($eventos_id);  
  }
  $eventos->delete();
  return Redirect('gestion/calendario')->with('status', 'ok_delete');
 }

 public function deletetipo($id) {
  if(!$this->tenantName){
  $eventos = Tipo::find($id);
  }else{
  $eventos = \DigitalsiteSaaS\Calendario\Tenant\Tipo::find($id); 
  }
  $eventos->delete();
  return Redirect('gestion/tipos/calendario')->with('status', 'ok_delete');
 }
 
 public function update($id) {
  $input = Input::all();
  if(!$this->tenantName){
  $calendario = Calendar::find($id);
  }else{
  $calendario = \DigitalsiteSaaS\Calendario\Tenant\Calendar::find($id); 
  }
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


 public function creareventoweb(){
  if(!$this->tenantName){
   $tipos = Tipo::all();
 }else{
   $tipos = \DigitalsiteSaaS\Calendario\Tenant\Tipo::all();
 }
  return View('calendario::crear-evento')->with('tipos', $tipos);
 }

 public function actionIndexwebevento()
    {
        if($_POST)
        {
            Session::put('start', Input::get('start'));
            Session::put('end', Input::get('end'));
            Session::put('tipo', Input::get('tipo'));
            $redireccion =  Input::get('redireccion');
            if($redireccion == ''){
            return redirect('/');
            }
            else{
            return redirect($redireccion);
           }
        }  
    }


 

}