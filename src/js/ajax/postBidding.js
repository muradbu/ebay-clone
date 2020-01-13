// TODO: Code is still here to pick up another time
let BidAmount = $('#BidAmount').val()
let ProductId = $('#current-biddings').attr('class')

const biddingData = {
  ProductId,
  BidAmount
}

const addBidding = () => {
  $.ajax({
    url: '/api/postBidding',
    data: biddingData,
    type: 'POST',
    method: 'POST',
    success: res => console.log('success', res)
  })
}

const setBiddingAmount = biddingButton => {
  $('#BidAmount').val(
    parseFloat($('#BidAmount').val()) + parseFloat(biddingButton.val())
  )
}
