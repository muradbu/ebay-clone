
$('#mail-form').hide();
$('#mail,#creditcard').on('change', function () {
    if ($('#mail').is(':checked')) {
        $('#creditcard-form').hide();
        $('#mail-form').show();
    } else {
        $('#mail-form').hide();
        $('#creditcard-form').show();
    }
})
