@extends ('adminsite.layout')
 @section('cabecera')
 @parent
  {{ Html::style('modulo-calendario/css/jquery.minicolors.css') }}
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  
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
     <a href="/gestion/tipos/calendario"><i class="fa fa-calendar-o"></i>Tipo Evento</a>
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
       <h2><strong>Crear</strong> Tipo Evento</h2>
      </div>
                                                                   
       {{ Form::open(array('method' => 'POST','class' => 'form-horizontal','id' => 'defaultForm', 'url' => array('gestion/calendario/crear-tipo'))) }}

        <div class="form-group">
         <label class="col-md-3 control-label" for="example-text-input">Tipo Evento</label>
          <div class="col-md-9">
           {{Form::text('tipo', '', array('class' => 'form-control','placeholder'=>'Ingrese titulo'))}}
          </div>
        </div>

        <div class="form-group">
         <label class="col-md-3 control-label" for="example-password-input">Color</label>
          <div class="col-md-9">
           {{Form::text('color', '', array('id' => 'hue-demo', 'class' => 'form-control demo','data-control'=>'hue'))}}
          </div>
        </div>
        
        <div class="form-group form-actions">
         <div class="col-md-9 col-md-offset-3">
          <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Crear</button>
          <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Cancelar</button>
         </div>
        </div>
        
       {{ Form::close() }}
                                
     </div>
    </div>
   </div>         
  </div>

  {{ Html::script('modulo-calendario/js/jquery.minicolors.min.js') }}
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
    }});});
  </script>

@stop