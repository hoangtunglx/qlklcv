@extends('layouts.dashboard')

@section('pagetitle')
	Định mức của bộ môn
@endsection

@section('content')
	<div class="card mb-3">
		<div class="bg-holder d-none d-lg-block bg-card" style="background-image:url('{{ asset('public/assets/img/illustrations/corner-4.png') }}');"></div>
		<div class="card-body position-relative">
			<div class="row">
				<div class="col-lg-8">
					<nav style="--falcon-breadcrumb-divider:'»';" aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a ><i class="fad fa-home-alt"></i></a></li>
							{{-- href="{{ route('dashboard.danhmuc.home') }}" --}}
							<li class="breadcrumb-item"><a href="{{ route('manager.home') }}">Bộ môn và khoa</a></li>
							<li class="breadcrumb-item active" aria-current="page">Định mức của bộ môn</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card mb-0">
		<div class="card-header bg-light">
			<h5 class="mb-0">Định mức của bộ môn</h5>
		</div>
		<div class="card-body pb-0">
			<div class="table-responsive scrollbar">
				<table id="DataList" class="table table-bordered table-hover table-sm overflow-hidden">
					<thead>
						<tr>
							<th class="text-nowrap" width="5%">#</th>
                            <th class="text-nowrap" width="20%">Tên bộ môn</th>
							<th class="text-nowrap" width="20%">Tổng định mức</th>
							<th class="text-nowrap" width="20%">Năm học</th>
						</tr>
					</thead>
					<tbody>
						@foreach($dinhmucbomon as $value)
							<tr>
								<td class="align-middle">{{ $loop->iteration }}</td>
								<td class="align-middle">{{ $value->BoMon->TenBoMon}}</td>
								<td class="align-middle">{{ $value->TongDinhMuc }}</td>
								<td class="align-middle">{{ $value->NamHoc }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="mt-1">
				{{ $dinhmucbomon->links() }}
			</div>
		</div>
	</div>
@endsection