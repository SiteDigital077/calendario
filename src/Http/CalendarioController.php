<?php

namespace DigitalsiteSaaS\Calendario\Http;
use DigitalsiteSaaS\Calendario\Calendar;
use DigitalsiteSaaS\Calendario\Tipo;
use DigitalsiteSaaS\Calendario\Empleado;
use DigitalsiteSaaS\Calendario\Informacion;
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
  $eventos = Tipo::join('events','events.class','=','tipo_evento.tipo')->where('events.id','=',$id)->get();
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


 

 public function nomina(){
  
  return View('calendario::nomina');
 }

 public function empleados(){
  

  if(!$this->tenantName){
   $empleados = Empleado::leftjoin('informacion','empleados.id','=','informacion.empleado_id')
   ->select("empleados.id","empleados.created_at","empleados.nombre","empleados.cargo","informacion.inicio","informacion.fin","empleados.documento")->get();

 }else{
   $empleados = \DigitalsiteSaaS\Calendario\Tenant\Empleado::leftjoin('informacion','empleados.id','=','informacion.empleado_id')->get();
 }

  return View('calendario::empleados')->with('empleados', $empleados);
 }


public function empleadonuevo(){
  
  return View('calendario::nuevo-empleado');
 }

 public function infolaboral(){
  
  return View('calendario::infolaboral');
 }

 public function desprendible(){
  $datos = Empleado::leftjoin('informacion','empleados.id','=','informacion.empleado_id')->get();

  return View('calendario::desprendible')->with('datos', $datos);
 }


public function crearempleado(){
  date_default_timezone_set('America/Bogota');
   if(!$this->tenantName){
   $empleado = new Empleado;
   }else{
   $empleado = new \DigitalsiteSaaS\Calendario\Tenant\Empelado;
   }
   $empleado->nombre = Input::get('val-nombre');
   $empleado->apellido = Input::get('val-apellido');
   $empleado->correo = Input::get('val-email');
   $empleado->telefono = Input::get('val-telefono');
   $empleado->tipodoc = Input:: get ('val-tipo');
   $empleado->documento = Input:: get ('val-numero');
   $empleado->direccion = Input:: get ('val-direccion');
   $empleado->ciudad = Input:: get ('val-ciudad');
   $empleado->tipago = Input:: get ('valtipo');
   $empleado->banco = Input:: get ('val-banco');
   $empleado->tipocuenta = Input:: get ('val-tipcuenta');
   $empleado->numerocu = Input:: get ('val-cuenta');
   $empleado->save();
   return Redirect('gestion/empleados')->with('status', 'ok_create');
 }




public function crearinformacion(){
  date_default_timezone_set('America/Bogota');
   if(!$this->tenantName){
   $empleado = new Informacion;
   }else{
   $empleado = new \DigitalsiteSaaS\Calendario\Tenant\Informacion;
   }
   $empleado->tipo_contrato = Input::get('val-tipocontrato');
   $empleado->sueldo = Input::get('val-sueldo');
   $empleado->inicio = Input::get('val-inicio');
   $empleado->fin = Input::get('val-fin');
   $empleado->tipo_sueldo = Input:: get ('val-tiposueldo');
   $empleado->tipo_cotizante = Input:: get ('val-tipocot');
   $empleado->salud = Input:: get ('val-salud');
   $empleado->por_salud = Input:: get ('val-porcentajesalud');
   $empleado->pensiones = Input:: get ('val-pensiones');
   $empleado->por_pensiones = Input:: get ('val-porcentajepensiones');
   $empleado->arl = Input:: get ('val-arl');
   $empleado->por_arl = Input:: get ('val-porcentajearl');
   $empleado->caja = Input:: get ('val-caja');
   $empleado->cesantias = Input:: get ('val-cesantias');
   $empleado->empleado_id = Input:: get ('empleado-id');
   $empleado->save();
   return Redirect('gestion/empleados')->with('status', 'ok_create');
 }

}