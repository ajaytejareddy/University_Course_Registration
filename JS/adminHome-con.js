function getVal(){
    let date = document.getElementById('datepicker').value;
    let open = document.getElementById('timepicker').value;
    let close = document.getElementById('timepicker2').value;
    let allowed = document.getElementById('max_allowed').value;
 
    console.log(date+" "+open+" "+close+"  ==> "+allowed);
     if(date!="" && open!="" && close!="")
         return true;
     else
         return false;
 }
 
 $( function() {
     $( "#datepicker" ).datepicker();
   } );
 
   $(function() {
   $('#timepicker').timepicker({
     timeFormat: 'HH:mm',
     minTime: '09:00',
     maxHour: 24,
     maxMinutes: 30,
     dropdown: true,
     scrollbar: true
     
   });
 
 
 });
 
 $(function() {
   $('#timepicker2').timepicker({
     timeFormat: 'HH:mm',
     minTime: '09:00',
     maxHour: 24,
     maxMinutes: 30,
     dropdown: true,
     scrollbar: true
     
   });
 
 
 });
  