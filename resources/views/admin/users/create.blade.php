@extends('layouts.admin')
@section('content')
	
	<style>
		.emp_css{
				display: none;
		}
	</style>
	<div class="card">
		<div class="card-header">
			{{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
		</div>
		
		<div class="card-body">
			<form action="{{ url("admin/user/store") }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="row col-md-12 {{ $errors->has('roles') ? 'has-error' : '' }}">
					<label for="roles">{{ trans('cruds.user.fields.roles') }}<span style="color: red"> *</span></label>
					{{--						<span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>--}}
					{{--						<span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>--}}
					<select name="roles[]" id="roles" class="form-control {{--select2--}}" required>
						@foreach($roles as $id => $roles)
							<option
								value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
						@endforeach
					</select>
					@if($errors->has('roles'))
						<em class="invalid-feedback">
							{{ $errors->first('roles') }}
						</em>
					@endif
					<p class="helper-block">
						{{ trans('cruds.user.fields.roles_helper') }}
					</p>
				</div>
				<br>
				<div class="row emp_div emp_css">
					<div class="col-md-6">
						<label for="emp_id">Employee Id</label>
						<input type="text" id="emp_id" name="emp_id" class="form-control" {{--value="{{ $emp_id }}"--}} readonly
						       required>
					</div>
					<div class="col-md-6">
						<label for="branch_id">Branch Id<span style="color: red"> *</span></label>
						<select id="branch_id" name="branch_id" class="form-control" required>
							<option>-- Select Branch --</option>
							@foreach($branch as $b)
								<option value="{{ $b->id }}">{{ $b->branch_name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 {{ $errors->has('name') ? 'has-error' : '' }}">
						<label for="name">{{ trans('cruds.user.fields.name') }}<span style="color: red"> *</span></label>
						<input type="text" id="name" name="name" class="form-control" placeholder="Enetr Name"
						       value="{{ old('name', isset($user) ? $user->name : '') }}" required>
						@if($errors->has('name'))
							<em class="invalid-feedback">
								{{ $errors->first('name') }}
							</em>
						@endif
						<p class="helper-block">
							{{ trans('cruds.user.fields.name_helper') }}
						</p>
					</div>
					<div class="col-md-6 {{ $errors->has('email') ? 'has-error' : '' }}">
						<label for="email">{{ trans('cruds.user.fields.email') }}<span style="color: red"> *</span></label>
						<input type="email" id="email" name="email" class="form-control" placeholder="Enter Email id"
						       value="{{ old('email', isset($user) ? $user->email : '') }}" required>
						@if($errors->has('email'))
							<em class="invalid-feedback">
								{{ $errors->first('email') }}
							</em>
						@endif
						<p class="helper-block">
							{{ trans('cruds.user.fields.email_helper') }}
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="contact_no">Contact No.<span style="color: red"> *</span></label>
						<input type="text" id="contact_no" name="contact_no" class="form-control" placeholder="Enter Contact Number"
						       required>
					</div>
					<div class="col-md-6 {{ $errors->has('password') ? 'has-error' : '' }}">
						<label for="password">Password<span style="color: red"> *</span></label>
						<input type="text" id="password" name="password" class="form-control" placeholder="Enter Password" required>
						@if($errors->has('password'))
							<em class="invalid-feedback">
								{{ $errors->first('password') }}
							</em>
						@endif
						<p class="helper-block">
							{{ trans('cruds.user.fields.password_helper') }}
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="dob">DOB<span style="color: red"> *</span></label>
						<input type="text" id="dob" name="dob" class="form-control" placeholder="Enter DOB" required>
					</div>
					<div class="col-md-6">
						<label>gender<span style="color: red"> *</span></label><br>
						<input type="radio" id="male" name="gender" value="Male" checked>
						<label for="male">Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<input type="radio" id="female" name="gender" value="Female">
						<label for="female">Female</label>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6">
						<label for="user_address">User Address <span style="color: red">*</span></label>
						<textarea id="user_address" name="user_address" class="form-control" placeholder="Enter User Address"
						          rows="2" style="height: 50px !important; min-height: 100px !important;" required></textarea>
					</div>
					<div class="col-md-6 row">
						<div class="col-md-12">
							<label for="state_id"> State <span style="color: red">*</span></label>
							<select class="form-control" id="state_id" name="state_id">
								<option>-- Select State --</option>
								@foreach($state as $s)
									<option value="{{$s->id}}">{{$s->state}}</option>
								@endforeach
							</select>
						</div>
						<br>
						<div class="col-md-12">
							<label for="city_id"> City <span style="color: red">*</span></label>
							<select class="form-control" id="city_id" name="city_id">
								<option>-- Select city --</option>
							</select>
						</div>
					</div>
				</div>
				<br>
				<div class="row emp_div emp_css">
					<div class="col-md-6">
						<label for="hire_date">Hire Date<span style="color: red"> *</span></label>
						<input type="date" id="hire_date" name="hire_date" class="form-control" placeholder="Enter Hiring Date"
						       required>
					</div>
					<div class="col-md-6">
						<label for="salary">Salary<span style="color: red"> *</span></label>
						<input type="number" step="0.01" id="salary" name="salary" class="form-control" placeholder="Enter Salary"
						       required>
					</div>
				</div>
				<div class="row col-md-12">
					<label for="branch_status">Branch Status <span style="color: red">*</span></label>
					<select class="form-control" id="branch_status" name="branch_status">
						<option value="active">Active</option>
						<option value="inactive">Inactive</option>
					</select>
				</div>
				<br>
				<div class="text-center">
					<input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
				</div>
			</form>
		</div>
	</div>
	<script src="{{asset('js/jquery.js')}}"></script>
	<script>
      $(document).ready(function () {
          $('select[name="state_id"]').on('change', function () {
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
                          $('select[name="city_id"]').empty();
                          $.each(data, function (key, value) {
                              // console.log(value.name);
                              $('select[name="city_id"]')
                                  .append('<option value="' + value.id + '">' + value.name + '</option>');
                          });
                      }
                  });
              } else {
                  $('select[name="city"]').empty();

              }
          });
          $('select[id="roles"]').on('change', function () {
							if($('.emp_div').hasClass('emp_css')) {
                  var emp_div = $(this).val();
                  if (emp_div == 'employee') {
                      $('.emp_div').removeClass('emp_css');
                  }
              }else{
									$('.emp_div').addClass('emp_css');
							}
          });
      });
	</script>
@endsection