function getTopProdsWithoutIds(ajaxIds, id)
{

    $.ajax({
        url :'/api/getTop',
        data: {
          ajaxId: ajaxIds.join(',')
        }, 
        
       success: function(response)
        {                         
          var response = JSON.parse(response);
   
            var header = $('#product'+ id).text();
            $('#product'+ id).text(header.replace(header, response[0][1]));
            
              var price = $('#'+ id +'price').text();
              if (response[0].price == null)
              {
                response[0].price = "0.00";
              }
              $('#'+ id +'price').text(price.replace(price, "€" + response[0].price));                      
              
              var endtime = response[0].DurationEndTime.split('.');
              var enddate = response[0].DurationEndDate + " " + endtime[0];            
              var totaltime = new Date(new Date(enddate) - new Date($.now()));
  
              var diff = totaltime.getHours() + ":" + totaltime.getMinutes() + ":" + totaltime.getSeconds();
  
              var time = $('#'+ id +'dur').text();
              $('#'+ id +'dur').text(time.replace(time, diff));
              
              $('#'+ id +'dur').css('color', '');
              $('button#' + id).attr('href', response[0][0]);
              $('#' + id + 'img').attr('src', response[0].FileName);

              var priceHigh;
              if (response[0].price < 1 && response[0].price <= 50) {
                priceHigh = "0.50";
              } else if (response[0].price > 50 &&  response[0].price <= 500) {
                priceHigh = "1";
              } else if (response[0].price > 500 && response[0].price <= 1000) {
                priceHigh = "5";
              } else if (response[0].price > 1000 && response[0].price <= 5000) {
                priceHigh = "10";
              } else if (response[0].price > 5000) {
                priceHigh = "50";
              }
              else{
                priceHigh = "0.50";
              }
              $('button#' + id).text("Verhoog bod( + €" + priceHigh + ")");
      }          
    
  
    }
  );
}