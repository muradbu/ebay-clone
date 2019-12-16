if ($('#current-biddings').length) {
  setInterval(() => {
    const id = $('#current-biddings').attr('class')
    if ($('#current-biddings')) {
      $.ajax({
        url: '/api/getCurrentBiddings/' + id,
        success: response => {
          response &&
            JSON.parse(response).forEach((bidding, i) => {
              if (i === 0) {
                $('#bidAmountHeader').text(formatMoney(bidding.BidAmount))
                $('#bidDateTimeHeader').text(
                  bidding.BidDate +
                    ' ' +
                    bidding.BidTime.substring(0, bidding.BidTime.indexOf('.'))
                )
                $('#bidUsernameHeader').text(bidding.Username)
              } else if (i <= 2) {
                $('#bidAmount' + i).text(formatMoney(bidding.BidAmount))
                $('#bidDateTime' + i).text(
                  bidding.BidDate +
                    ' ' +
                    bidding.BidTime.substring(0, bidding.BidTime.indexOf('.'))
                )
                $('#bidUsername' + i).text(bidding.Username)
              }
            })
        }
      })
    }
  }, 1000)
}
