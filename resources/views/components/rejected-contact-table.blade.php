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
		@foreach($rejectedContacts as $rejectedContact) <tr>
				<td>{{ $rejectedContact->id }}</td>
				<td>{{ $rejectedContact->first_name }}</td>
				<td>{{ $rejectedContact->last_name }}</td>
				<td>{{ $rejectedContact->phone_number }}</td>
				<td>{{ $rejectedContact->email ?: "N/A" }}</td>
				<td>{{ ucfirst(strtolower($rejectedContact->batch->import_type)) }}</td>
				<td>{{ $rejectedContact->batch_id }}</td>
				<td>{{ $rejectedContact->created_at }}</td>
			</tr>
		@endforeach
	</tbody>
</table>
