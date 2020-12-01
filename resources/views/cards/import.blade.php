@extends('adminlte::page')

@section('title', 'Merge Cards')

@section('content_header')
	<h1>Import Cards</h1>
@stop

@section('js')
	<script src="{{ asset('js/pages/cards/import.js') }}"></script>
@stop

@section('content')
	<div id="hidden-fields">
		<input type="hidden" id="js-brands" value="{{ $brands }}">
	</div>

	<div id="hidden-html" class="d-none">
		<ul id="js-import-errors" class="list-group"></ul>
	</div>

	<div class="row">
		<div class="col-12">
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
						<button class="btn btn-primary" id="js-parse-submit" type="submit">Parse</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card card-info">
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
					<form class="form-inline" action="" autocomplete="off">
						<div class="custom-control custom-switch">
							<input type="checkbox" class="custom-control-input" id="js-auto-assign-brands" autocomplete="off">
							<label class="custom-control-label" for="js-auto-assign-brands">Auto-assign brands</label>
						</div>

						<div class="custom-control d-flex">
							<select class="custom-select" name="fallback-brand-id" id="js-fallback-brand-id">
								@foreach($brands as $brand)
									<option value="{{ $brand->id }}" data-brand-name="{{ $brand->name }}">{{ $brand->name }}</option>
								@endforeach
							</select>
							<label for="fallback-brand-id" class="custom-select-label ml-2">Fallback Brand</label>
						</div>

						<div class="custom-control">
							<button class="btn btn-primary" id="js-import-submit" type="button">Import</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop
