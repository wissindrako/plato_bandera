@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')


<section  id="contenido_principal">

<div class="box box-primary box-white">

     <div class="box-header">
        <h4 class="box-title">Visitantes</h4>	        
        <form   action="{{ url('reporte_usuarios') }}"  method="post"  >
			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
			{{-- <div class="input-group input-group-sm">
				<input type="text" class="form-control" value="" id="dato_buscado" name="dato_buscado" required>
				<span class="input-group-btn">
				<input type="submit" class="btn btn-primary" value="buscar" >
				</span>
			</div> --}}
		</form>
{{-- {{$usuarios}} --}}
{{-- 
		<div class="margin" id="botones_control">
			<a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(1);">Agregar Usuario</a>
			<a href="{{ url("/listado_usuarios") }}"  class="btn btn-xs btn-primary" >Listado Usuarios</a> 
			<a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(2);">Roles</a> 
			<a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(3);" >Permisos</a>                                 
		</div> --}}

    </div>

<div class="box-body box-white">

		<canvas id="pieChart" style="height:200px"></canvas>

		{{-- <div style="text-align:center" ><label for="">{{$total['total']}} Asistentes en Total</label></div> --}}
		<br><hr><br>
		<div style="text-align:center" class="row">

			<div style="text-align:center" class="col-md-3">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3>{{$total['total']}}<sup style="font-size: 20px"></sup></h3>

						<p>Total Visitantes</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>
					<a href="#" class="small-box-footer">
						<i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>

		</div>
</div>

</div></section>


@section('scripts')

@parent
<script>
 function activar_charts() {
	( function ( $ ) {

var charts = {
  init: function () {
	// -- Set new default font family and font color to mimic Bootstrap's default styling
	// Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	// Chart.defaults.global.defaultFontColor = '#292b2c';
	this.ajaxGetPostMonthlyData();
  },

  ajaxGetPostMonthlyData: function () {
	// var urlPath =  'plato_favorito';
	// var urlPath =  'plato_mas_vendido';
	var urlPath =  'asistencia';
	var request = $.ajax({
	  dataType: "json",
	  method: 'GET',
	  url: urlPath
  });

	request.done( function ( response ) {
	  charts.createCompletedJobsChart( response );
	});
  },

  /**
   * Created the Completed Jobs Chart
   */
  createCompletedJobsChart: function ( response ) {
  
	var label = $.map( response, function( obj, i ) { return obj.label; } );
	var color = $.map( response, function( obj, i ) { return obj.color; } );
	var value = $.map( response, function( obj, i ) { return obj.value; } );

	var ctx = document.getElementById("pieChart");
	var myLineChart = new Chart(ctx, {
	  type: 'pie',
	  data: {
		labels: label, // The response got from the ajax request containing all month names in the database
		datasets: [{
		  label: [],
		  backgroundColor: '#fff',
		  backgroundColor : [
			"#E91E63",
			"#29B6F6"
		],
		borderColor : [
			"#CDA776",
			"#989898",
			"#CB252B",
			"#E39371",
			"#1D7A46"
		],
		borderWidth : 2,
		borderColor : '#fff',
		  data: value// The response got from the ajax request containing data for the completed jobs in the corresponding months
		}],
	  },
	  options: {
		title: {
		  display: true,
		  text: 'Porcentaje %'
		},
		//Boolean - Whether we should show a stroke on each segment
		//segmentShowStroke    : true,
		//String - The colour of each segment stroke
		segmentStrokeColor   : '#fff',
		//Number - The width of each segment stroke
		segmentStrokeWidth   : 2,
		//Number - The percentage of the chart that we cut out of the middle
		percentageInnerCutout: 50, // This is 0 for Pie charts
		//Number - Amount of animation steps
		animationSteps       : 100,
		//String - Animation easing effect
		animationEasing      : 'easeOutBounce',
		//Boolean - Whether we animate the rotation of the Doughnut
		animateRotate        : true,
		//Boolean - Whether we animate scaling the Doughnut from the centre
		animateScale         : false,
		//Boolean - whether to make the chart responsive to window resizing
		responsive           : true,
		// Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		maintainAspectRatio  : true,
		//String - A legend template
		legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
	  }
	});
  }
};

charts.init();

})(jQuery);
}


activar_charts();

</script>
@endsection


@endsection
