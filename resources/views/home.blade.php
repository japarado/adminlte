@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fas fa-credit-card mr-1"></i>
						Cards 
					</h3>
				</div>
                <div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="info-box">
								<span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Total</span>
									<span class="info-box-number">
										{{ $voucher_total_count }}
									</span>
								</div>
								<!-- /.info-box-content -->
							</div>
						</div>
						<div class="col-md-6">
							<div class="info-box">
								<span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Paired</span>
									<span class="info-box-number">
										{{ $voucher_paired_count }}
									</span>
								</div>
								<!-- /.info-box-content -->
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fas fa-ticket-alt mr-1"></i>
						Vouchers 
					</h3>
				</div>
                <div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="info-box">
								<span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">CPU Traffic</span>
									<span class="info-box-number">
										10
										<small>%</small>
									</span>
								</div>
								<!-- /.info-box-content -->
							</div>
						</div>
						<div class="col-md-6">
							<div class="info-box">
								<span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">CPU Traffic</span>
									<span class="info-box-number">
										10
										<small>%</small>
									</span>
								</div>
								<!-- /.info-box-content -->
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
@stop
