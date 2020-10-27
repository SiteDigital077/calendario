@extends ('adminsite.layout')
 @section('cabecera')
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
 @parent
 @stop


 @section('ContenidoSite-01')



 <div class="content-header">
  <ul class="nav-horizontal text-center">
   <li class="active"> 
    <a href="/gestion/calendario"><i class="fa fa-calendar"></i> Calendario</a>
   </li>
   <li>
    <a href="/gestion/crear-evento"><i class="fa fa-calendar-plus-o"></i> Crear Evento</a>
   </li>
   <li>
    <a href="/gestion/tipos/calendario"><i class="fa fa-calendar-o"></i> Tipo Evento</a>
   </li>
  </ul>
 </div>

<div class="container">
  <?php $status=Session::get('status'); ?>
  @if($status=='ok_create')
   <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong> Evento registrado con éxito</strong> CMS...
   </div>
  @endif

  @if($status=='ok_delete')
   <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Evento eliminado con éxito</strong> CMS...
   </div>
  @endif

  @if($status=='ok_update')
   <div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Evento actualizado con éxito</strong> CMS...
   </div>
  @endif

 </div>
 <div class="container">
  <div class="col-md-12">
   <div class="block">
     @foreach($eventos as $eventos)
    <div class="block-title">
     <div class="block-options pull-right">
     </div>
     <h2><strong>Evento</strong> - <span class="text-primary">{{$eventos->title}}</span></h2>
    </div>

     <form class="form-horizontal form-bordered">
      
      <div class="form-group">
       <label class="col-md-3 control-label" for="example-hf-email">Tipo de Evento</label>
        <div class="col-md-9">
         <h5>{{$eventos->tipo}}</h5>
        </div>
      </div>
      
      <div class="form-group">
       <label class="col-md-3 control-label" for="example-hf-password">Fecha Inicio</label>
        <div class="col-md-9">
         <h5>{{$eventos->start_old}}</h5>
        </div>
      </div>
      
      <div class="form-group">
       <label class="col-md-3 control-label" for="example-hf-password">Fecha Finalización</label>
        <div class="col-md-9">
         <h5>{{$eventos->end_old}}</h5>
        </div>
      </div>
      
      <div class="form-group">
       <label class="col-md-3 control-label" for="example-hf-password">Descripción Evento</label>
        <div class="col-md-9">
         <h5>{{$eventos->body}}</h5>
        </div>
      </div>
      
      <div class="form-group form-actions">
       <div class="col-md-9 col-md-offset-3">
         <a type="submit" class="btn btn-sm btn-warning" href="<?=URL::to('gestion/calendario/editar-evento/');?>/{{$eventos->id}}">Editar</a>
        <a type="submit" class="btn btn-sm btn-danger" href="<?=URL::to('gestion/calendario/eliminar/');?>/{{$eventos->id}}" onclick="return confirm('¿Está seguro que desea eliminar el registro?')">Eliminar</a>
       
       </div>
      </div>
     
     </form>
 @endforeach
   </div>
  </div>
 </div>

 <footer>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
 </footer>

@stop