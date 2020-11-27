@extends('adminlte::page')

@section('title', 'Contacts')

@section('content_header')
	<h1>Contacts</h1>
@stop

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Contacts</h3>
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
										</tr>
									</thead>
									<tbody>
										@foreach($contacts as $contact)
											<tr>
												<td>{{ $contact->id }}</td>
												<td>{{ $contact->first_name }}</td>
												<td>{{ $contact->last_name }}</td>
												<td>{{ $contact->phone_number }}</td>
												<td>{{ $contact->email ?: "N/A" }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					{{ $contacts->links() }}
				</div>
			</div>
		</div>
	</div>
@stop
