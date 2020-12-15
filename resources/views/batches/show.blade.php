@extends('adminlte::page')

@section('title', "Batches - {$batch->id}")

@section('content_header')
	<h1>Batch #{{ $batch->id }}</h1>
	<h6>{{ $batch->created_at }}</h6>
@stop

@section('content')
	<div id="hidden-fields">
		<input type="hidden" id="js-import-data" value="{{ json_encode($batch->data['rows']) }}">
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Imported Data File Snapshot</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div id="js-import-data-table"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script src="{{ asset('js/pages/batches/show.js') }}"></script>
@endsection
