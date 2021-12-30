@extends('layouts.admin')
@section('content')
@can('practical_solution_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.practical-solutions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.practicalSolution.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.practicalSolution.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PracticalSolution">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.practicalSolution.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.practicalSolution.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.practicalSolution.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.practicalSolution.fields.photo') }}
                        </th> 
                        <th>
                            {{ trans('cruds.practicalSolution.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.practicalSolution.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($practicalSolutions as $key => $practicalSolution)
                        <tr data-entry-id="{{ $practicalSolution->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $practicalSolution->id ?? '' }}
                            </td>
                            <td>
                                {{ $practicalSolution->title ?? '' }}
                            </td>
                            <td>
                                {{ $practicalSolution->description ?? '' }}
                            </td>
                            <td>
                                @if($practicalSolution->photo)
                                    <a href="{{ $practicalSolution->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $practicalSolution->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td> 
                            <td>
                                {{ $practicalSolution->user->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\PracticalSolution::STATUS_SELECT[$practicalSolution->status] ?? '' }}
                            </td>
                            <td>
                                @can('practical_solution_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.practical-solutions.show', $practicalSolution->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('practical_solution_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.practical-solutions.edit', $practicalSolution->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('practical_solution_delete')
                                    <form action="{{ route('admin.practical-solutions.destroy', $practicalSolution->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('practical_solution_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.practical-solutions.massDestroy') }}",
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
  let table = $('.datatable-PracticalSolution:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection