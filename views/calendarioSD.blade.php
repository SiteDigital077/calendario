@extends ('adminsite.layout')

 @section('cabecera')
  @parent
   {{ Html::style('modulo-calendario/css/calendar.css') }}
    <style type="text/css">
     @foreach($tiposweb as $tiposweb)
      #{{$tiposweb->slug}}{
      background-color:{{ $tiposweb->color }} !important;
      }
     @endforeach
    </style>
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
     <li>
       <a href="/gestion/registro/eventos"><i class="fa fa-calendar-plus-o"></i>Registro Evento</a>
      </li>
    </ul>
   </div>

   <div class="container">
    <?php $status=Session::get('status');?>
     @if($status=='ok_create')
      <div class="alert alert-success">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
       <strong>Evento registrado con exito</strong>
      </div>
     @endif

     @if($status=='ok_delete')
      <div class="alert alert-danger">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
       <strong>Evento eliminado con exito</strong>
      </div>
     @endif

     @if($status=='ok_update')
      <div class="alert alert-warning">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
       <strong>Evento actualizado con exito</strong>
      </div>
     @endif
   </div>

   <div class="container">
    <div class="page-header">
     <div class="pull-right form-inline">
      <div class="btn-group">
        <button class="btn btn-warning" data-calendar-nav="prev"><< Prev</button>
        <button class="btn btn-default" data-calendar-nav="today">Hoy</button>
        <button class="btn btn-warning" data-calendar-nav="next">Next >></button>
      </div>
      <div class="btn-group">
        <button class="btn btn-warning" data-calendar-view="year">Año</button>
        <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
        <button class="btn btn-warning" data-calendar-view="week">Semana</button>
        <button class="btn btn-warning" data-calendar-view="day">Dia</button>
      </div>
     </div>
 
     <h3></h3>
     <small>Calendario Digital</small>
    </div>
    
    <div id="calendar"></div>
   </div>

 <footer>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  {{ Html::script('modulo-calendario/js/jquery.min.js') }}
  {{ Html::script('modulo-calendario/js/bootstrap.min.js') }}
  <script type="text/javascript">
   $(function () {
    $('#datetimepicker8').datetimepicker();
    $('#datetimepicker7').datetimepicker();
    $('#datetimepicker9').datetimepicker();
    $("#datetimepicker8").on("dp.change",function (e) {
    $("#datetimepicker7").on("dp.change",function (e) {
    $('#datetimepicker9').data("DateTimePicker").setMinDate(e.date);});
    $("#datetimepicker9").on("dp.change",function (e) {
    $('#datetimepicker8').data("DateTimePicker").setMaxDate(e.date);
    $('#datetimepicker7').data("DateTimePicker").setMaxDate(e.date);
    });
    });
    });
  </script>

  {{ Html::script('modulo-calendario/js/underscore-min.js') }}
  {{ Html::script('modulo-calendario/js/jstz.min.js') }}
  {{ Html::script('modulo-calendario/js/es-ES.js') }}
  {{ Html::script('modulo-calendario/js/calendar.js') }}
  {{ Html::script('modulo-calendario/js/apps.js') }}
  {{ Html::script('modulo-calendario/js/moment.min.js') }}
  {{ Html::script('modulo-calendario/js/bootstrap-datetimepicker.min.js') }}
  {{ Html::script('modulo-calendario/js/datetime.js') }}
  {{ Html::script('modulo-calendario/js/validator.js') }}
  {{ Html::script('//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js') }}
 </footer>
@stop

