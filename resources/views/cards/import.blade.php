@extends('adminlte::page')

@section('title', 'Merge Cards')

@section('content_header')
    <h1>Merge Cards</h1>
@stop

@section('content')
	<div id="hidden-fields">
		<input type="hidden" name="cards" id="js-cards-hidden">
		<input type="hidden" name="parse-results" id="js-parsed-results-hidden">
	</div>

	<div id="hidden-html" class="d-none">
		<ul id="js-import-errors" class="list-group"></ul>
	</div>

	<div class="row">
		<div class="col-3">
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">1. Import </h3>
				</div>

				<form action="{{ route('api.cards.import') }}" role="form" method="post" id="js-import-form">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="contacts">Cards</label>
									<input class="form-control-file" type="file" name="cards" id="js-cards" accept=".csv" required/>
								</div>
							</div>
						</div>
					</div>

					<div class="card-footer">
						<button class="btn btn-primary" id="js-import-submit" type="submit">Merge</button>
					</div>
				</form>

			</div>
		</div>
		<div class="col-9">
			<div class="card card-info disabled">
				<div class="card-header">
					<h3 class="card-title">2. Review and Validate Merged Data</h3>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div id="js-import-review-table" class="w-100"></div>
						</div>
					</div>
				</div>

				<div class="card-footer">
				</div>
			</div>
		</div>
	</div>

	{{-- <div class="row"> --}}
	{{-- 	<div class="col-12"> --}}
	{{-- 		<div class="card card-info disabled"> --}}
	{{-- 			<div class="card-header"> --}}
	{{-- 				<h3 class="card-title">2. Review and Validate Merged Data</h3> --}}
	{{-- 			</div> --}}

	{{-- 			<div class="card-body"> --}}
	{{-- 				<div class="row"> --}}
	{{-- 					<div class="col-md-12"> --}}
	{{-- 						<div id="js-import-review-table" class="w-100"></div> --}}
	{{-- 					</div> --}}
	{{-- 				</div> --}}
	{{-- 			</div> --}}

	{{-- 			<div class="card-footer"> --}}
	{{-- 			</div> --}}
	{{-- 		</div> --}}
	{{-- 	</div> --}}
	{{-- </div> --}}
@stop
