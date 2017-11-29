
var max_move_count = 0;

var amount_to_move = 400;
var timeout_time = 5;

function start() {
  console.log("startings");
  divObj = document.getElementById("box");
  divObj.style.position = "absolute";
  divObj.style.left = "10px";
  divObj.style.top = "10px";

  // move_it();
  start_moving();
}

function move_it() {

  var left_offset = divObj.style.left;
  left_offset = parseInt(left_offset) + 1;
  divObj.style.left = left_offset + "px";
  if (max_move_count < 200) {
    max_move_count += 1;
    setTimeout("move_it()", timeout_time);
  }
}

function start_moving() {
  move_right(amount_to_move);
}

var move_right_count = 0;
function move_right(times) {
  move_right_count += 1;
  var left_offset = divObj.style.left;
  left_offset = parseInt(left_offset) + 1;
  divObj.style.left = left_offset + "px";
  if (move_right_count < times) {
    setTimeout(move_right, timeout_time, times);
  } else {
    console.log(move_right_count);
    move_down(times);
  }
}

var move_down_count = 0;
function move_down(times) {
  move_down_count += 1;
  var top_offset = divObj.style.top;
  top_offset = parseInt(top_offset) + 1;
  divObj.style.top = top_offset + "px";
  // var left_offset = divObj.style.left;
  // left_offset = parseInt(left_offset) - 1;
  // divObj.style.left = left_offset + "px";
  if (move_down_count < times) {

    setTimeout(move_down, timeout_time, times);
  } else {
    move_left(times);
  }
}

var move_left_count = 0;
function move_left(times) {
  move_left_count += 1;
  var left_offset = divObj.style.left;
  left_offset = parseInt(left_offset) - 1;
  divObj.style.left = left_offset + "px";
  if (move_left_count < times) {
    setTimeout(move_left, timeout_time, times);
  } else {
    move_up(times);
  }
}

var move_up_count = 0;
function move_up(times) {
  move_up_count += 1;
  var top_offset = divObj.style.top;
  top_offset = parseInt(top_offset) - 1;
  divObj.style.top = top_offset + "px";
  // var left_offset = divObj.style.left;
  // left_offset = parseInt(left_offset) - 1;
  // divObj.style.left = left_offset + "px";
  if (move_up_count < times) {
    setTimeout(move_up, timeout_time, times);
  } else {
    console.log("DONEEEE");
  }
}
