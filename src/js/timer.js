setInterval(function(){
  $('.timer').each(function () {
      let timer = $(this).children('p').text()
      let id = $(this).children('p').attr('class')

      let parts_of_time = timer.split(':')

      if (parts_of_time[0] === "00" && parts_of_time[1] === "00" && parts_of_time[2] === "00") {
        $('#' + id).addClass('disabled')
        //TODO: Ajax request for new product
      } else {
          if (parts_of_time[2] === "00" && parts_of_time[1] === "00" && parts_of_time[0] !== "00") {
              parts_of_time[1] = "60"
              parts_of_time[0] = (parseInt(parts_of_time[0]) - 1).toString()
          }

          if (parts_of_time[2] === "00") {
              parts_of_time[2] = "60"
              parts_of_time[1] = (parseInt(parts_of_time[1]) - 1).toString()
          }

          parts_of_time[2] = (parseInt(parts_of_time[2]) - 1).toString()


          if (parseInt(parts_of_time[2]) < 10 && parts_of_time[1] === "00" && parts_of_time[0] === "00") {
              $(this).css('color', 'red')
          }

          for (let i in parts_of_time) {
              parts_of_time[i] = parts_of_time[i].length > 1 ? parts_of_time[i] : "0"+ parts_of_time[i]
          }
      }
      $(this).children('p').html(parts_of_time.join(':'))
  });
}, 1000);


