$(document).ready(function(){
   console.log('ready');
   ctf=0;
   init();
   formActions();
   $('#lName').autocomplete({
      source: 'fetchStudents.php',
      select: function(event, ui){
         event.preventDefault();
         student = ui.item.value;
         if (student != '+ Νέος Μαθητής +') {
            studentData = student.split(' ');
            console.log(studentData);
            stID = studentData[0];
            console.log(stID);
            $('#lName').val(studentData[2]);
            $('#fName').val(studentData[3]);

            $.ajax({
               url: 'getStudentData.php',
      			type: 'POST',
      			cache: false,
      			data: {'stID':stID},
      			success: function(data){
                  $('#stType').val("existing");
                  stData = data.split('|');
                  if (stData[3] == 1) {
                     $('#boy').prop('checked', true);
                  }
                  else if (stData[3] == 0) {
                     $('#girl').prop('checked', true);
                  }
                  $('#bplace').val(stData[4]);
                  $('#bdate').val(normalDateFormat(stData[5]));
                  $('#ctznship').val(stData[6]);
                  if (stData[7] == '') {
                     $('#sel-gr-class option:nth-child(1)').prop('selected', true);
                     console.log('null');
                  }
                  else {
                     grclass = parseInt(stData[7])+1;
                     $('.sel-item option:nth-child('+grclass+')').prop('selected', true);
                  }
                  $('#school').val(stData[8]);
                  $('#addr').val(stData[9]);
                  $('#phone1').val(stData[10]);
                  $('#phone2').val(stData[11]);
                  $('#phone3').val(stData[12]);
                  $('#sibclass').val(stData[13]);
                  if(stData[13] != ''){
                     $('#ysib').prop('checked', true);
                     $('#nsib').prop('checked', false);
                  }
                  else{
                     $('#nsib').prop('checked', true);
                     $('#ysib').prop('checked', false);
                  }
                  $('#chronic').val(stData[17]);
                  if(stData[17] != ''){
                     $('#ychronic').prop('checked', true);
                     $('#nchronic').prop('checked', false);
                  }
                  else{
                     $('#nchronic').prop('checked', true);
                     $('#ychronic').prop('checked', false);
                  }
                  $('#diff').val(stData[18]);
                  if(stData[18] != ''){
                     $('#ydiff').prop('checked', true);
                     $('#ndiff').prop('checked', false);
                  }
                  else{
                     $('#ndiff').prop('checked', true);
                     $('#ydiff').prop('checked', false);
                  }

                  stFather = stData[14];
                  if(stFather != ''){
                     $.ajax({
                        url: 'getFatherData.php',
               			type: 'POST',
               			cache: false,
               			data: {'fID':stFather},
               			success: function(data){
                           fData = data.split('|');
                           $('#flName').val(fData[2]);
                           $('#ffName').val(fData[3]);
                           $('#fOccup').val(fData[4]);
                           $('#fIDno').val(fData[5]);
                        }
                     });
                  }
                  else{
                     $('#flName').val('');
                     $('#ffName').val('');
                     $('#fOccup').val('');
                     $('#fIDno').val('');
                  }
                  stMother = stData[15];
                  if(stMother != ''){
                     $.ajax({
                        url: 'getMotherData.php',
               			type: 'POST',
               			cache: false,
               			data: {'mID':stMother},
               			success: function(data){
                           mData = data.split('|');
                           $('#mlName').val(mData[2]);
                           $('#mfName').val(mData[3]);
                           $('#mOccup').val(mData[4]);
                           $('#mIDno').val(mData[5]);
                        }
                     });
                  }
                  else{
                     $('#mlName').val('');
                     $('#mfName').val('');
                     $('#mOccup').val('');
                     $('#mIDno').val('');
                  }

                  if(stFather && stMother){
                     console.log('parents');
                     $('#par').prop('checked', true);
                     $('#fat').prop('checked', false);
                     $('#mot').prop('checked', false);
                     $('#other').prop('checked', false);
                  }
                  else if (stFather && stMother == '') {
                     console.log('father');
                     $('#par').prop('checked', false);
                     $('#fat').prop('checked', true);
                     $('#mot').prop('checked', false);
                     $('#other').prop('checked', false);
                  }
                  else if (stFather == '' && stMother) {
                     console.log('mother');
                     $('#par').prop('checked', false);
                     $('#fat').prop('checked', false);
                     $('#mot').prop('checked', true);
                     $('#other').prop('checked', false);
                  }
                  else {
                     console.log('other');
                     $('#par').prop('checked', false);
                     $('#fat').prop('checked', false);
                     $('#mot').prop('checked', false);
                     $('#other').prop('checked', true);
                  }

                  stOther = stData[16];
                  if(stOther != ''){
                     $.ajax({
                        url: 'getOtherData.php',
               			type: 'POST',
               			cache: false,
               			data: {'oID':stOther},
               			success: function(data){
                           oData = data.split('|');
                           $('#plName').val(oData[2]);
                           $('#pfName').val(oData[3]);
                           $('#pOccup').val(oData[4]);
                           $('#pAddr').val(oData[5]);
                           $('#pphone1').val(oData[6]);
                           $('#pphone2').val(oData[7]);
                           $('#pphone3').val(oData[8]);
                           $('#pIDno').val(oData[9]);
                        }
                     });
                  }
                  else{
                     $('#plName').val('');
                     $('#pfName').val('');
                     $('#pOccup').val('');
                     $('#pAddr').val('');
                     $('#pphone1').val('');
                     $('#pphone2').val('');
                     $('#pphone3').val('');
                     $('#pIDno').val('');
                  }

			         console.log(stData);
      			}
            });
         }
         else {
            $('#stType').val("new");
         }
         console.log(student);
      },
      open: function(event, ui){
         fieldText = $('#lName').val();
      },
      focus: function(event, ui){
         // fieldText = $('#lName').val();
         if(ui.item.value == '+ Νέος Μαθητής +'){
            event.preventDefault();
            $('#lName').val(fieldText);
         }
      }
   });
   $('#bdate').datepicker({
      changeMonth: true,
      changeYear: true,
      maxDate:"+0d",
      showAnim: "slideDown",
      dateFormat: "dd/mm/yy"
   });
   $('#date').datepicker({
      maxDate:"+0d",
      showAnim: "slideDown",
      dateFormat: "dd/mm/yy"
   });
   postData = {}; //postData becomes an object
   postData["apid"] = $('input[name=appno]').val();
   $('input:not([name=appno]), select, textarea').each(function(){
      $(this).on('change', function(){
          $(this).css('background-color','');
          elemName = $(this).attr("name");
          if($.trim($(this).val())!='' && $(this).prop('disabled') == false){
             postData[elemName] = $(this).val();
          }
          else {
             postData[elemName] = '';
             console.log(elemName+" = empty");
          }
      });
   });
});

function normalDateFormat(nodate){ //https://stackoverflow.com/questions/5250244/jquery-date-formatting
   var date = new Date(nodate);
   var day = date.getDate();
   var month = date.getMonth() + 1;
   var year = date.getFullYear();
   if (day < 10) {
      day = "0" + day;
   }
   if (month < 10) {
      month = "0" + month;
   }
   var date =  day + "/" + month + "/" + year;
   return date;
}
function formActions(){
   $('#other').on('click',function(){
      $('.input-container').eq(3).find('input[type=text]').prop('disabled', false);
      $('.input-container').eq(3).find('input[type=text]').prop('required', true);
      $('.input-container').eq(2).find('input[type=text]').prop('disabled', true);
      $('.input-container').eq(1).find('input[type=text]').prop('disabled', true);
   });

   $('#fat').on('click',function(){
      $('.input-container').eq(3).find('input[type=text]').prop('disabled', true);
      $('.input-container').eq(2).find('input[type=text]').prop('disabled', true);
      $('.input-container').eq(1).find('input[type=text]').prop('disabled', false);
      $('.input-container').eq(1).find('input[type=text]').prop('required', true);
   });

   $('#mot').on('click',function(){
      $('.input-container').eq(3).find('input[type=text]').prop('disabled', true);
      $('.input-container').eq(2).find('input[type=text]').prop('disabled', false);
      $('.input-container').eq(2).find('input[type=text]').prop('required', true);
      $('.input-container').eq(1).find('input[type=text]').prop('disabled', true);
   });

   $('#par').on('click',function(){
      $('.input-container').eq(3).find('input[type=text]').prop('disabled', true);
      $('.input-container').eq(2).find('input[type=text]').prop('disabled', false);
      $('.input-container').eq(2).find('input[type=text]').prop('required', true);
      $('.input-container').eq(1).find('input[type=text]').prop('disabled', false);
      $('.input-container').eq(1).find('input[type=text]').prop('required', true);
   });

   $('#ysib').on('click', function(){
      $('#sibclass').prop('disabled', false);
      $('#sibclass').prop('required', true);
   });
   $('#nsib').on('click', function(){
      $('#sibclass').prop('disabled', true);
      $('#sibclass').prop('required', false);
   });

   $('#nleave').on('click', function(){
      $('#accomp').prop('disabled', false);
      $('#accomp').prop('required', true);
   });
   $('#yleave').on('click', function(){
      $('#accomp').prop('disabled', true);
      $('#accomp').prop('required', false);
   });

   $('#ychronic').on('click', function(){
      $('#chronic').prop('disabled', false);
      $('#chronic').prop('required', true);
   });
   $('#nchronic').on('click', function(){
      $('#chronic').prop('disabled', true);
      $('#chronic').prop('required', false);
   });

   $('#ydiff').on('click', function(){
      $('#diff').prop('disabled', false);
      $('#diff').prop('required', true);
   });
   $('#ndiff').on('click', function(){
      $('#diff').prop('disabled', true);
      $('#diff').prop('required', false);
   });
}
function init(){
   if($('#par').prop('checked') == true){
      $('.input-container').eq(3).find('input[type=text]').prop('disabled', true);
      $('.input-container').eq(2).find('input[type=text]').prop('disabled', false);
      $('.input-container').eq(2).find('input[type=text]').prop('required', true);
      $('.input-container').eq(1).find('input[type=text]').prop('disabled', false);
      $('.input-container').eq(1).find('input[type=text]').prop('required', true);
   }
   else if ($('#fat').prop('checked') == true) {
      $('.input-container').eq(3).find('input[type=text]').prop('disabled', true);
      $('.input-container').eq(2).find('input[type=text]').prop('disabled', true);
      $('.input-container').eq(1).find('input[type=text]').prop('disabled', false);
      $('.input-container').eq(1).find('input[type=text]').prop('required', true);
   }
   else if ($('#mot').prop('checked') == true) {
      $('.input-container').eq(3).find('input[type=text]').prop('disabled', true);
      $('.input-container').eq(2).find('input[type=text]').prop('disabled', false);
      $('.input-container').eq(2).find('input[type=text]').prop('required', true);
      $('.input-container').eq(1).find('input[type=text]').prop('disabled', true);
   }
   else if ($('#par').prop('checked') == true){
      $('.input-container').eq(3).find('input[type=text]').prop('disabled', false);
      $('.input-container').eq(3).find('input[type=text]').prop('required', true);
      $('.input-container').eq(2).find('input[type=text]').prop('disabled', true);
      $('.input-container').eq(1).find('input[type=text]').prop('disabled', true);
   }

   if($('#ysib').prop('checked') == true){
      $('#sibclass').prop('disabled', false);
      $('#sibclass').prop('required', true);
   }
   else{
      $('#sibclass').prop('disabled', true);
      $('#sibclass').prop('required', false);
   }
   if($('#nleave').prop('checked') == true){
      $('#accomp').prop('disabled', false);
      $('#accomp').prop('required', true);
   }
   else{
      $('#accomp').prop('disabled', true);
      $('#accomp').prop('required', false);
   }
   if($('#ychronic').prop('checked') == true){
      $('#chronic').prop('disabled', false);
      $('#chronic').prop('required', true);
   }
   else{
      $('#chronic').prop('disabled', true);
      $('#chronic').prop('required', false);
   }
   if($('#ydiff').prop('checked') == true){
      $('#diff').prop('disabled', false);
      $('#diff').prop('required', true);
   }
   else{
      $('#diff').prop('disabled', true);
      $('#diff').prop('required', false);
   }
}
function dbDelApplication(appID){
   $.ajax({
      url: 'dbDelApplication.php',
      type: 'POST',
      cache: false,
      data: {'appID':appID},
      success: function(data){
         console.log(data);
         $('#click-cover').css('display', 'flex');
         $('#cover-box-message').text(data);
         $('#cover-box-btn').on('click', function(){
            location.href = 'applications.php';
         });
      },
      error: function(){
         $('#click-cover').show();
         data = 'Κάτι πήγε στραβά. Παρακαλώ ξαναφορτώστε τη σελίδα και προσπαθήστε ξανά.';
         $('#cover-box-message').text(data);
         $('#cover-box-btn').on('click', function(){
            location.reload();
         });
      }
   });
}
function postChanges(appID){
   //alert("AppNo: "+appID); //target page: dbChangeApplication.php
   console.log("call to postChanges: "+(++ctf));
   sendForm = true;
   $('input:not([name=appno]), select, textarea').each(function(){
      elemName = $(this).attr("name");
      if( (postData[elemName] == '' && $(this).prop('required') == true) || postData["lang"] == 0 ){
         $(this).css('background-color','#ffcccc');
         scrollToFocus($(this));
         delete postData[elemName]; //removes key and value
         // sendForm = false;
      }
      else if ($(this).prop('required') == true && $.trim($(this).val()) == '') {
         $(this).css('background-color','#ffcccc');
         scrollToFocus($(this));
         // sendForm = false;
      }
      else if ($(this).prop('disabled')==true) {
         $(this).val('');
         postData[elemName] = '';
         // sendForm = false;
      }
   });
   console.log(postData);

   if ( Object.keys(postData).length > 1 && sendForm == true) {
      $.ajax({
         url: 'dbChangeApplication.php',
         type: 'POST',
         cache: false,
         data: postData,
         success: function(data){
            console.log(data);
            // location.href = 'dbChangeApplication.php';
         },
         error: function(data){
            console.log("error: "+data);
         }
      });
   }
}

function scrollToFocus(elem){
   $([document.documentElement, document.body]).animate({
        scrollTop: elem.offset().top-200
    }, 1800);
}
