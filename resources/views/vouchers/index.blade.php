@extends('adminlte::page')

@section('title', 'Vouchers')

@section('content_header')
    <h1>Vouchers</h1>
@stop

@section('content')
	<div class="d-hidden">
		<input type="hidden" value="{{ json_encode($vouchers) }}" id="js-cards">
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Vouchers</h3>
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
											<th>Discount Value</th>
											<th>Type</th>
											<th>Batch</th>
											<th>Created At</th>
										</tr>
									</thead>
									<tbody>
										@foreach($vouchers as $voucher)
											<tr>
												<td>{{ $voucher->id }}</td>
												<td>{{ $voucher->code }}</td>
												<td>{{ $voucher->discount_value }}</td>
												<th>{{ $voucher->is_amount ? "Amount" : "Percent" }}</th>
												<td>{{ $voucher->batch_id }}</td>
												<td>{{ $voucher->created_at }}</td>
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
		</div>
	</div>
@stop
