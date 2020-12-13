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
								<x-contact-table :contacts="$contacts"/>
							</div>
						</div>
					</div>
					{{ $contacts->links() }}
				</div>
			</div>
		</div>
	</div>
@stop
