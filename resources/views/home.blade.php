@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			{{-- <div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Bienvenid@</div>

					<div class="panel-body">
						{{ trans('adminlte_lang::message.logged') }}
						{{$personas}}
					</div>
				</div>
			</div> --}}

			<div style="text-align:center">
				<h2><b>Bienvenido al sistema de Encuestas</b></h2>
				{{-- <h3><b>Administración de Recursos Humanos encuestas</b></h3> --}}
				<img src="{{asset('img/logochacana.jpg')}}" style="width:460px;height:100px;" class="centered"/>
			</div>
		</div>
	</div>
@endsection
