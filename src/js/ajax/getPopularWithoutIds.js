function getPopularProdsWithoutIds(ajaxIds, id) {
  $.ajax({
    url: "/api/getPopular",
    data: {
      ajaxId: ajaxIds.join(",")
    },

    success: function(response) {
      var response = JSON.parse(response);

      var header = $("#product" + id).text();
      $("#product" + id).text(header.replace(header, response[0][1]));

      var price = $("#" + id + "price").text();
      if (response[0].price == null) {
        response[0].price = "€ 0,00";
      }
      $("#" + id + "price").text(
        price.replace(price, formatMoney(response[0].price))
      );

      var endtime = response[0].DurationEndTime.split(".");
      var enddate = response[0].DurationEndDate + " " + endtime[0];
      var totaltime = new Date(new Date(enddate) - new Date($.now()));

      var diff =
        totaltime.getHours() +
        ":" +
        totaltime.getMinutes() +
        ":" +
        totaltime.getSeconds();

      var time = $("#" + id + "dur").text();
      $("#" + id + "dur").text(time.replace(time, diff));

      $("#" + id + "dur").css("color", "");
      $("button#" + id).attr("href", response[0][0]);
      $("#" + id + "img").attr("src", response[0].FileName);

      var priceHigh = defineMinimalAmount(response[0].price);

      $("button#" + id).text("Verhoog bod( + €" + priceHigh + ")");
    }
  });
}
