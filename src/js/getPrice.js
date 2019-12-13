

if ($('.update-price').length > 0) {
    setInterval(function () {
        $('.update-price').each(function () {
            let attr = $(this).attr('data-id');
            if (typeof attr !== typeof undefined && attr !== false && attr !== '') {
                $.getJSON('/api/product?id=' + $(this).attr('data-id'), (data) => {
                    $(this).html('€'+ data);
                })
            }
        });
    }, 1000)
}
