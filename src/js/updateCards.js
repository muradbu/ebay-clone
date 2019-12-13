// check if your bidding is leading or not

if ($('.bidding').length > 0) {
    setInterval(function () {
        let bid_ids = [];
        let price_ids = [];

        $('.bidding').each(function () {
            let attr = $(this).attr('data-id');
            if (typeof attr !== typeof undefined && attr !== false && attr !== '') {
                if ($(this).hasClass('.track')) {
                    bid_ids.push(attr);
                }
                price_ids.push(attr);
            }
        });

        if (price_ids.length > 0) {
            $.getJSON('/api/product?attribute="Price"&ids="' + price_ids.join(',') +'"', (data) => {
                for (let id in data) {
                    $(`.tracked[data-id=${id}] .update-price`).html('€ ' + parseInt(data).toFixed(2));
                }
            })
        }
        if (bid_ids.length > 0) {
            $.getJSON('/api/product/track?ids="' + bid_ids.join(',') +'"', (data) => {
                $(`.tracked.winning`).removeClass('winning');
                for (let id in data) {
                    if (data[id]) {
                        $(`.tracked[data-id=${id}]`).addClass('winning')
                    }
                }
            })
        }
    }, 2000)
}
