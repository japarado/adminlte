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
		@foreach($contacts as $contact)
			<tr>
				<td>{{ $contact->id }}</td>
				<td>{{ $contact->first_name }}</td>
				<td>{{ $contact->last_name }}</td>
				<td>{{ $contact->phone_number }}</td>
				<td>{{ $contact->email ?: "n/a" }}</td>
				<td>{{ $contact->contactable->batch->import_type }}</td>
				<td>{{ $contact->contactable->batch->id }}</td>
				<td>{{ $contact->created_at }}</td>
			</tr>
		@endforeach
	</tbody>
</table>
