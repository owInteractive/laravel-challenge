<script src="{{ URL::asset('js/bootstrap-datetimepicker.js') }}"></script>

<script type="text/javascript">
    $('{{ $input }}').datetimepicker({
        format: 'mm/dd/yyyy hh:ii',
        autoclose: 1,
        todayHighlight: 1,
    });
</script>