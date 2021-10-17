<table>
    @foreach($languages as $language)
        <tr>
            <td><input {{ $language->value || old('languages.'.$language->id) ? 'checked' : null }} data-id="{{ $language->id }}" type="checkbox" class="language-enable"></td>
            <td>{{ $language->language }}</td>
            <td><input value="{{ old('languages.'.$language->id,$language->value ) ?? null }}" {{ $language->value || old('languages.'.$language->id) ? null : 'disabled' }} data-id="{{ $language->id }}" name="languages[{{ $language->id }}]" type="number" step="1" min="0" max="100" class="language-rate form-control" placeholder="نسبة التقدم"></td>
        </tr>
    @endforeach
</table>

@section('scripts')
    @parent
    <script>
        $('document').ready(function () {
            $('.language-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.language-rate[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.language-rate[data-id="' + id + '"]').val(0)
            })
        });
    </script>
@endsection 