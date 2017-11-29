function load_cookie() {
  var cookie = document.cookie;
  // console.log("hello");
  if (!cookie) {
    var date = new Date();
    date.setTime(date.getTime() + (60000*60*24)); // expires in one day
    document.cookie = "dates=11/17/2016,12/25/2016;expires=" + date.toGMTString();
  }

  var fullDate = cookie.split(";")[0];
  var dates = fullDate.split("=")[1];
  console.log(dates);
  var dateOne = dates.split(",")[0];
  var dateTwo = dates.split(",")[1];

  document.getElementById("date1").value = dateOne;
  document.getElementById("date2").value = dateTwo;
}

function save_cookie() {
  var dateOne = document.getElementById("date1").value;
  var dateTwo = document.getElementById("date2").value;

  var date = new Date();
  date.setTime(date.getTime() + (60000*60*24));
  document.cookie = "dates="+dateOne+","+dateTwo+";expires="+date.toGMTString();
}
