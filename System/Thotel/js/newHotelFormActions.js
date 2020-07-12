$( "input[name=prevhotel]" ).autocomplete({
	source: '../Treservation/hotel_ac.php'
});
$("#prevhotel").on('keyup change', function(){
   ph = $(this).val();
   $.ajax({
       url: 'getPrevNextHotel.php',
       type: 'POST',
       cache:false,
       data: {'ph': ph},
       success: function(data){ //{data} structure: prevID, prevName, nxtID, nxtName
         data = $.parseJSON(data);
         if (data.prevID !== "nores"){
            $("#nexthotel").val(data.nxtName);
            $("#prevhotelID").val(data.prevID);
            $("#nexthotelID").val(data.nxtID);
            $("#drop_pickupW").val(data.ppWest);
            $("#drop_pickupE").val(data.ppEast);
         }
         else {
            $("#nexthotel").val('');
            $("#prevhotelID").val('');
            $("#nxthotelID").val('');
            $("#drop_pickupW").val('');
            $("#drop_pickupE").val('');
         }
       }
   });
});
// FINISHED
