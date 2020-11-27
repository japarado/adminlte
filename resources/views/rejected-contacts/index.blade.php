@extends('adminlte::page')

@section('title', 'Rejected Contacts')

@section('content_header')
    <h1>Rejected Contacts</h1>
@stop

@section('content')
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
											<th>Email</th>
											<th>Type</th>
											<th>Batch</th>
											<th>Created At</th>
										</tr>
									</thead>
									<tbody>
										@foreach($rejected_contacts as $rejected_contact)
											<tr>
												<td>{{ $rejected_contact->id }}</td>
												<td>{{ $rejected_contact->first_name }}</td>
												<td>{{ $rejected_contact->last_name }}</td>
												<td>{{ $rejected_contact->phone_number }}</td>
												<td>{{ $rejected_contact->email ?: "N/A" }}</td>
												<td>{{ ucfirst(strtolower($rejected_contact->batch->import_type)) }}</td>
												<td>{{ $rejected_contact->batch_id }}</td>
												<td>{{ $rejected_contact->created_at }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					{{ $rejected_contacts->links() }}
				</div>
			</div>
		<st /div>
	</div>
@stop
