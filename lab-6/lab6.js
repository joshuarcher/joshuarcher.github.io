
function start() {
  console.log("startings");
  divObj = document.getElementById("box");
  divObj.style.position = "absolute";
  divObj.style.left = "10px";
  divObj.style.top = "10px";

  move_it();
}

function move_it() {

  var left_offset = divObj.style.left;
  left_offset = parseInt(left_offset) + 1;
  divObj.style.left = left_offset + "px";
  setTimeout("move_it()", 20);
}
