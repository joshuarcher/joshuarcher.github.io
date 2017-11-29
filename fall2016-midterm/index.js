
var moving = false;

function move_ghost(e) {
  // console.log("mouse over");
  // var ghost = document.getElementById("ghost");
  if (!moving) {
    // originalX = null;
    // originalY = null;
    return;
  }
  if (!originalX || !originalY) {
    var left_offset = ghost.style.left;
    var top_offset = ghost.style.top;
    // console.log(left_offset);
    originalX = parseInt(left_offset);
    originalY = parseInt(top_offset);
  }

  var dx = e.clientX - clickX;
  var dy = e.clientY - clickY;
  var newX = (originalX + dx) + "px";
  var newY = (originalY + dy) + "px";
  ghost.style.left = newX;
  ghost.style.top = newY;

  // console.log(newX);

  // console.log(dx);
  // console.log(dy);
  // console.log(ghost);
  // console.log(e);
  // console.log(e.clientX);
  // console.log(e.clientY);

}

var ghost = document.getElementById("ghost");
ghost.onmousemove = move_ghost;
ghost.style.position = "absolute";
ghost.style.left = "0px";
ghost.style.top = "0px";

var originalX = 0;
var originalY = 0;

ghost.onclick = function(e) {
  moving = !moving;

  var left_offset = ghost.style.left;
  var top_offset = ghost.style.top;

  orignalX = parseInt(left_offset);
  originalY = parseInt(top_offset);

  console.log(originalX);
  console.log(originalY);

  clickX = e.clientX;
  clickY = e.clientY;
  // console.log(e.clientX);
  // console.log(e.clientY);
  // lastX = e.clientX;
  // lastY = e.clientY;

  // console.log(moving);
}
