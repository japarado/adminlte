@extends('adminlte::page')

@section('title', 'Batches')

@section('content_header')
    <h1>Batches</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Batches</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead>
										<tr role="row">
											<th>ID</th>
											<th>Type</th>
											<th>Issued By</th>
											<th>Created At</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($batches as $batch)
											<tr>
												<td>{{ $batch->id }}</td>
												<td>{{ $batch->import_type }}</td>
												<td>{{ $batch->user->full_name }}</td>
												<td>{{ $batch->created_at }}</td>
												<td class="project-actions text-right">
													<a class="btn btn-primary btn-sm" href="{{ route('batches.show', $batch->id) }}">
														<i class="fas fa-folder"></i>
														View
													</a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							@foreach($batches as $batch)

							@endforeach
						</div>
					</div>
					{{ $batches->links() }}
				</div>
			</div>
		</div>
	</div>
@stop
