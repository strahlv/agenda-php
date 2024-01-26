function focusForm(dateString) {
  $("#left").removeClass("hidden");
  $("#data").val(dateString);
  $("#titulo").focus();
}

const HOLIDAYS_URL =
  "https://www.googleapis.com/calendar/v3/calendars/pt.brazilian%23holiday%40group.v.calendar.google.com/events?key=AIzaSyD0_dXEF4xTrJ7JhKliDNT8DyfDbvVfigA";

var xmlhttp = new XMLHttpRequest();
// xmlhttp.onreadystatechange = function () {
//   if (this.readyState == 4 && this.status == 200) {
//     document.getElementById("right").innerHTML = this.responseText;
//   }
// };
xmlhttp.open("GET", HOLIDAYS_URL, true);
xmlhttp.send();
