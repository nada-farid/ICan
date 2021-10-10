@extends('layouts.admin')
@section('content')
@can('problem_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.problems.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.problem.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.problem.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Problem">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.problem.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.problem.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.problem.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.problem.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.problem.fields.description') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($problems as $key => $problem)
                        <tr data-entry-id="{{ $problem->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $problem->id ?? '' }}
                            </td>
                            <td>
                                {{ $problem->title ?? '' }}
                            </td>
                            <td>
                                {{ $problem->email ?? '' }}
                            </td>
                            <td>
                                {{ $problem->phone ?? '' }}
                            </td>
                            <td>
                                {{ $problem->description ?? '' }}
                            </td>
                            <td>
                                @can('problem_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.problems.show', $problem->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('problem_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.problems.edit', $problem->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('problem_delete')
                                    <form action="{{ route('admin.problems.destroy', $problem->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

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
@can('problem_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.problems.massDestroy') }}",
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
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Problem:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection