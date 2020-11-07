@extends('adminlte::page')

@section('title', 'Merge Cards')

@section('content_header')
    <h1>Merge Cards</h1>
@stop

@section('content')
	<div id="hidden-fields">
		<input type="hidden" name="cards" id="js-cards-hidden">
		<input type="hidden" name="vouchers" id="js-vouchers-hidden">
		<input type="hidden" name="merged-vouchers-cards" id="js-merged-vouchers-cards-hidden">
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">1. Merge Card and Contact Files</h3>
				</div>

				<form action="{{ route('api.cards.merge') }}" role="form" method="post" id="js-merge-form">
					<div class="card-body">
						<div class="row">

							<div class="col-md-7 col-xs-12">
								<div class="form-group">
									<label for="contacts">Contacts</label>
									<input class="form-control-file" type="file" name="contacts" id="js-contacts" accept=".csv" required/>
									<div id="js-contacts-errors"></div>
								</div>

								<div class="form-group">
									<label for="cards">Cards</label>
									<input class="form-control-file" type="file" name="cards" id="js-cards" accept=".csv" required/>
									<div id="js-cards-errors"></div>
								</div>
							</div>
						</div>
					</div>

					<div class="card-footer">
						<button class="btn btn-primary" id="js-merge-submit" type="submit">Merge</button>
					</div>
				</form>

			</div>
		</div>
	</div>
@stop

@section('plugins.Pace', true)

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/pages/cards/merge.js') }}"></script>
@stop
