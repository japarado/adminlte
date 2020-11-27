@extends('adminlte::page')

@section('title', 'Vouchers')

@section('content_header')
    <h1>Rejected Contacts</h1>
@stop

@section('content')
	<div class="d-hidden">
		<input type="hidden" value="{{ json_encode($vouchers) }}" id="js-cards">
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Rejected Contacts</h3>
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
											<th>First Name</th>
											<th>Last Name</th>
											<th>Phone Number</th>
										</tr>
									</thead>
									<tbody>
										@foreach($rejected_contacts as $rejected_contact)
											<tr>
												<td>{{ $rejected_contact->id }}</td>
												<td>{{ $rejected_contact->code }}</td>
												<td>{{ $rejected_contact->discount_value }}</td>
												<th>{{ $rejected_contact->is_amount ? "Amount" : "Percent" }}</th>
												<td>{{ $rejected_contact->batch_id }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					{{ $vouchers->links() }}
				</div>
			</div>
		<st /div>
	</div>
@stop
