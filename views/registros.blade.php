@extends ('adminsite.layout')
 
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
     <strong>Usuario registrado con éxito</strong> CMS...
    </div>
   @endif

   @if($status=='ok_delete')
    <div class="alert alert-danger">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     <strong>Usuario eliminado con éxito</strong> CMS...
    </div>
   @endif

   @if($status=='ok_update')
    <div class="alert alert-warning">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     <strong>Usuario actualizado con éxito</strong> CMS...
    </div>
   @endif
  </div>

  <div class="container">
   <div class="block full">
    
    <div class="block-title">
     <h2><strong>Eventos</strong> Registrados</h2>
    </div>

    <div class="table-responsive">
     <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
      <thead>
       <tr>
        <th class="text-center">Imagen</th>
        <th class="text-center">Evento</th>
        <th>Lugar</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Usuario</th>
     
       </tr>
      </thead>
      
      <tbody>
       @if($registros)
        @foreach($registros as $registros)
         <tr>
          <td class="text-center" style="width:1%"><img src="{{$registros->imagen}}" class="img-responsive" alt="Image"></td>
          <td class="text-center">{{$registros->title}}</td>
          <td>{{$registros->lugar}}</td>
          <td>{{$registros->start_old}}</td>
          <td>{{$registros->end_old}}</td>
          <td>{{$registros->usuario_id}}</td>
          
         </tr>
        @endforeach
        @else
         <div class="alert alert-danger fade in">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
           <strong>NO</strong> Se Encontraron Usuarios Regristrados.</div>
        @endif
      </tbody>
     </table>
    </div>
              
   </div>
  </div>

  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="/adminsite/js/pages/tablesDatatables.js"></script>
  <script>$(function(){ TablesDatatables.init(); });</script>
@stop