
@extends('layouts.admin')
@section('content')
	
	<div class="card">
		<div class="card-header">
			{{ trans('global.create') }} Branch
		</div>
		
		<div class="card-body">
			<form action="{{ url("admin/branch/store") }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label for="branch_name">Branch Name <span style="color: red">*</span></label>
							<input type="text" id="branch_name" name="branch_name" class="form-control" placeholder="Enter Branch Name"
							       required>
						</div>
						<div class="col-md-6">
							<label for="branch_code">Branch Code <span style="color: red">*</span></label>
							<input type="text" id="branch_code" name="branch_code" class="form-control" placeholder="Enter Branch Code"
							       required>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6">
							<label for="branch_address">Branch Address <span style="color: red">*</span></label>
							<textarea id="branch_address" name="branch_address" class="form-control" placeholder="Enter Branch Address"
							          rows="2" style="height: 50px !important; min-height: 100px !important;" required></textarea>
						</div>
						<div class="col-md-6 row">
							<div class="col-md-12">
								<label for="branch_state_id"> State <span style="color: red">*</span></label>
								<select class="form-control" id="branch_state_id" name="branch_state_id">
									<option>-- Select State --</option>
									@foreach($states as $s)
										<option value="{{$s->id}}">{{$s->state}}</option>
									@endforeach
								</select>
							</div>
							<br>
							<div class="col-md-12">
								<label for="branch_city_id"> City <span style="color: red">*</span></label>
								<select class="form-control" id="branch_city_id" name="branch_city_id">
									<option>-- Select city --</option>
									{{--									@foreach($cities as $c)--}}
									{{--										<option value="{{$c->id}}">{{$c->name}}</option>--}}
									{{--									@endforeach--}}
								</select>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6">
							<label for="branch_postal_code">Branch Postal Code <span style="color: red">*</span></label>
							<input type="text" id="branch_postal_code" name="branch_postal_code" class="form-control" placeholder="Enter Branch Postal Code"
							       required>
						</div>
						<div class="col-md-6">
							<label for="branch_status">Branch Status <span style="color: red">*</span></label>
							<select class="form-control" id="branch_status" name="branch_status">
								<option value="active">Active</option>
								<option value="inactive">Inactive</option>
							</select>
						</div>
					</div>
					<div class="col-md-12 text-center">
						<br>
						<input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="{{asset('js/jquery.js')}}"></script>
	<script>
      $(document).ready(function () {
          $('select[name="branch_state_id"]').on('change', function () {
              var state_id = $(this).val();
              if (state_id) {
                  console.log(state_id);
                  $.ajax({
                      url: '/admin/branch/getcity/' + state_id,
                      type: 'GET',
                      dataType: 'json',
                      success: function (data) {
                          console.log(data);
                          // console.log(data[0].name);
                          $('select[name="branch_city_id"]').empty();
                          $.each(data, function (key, value) {
                              // console.log(value.name);
                              $('select[name="branch_city_id"]')
                                  .append('<option value="' + value.id + '">' + value.name + '</option>');
                          });
                      }
                  });
              } else {
                  $('select[name="city"]').empty();

              }
          });
      });
	</script>
@endsection