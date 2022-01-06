@extends('layouts.admin')
@section('content')
	
	<div class="card">
		<div class="card-header">
			Loan {{ trans('global.list') }}
			@can('users_manage')
				<div class="col-md-2 float-right text-right p-0 m-0">
					<a class="btn btn-sm btn-success" href="{{ url("admin/loan/create") }}">
						{{ trans('global.add') }} Loan
					</a>
				</div>
			@endcan
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class=" table table-bordered table-striped table-hover datatable datatable-User">
					<thead>
					<tr>
						<th></th>
						<th>Id</th>
						<th>Loan Type</th>
						<th>Life</th>
						<th>Annual rate (%)</th>
						<th>rate</th>
						<th>Status</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					@foreach($loan as $key => $l)
						<tr data-entry-id="{{ $l->id }}">
							<td></td>
							<td>{{ $l->id ?? '' }}</td>
							<td>{{ $l->loan_type ?? '' }}</td>
							<td>{{ $l->life ?? '' }}
							<td>{{ $l->annual_rate ?? '' }}</td>
							<td>{{ $l->rate ?? '' }}</td>
							<td>{{ $l->status ?? '' }}</td>
							<td>
{{--								<a class="btn btn-xs btn-primary" href="{{ url('admin/branch/show', $l->id) }}">--}}
{{--									{{ trans('global.view') }}--}}
{{--								</a>--}}
{{--								<a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $l->id) }}">--}}
{{--									{{ trans('global.edit') }}--}}
{{--								</a>--}}
								<form action="{{ route('admin.users.destroy', $l->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
									<input type="hidden" name="_method" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
								</form>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		
		
		</div>
	</div>
@endsection
@section('scripts')
	@parent
	<script>
      $(function () {
          let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
				@can('users_manage')
          let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
          let deleteButton = {
              text: deleteButtonTrans,
              url: "{{ route('admin.users.mass_destroy') }}",
              className: 'btn-danger',
              action: function (e, dt, node, config) {
                  var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                      return $(entry).data('entry-id')
                  });

                  if (ids.length === 0) {
                      alert('{{ trans('global.datatables.zero_selected') }}')

                      return
                  }

                  if (confirm('{{ trans('global.areYouSure') }}')) {
                      $.ajax({
                          headers: {'x-csrf-token': _token},
                          method: 'POST',
                          url: config.url,
                          data: { ids: ids, _method: 'DELETE' }})
                          .done(function () { location.reload() })
                  }
              }
          }
          dtButtons.push(deleteButton)
				@endcan

        $.extend(true, $.fn.dataTable.defaults, {
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        });
          $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
          $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
              $($.fn.dataTable.tables(true)).DataTable()
                  .columns.adjust();
          });
      })
	
	</script>
@endsection