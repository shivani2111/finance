@extends('layouts.admin')
@section('content')
	
	<div class="card">
		<div class="card-header">
			{{ trans('global.create') }} Branch
		</div>
		
		<div class="card-body">
			<form action="{{ url("admin/loan/store") }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label for="loan_type">Loan Type <span style="color: red">*</span></label>
							<input type="text" id="loan_type" name="loan_type" class="form-control" placeholder="Enter Loan Type"
							       required>
						</div>
						<div class="col-md-6">
							<label for="life">Life <span style="color: red">*</span></label>
							<input type="number" id="life" name="life" class="form-control" placeholder="Enter Loan Life"
							       required>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6">
							<label for="annual_rate">Annual Rate (%) <span style="color: red">*</span></label>
							<input type="number" step="0.01" id="annual_rate" name="annual_rate" class="form-control" placeholder="Enter Annual Rate"
							       style="height: 50px !important; min-height: 100px !important;" required />
						</div>
						<div class="col-md-6">
							<label for="rate">Rate (rs.) <span style="color: red">*</span></label>
							<input type="number" step="0.01" id="rate" name="rate" class="form-control" placeholder="Enter Rate"
							       style="height: 50px !important; min-height: 100px !important;" required />
						</div>
					</div>
					<br>
					<div class="row col-md-12">
						<label for="status">Branch Status <span style="color: red">*</span></label>
						<select class="form-control" id="status" name="status">
							<option value="active" selected>Active</option>
							<option value="inactive">Inactive</option>
						</select>
					</div>
					<div class="col-md-12 text-center">
						<br>
						<input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection