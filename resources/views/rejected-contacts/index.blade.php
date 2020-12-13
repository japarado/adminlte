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
								@include('rejected-contacts.parts.table')
							</div>
						</div>
					</div>
					{{ $rejected_contacts->links() }}
				</div>
			</div>
		<st /div>
	</div>
@stop
