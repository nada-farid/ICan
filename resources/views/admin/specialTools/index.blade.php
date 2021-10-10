@extends('layouts.admin')
@section('content')
@can('special_tool_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.special-tools.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.specialTool.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.specialTool.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SpecialTool">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.specialTool.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialTool.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialTool.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialTool.fields.description') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($specialTools as $key => $specialTool)
                        <tr data-entry-id="{{ $specialTool->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $specialTool->id ?? '' }}
                            </td>
                            <td>
                                {{ $specialTool->name ?? '' }}
                            </td>
                            <td>
                                @if($specialTool->photo)
                                    <a href="{{ $specialTool->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $specialTool->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $specialTool->description ?? '' }}
                            </td>
                            <td>
                                @can('special_tool_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.special-tools.show', $specialTool->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('special_tool_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.special-tools.edit', $specialTool->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('special_tool_delete')
                                    <form action="{{ route('admin.special-tools.destroy', $specialTool->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('special_tool_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.special-tools.massDestroy') }}",
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
  let table = $('.datatable-SpecialTool:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection