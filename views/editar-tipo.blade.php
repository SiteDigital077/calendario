@extends ('adminsite.layout')
 @section('cabecera')
  @parent
   {{ Html::style('EstilosSD/dist/css/jquery.minicolors.css') }}
   <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
   <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  
   <script src="/vendors/ckeditor/ckeditor.js"></script>  
 @stop

 @section('ContenidoSite-01')
 <div class="content-header">
  <ul class="nav-horizontal text-center">
   <li>
    <a href="/gestion/calendario"><i class="fa fa-calendar"></i> Calendario</a>
   </li>
   <li>
    <a href="/gestion/crear-evento"><i class="fa fa-calendar-plus-o"></i> Crear Evento</a>
   </li>
   <li class="active">
    <a href="/gestion/tipos/calendario"><i class="fa fa-calendar-o"></i> Tipo Evento</a>
   </li>
  </ul>
 </div>

 <div class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="block">

     <div class="block-title">
      <div class="block-options pull-right">
      </div>
      <h2><strong>Editar</strong> Tipo Evento</h2>
     </div>
                                  
      {{ Form::open(array('method' => 'POST','class' => 'form-horizontal','id' => 'defaultForm', 'url' => array('gestion/calendario/updatetipo',$tipos->id))) }}

       <div class="form-group">
        <label class="col-md-3 control-label" for="example-text-input">Tipo Evento</label>
         <div class="col-md-9">
          {{Form::text('tipo', $tipos->tipo, array('class' => 'form-control','placeholder'=>'Ingrese titulo'))}}
         </div>
       </div>

       <div class="form-group">
        <label class="col-md-3 control-label" for="example-password-input">Color</label>
         <div class="col-md-9">
          {{Form::text('color', $tipos->color, array('id' => 'hue-demo', 'class' => 'form-control demo','data-control'=>'hue'))}}
         </div>
       </div>
                                       
      <div class="form-group form-actions">
       <div class="col-md-9 col-md-offset-3">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Editar</button>
        <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Cancelar</button>
       </div>
      </div>
     
     {{ Form::close() }}
                                
    </div>
   </div>
  </div>                     
 </div>

 @foreach ($tipos as $tipos) 
 @endforeach

 {{ Html::script('EstilosSD/dist/js/jquery.minicolors.min.js') }}
 <script type="text/javascript">
  $(function(){
  var colpick = $('.demo').each( function() {
    $(this).minicolors({
      control: $(this).attr('data-control') || 'hue',
      inline: $(this).attr('data-inline') === 'true',
      letterCase: 'lowercase',
      opacity: false,
      change: function(hex, opacity) {
        if(!hex) return;
        if(opacity) hex += ', ' + opacity;
        try {
          console.log(hex);
        } catch(e) {}
        $(this).select();
      },
      theme: 'bootstrap'
    });
  });
  
  var $inlinehex = $('#inlinecolorhex h3 small');
  $('#inlinecolors').minicolors({
    inline: true,
    theme: 'bootstrap',
    change: function(hex) {
      if(!hex) return;
      $inlinehex.html(hex);
    }
   });
  });
 </script>
@stop