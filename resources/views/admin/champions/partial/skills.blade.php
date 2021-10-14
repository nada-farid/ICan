<table>
    @foreach($languages as $language)
        <tr>
            <td><input {{ $language->rate ? 'checked' : null }} data-id="{{ $language->id }}" type="checkbox" class="ingredient-enable"></td>
            <td>{{ $language->language }}</td>
            <td><input value="{{ $language->rate ?? null }}" {{ $language->rate ? null : 'disabled' }} data-id="{{ $language->id }}" name="languages[{{ $language->id }}]" type="text" class="ingredient-amount form-control" placeholder="نسبة التقدم"></td>
        </tr>
    @endforeach
</table>

@section('scripts')
    @parent
    <script>
        $('document').ready(function () {
            $('.ingredient-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.ingredient-amount[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.ingredient-amount[data-id="' + id + '"]').val(0)
            })
        });
    </script>
@endsection