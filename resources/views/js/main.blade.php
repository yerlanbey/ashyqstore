<script>
    $(document).ready(function () {
        $('.select-all').click(function () {
            let $select2 = $(this).parent().siblings('.select2')
            $select2.find('option').prop('selected', 'selected')
            $select2.trigger('change')
        })
        $('.deselect-all').click(function () {
            let $select2 = $(this).parent().siblings('.select2')
            $select2.find('option').prop('selected', '')
            $select2.trigger('change')
        })

        $('.select2').select2()
    });


    $('#name').change(function(e) {
        $.get('{{ route('product.checkSlug') }}',
            { 'name': $(this).val() },
            function( data ) {
                $('#slug').val(data.slug);
            }
        );
    });
</script>
