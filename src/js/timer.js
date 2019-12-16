setInterval(function() {
  $('.timer').each(function() {
    let timer = $(this)
      .children()
      .text()
    let id = $(this)
      .children()
      .attr('class')
    let parts_of_time = timer.split(':')

    if (
      parts_of_time[0] === '00' &&
      parts_of_time[1] === '00' &&
      parts_of_time[2] === '00'
    ) {
      if ($('#biddings')) {
        location.reload()
      }

      data['exsistingIds'] = existingIDs()
      if ($(this).parents('.popular').length) {
        getPopularProdsWithoutIds(data['exsistingIds'], id)
      }
      if ($(this).parents('.new').length) {
        getNewestProdsWithoutIds(data['exsistingIds'], id)
      }
      if ($(this).parents('.top').length) {
        getTopProdsWithoutIds(data['exsistingIds'], id)
      }
    } else {
      if (
        parts_of_time[2] === '00' &&
        parts_of_time[1] === '00' &&
        parts_of_time[0] !== '00'
      ) {
        parts_of_time[1] = '60'
        parts_of_time[0] = (parseInt(parts_of_time[0]) - 1).toString()
      }

      if (parts_of_time[2] === '00') {
        parts_of_time[2] = '60'
        parts_of_time[1] = (parseInt(parts_of_time[1]) - 1).toString()
      }

      parts_of_time[2] = (parseInt(parts_of_time[2]) - 1).toString()
      if (parseInt(parts_of_time[1]) < 1 && parseInt(parts_of_time[0]) == 0) {
        $('#' + id + 'dur').css('color', 'red')
      }

      for (let i in parts_of_time) {
        parts_of_time[i] =
          parts_of_time[i].length > 1
            ? parts_of_time[i]
            : '0' + parts_of_time[i]
      }
    }

    $(this)
      .children()
      .html(parts_of_time.join(':'))
  })
}, 1000)
