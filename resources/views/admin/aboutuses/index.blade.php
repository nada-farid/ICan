@extends('layouts.admin')
@section('content')
@can('about_us_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.aboutuses.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.aboutUs.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.aboutUs.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-AboutUs">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.phote') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.vision') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.message') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.goals') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.phone_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.phone_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.time') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.facebook') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.twitter') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.instegram') }}
                        </th>
                        <th>
                            {{ trans('cruds.aboutUs.fields.youtube') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aboutuses as $key => $aboutUs)
                        <tr data-entry-id="{{ $aboutUs->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $aboutUs->id ?? '' }}
                            </td>
                            <td>
                                @if($aboutUs->phote)
                                    <a href="{{ $aboutUs->phote->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $aboutUs->phote->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $aboutUs->description ?? '' }}
                            </td>
                            <td>
                                {{ $aboutUs->vision ?? '' }}
                            </td>
                            <td>
                                {{ $aboutUs->message ?? '' }}
                            </td>
                            <td>
                                {{ $aboutUs->goals ?? '' }}
                            </td>
                            <td>
                                {{ $aboutUs->email ?? '' }}
                            </td>
                            <td>
                                {{ $aboutUs->phone_1 ?? '' }}
                            </td>
                            <td>
                                {{ $aboutUs->phone_2 ?? '' }}
                            </td>
                            <td>
                                {{ $aboutUs->address ?? '' }}
                            </td>
                            <td>
                                {{ $aboutUs->time ?? '' }}
                            </td>
                            <td>
                                {{ $aboutUs->facebook ?? '' }}
                            </td>
                            <td>
                                {{ $aboutUs->twitter ?? '' }}
                            </td>
                            <td>
                                {{ $aboutUs->instegram ?? '' }}
                            </td>
                            <td>
                                {{ $aboutUs->youtube ?? '' }}
                            </td>
                            <td>
                                @can('about_us_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.aboutuses.show', $aboutUs->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('about_us_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.aboutuses.edit', $aboutUs->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('about_us_delete')
                                    <form action="{{ route('admin.aboutuses.destroy', $aboutUs->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('about_us_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.aboutuses.massDestroy') }}",
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
  let table = $('.datatable-AboutUs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection