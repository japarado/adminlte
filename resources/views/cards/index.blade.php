@extends('adminlte::page')

@section('title', 'Cards')

@section('content_header')
    <h1>Cards</h1>
@stop

@section('content')
	<div class="d-hidden">
		<input type="hidden" value="{{ json_encode($cards) }}" id="js-cards">
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Cards</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table id="js-card-table"
									   class="table table-bordered table-striped">
									<thead>
										<tr role="row">
											<th>ID</th>
											<th>Code</th>
											<th>Sync Status</th>
											<th>Contact</th>
											<th>Batch</th>
											<th>Created At</th>
										</tr>
									</thead>
									<tbody>
										@foreach($cards as $card)
											<tr>
												<td>{{ $card->id }}</td>
												<td>{{ $card->code }}</td>
												<td>{{ $card->is_synced }}</td>
												<td>{{ $card->contact ? $card->contact->full_name : "" }}</td>
												<td>{{ $card->batch_id }}</td>
												<td>{{ $card->created_at }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					{{ $cards->links() }}
				</div>
			</div>
		</div>
	</div>
@stop

@section('plugins.Datatables', true)

@section('js')
	<script src="{{ asset('js/pages/cards/index.js') }}"></script>
@stop
