function makeCloud() {
  var textAreaString = document.getElementById('tags').value;
  var textAreaArraySorted = textAreaString.split(' ').sort();
  console.log(textAreaArraySorted);

  uniqueTagArray = [];
  tagCountArray = [];

  for (var i = 0; i < textAreaArraySorted.length; i++) {
    var tag = textAreaArraySorted[i];

    if (uniqueTagArray.length == 0) {
      uniqueTagArray.push(tag);
      tagCountArray.push(1);
    } else if (uniqueTagArray[uniqueTagArray.length-1] == tag) {
      tagCountArray[tagCountArray.length-1] += 1;
    } else {
      uniqueTagArray.push(tag);
      tagCountArray.push(1);
    }
  }

  // console.log(uniqueTagArray.length);
  // console.log(tagCountArray.length);
  // //
  // console.log(maxFrequency());





  var newCloudDiv = createDivWith(uniqueTagArray);
  var maxFreq = maxFrequency();
  var spanPointer;
  for (var i = 0; i < newCloudDiv.children.length; i++) {
    (function () { // closure!!!
      spanPointer = newCloudDiv.children[i];
      var tagCount = tagCountArray[i];
      var size = Math.round((tagCount / maxFreq) * 20) + 15;
      spanPointer.style.fontSize = size + "pt";
      var textToAlert = spanPointer.innerHTML + ": " + tagCount + " occurences";
      spanPointer.addEventListener("click", function() {
        alert(textToAlert);
      });
    }());
  }

  var cloud = document.getElementById("cloud");
  document.body.removeChild(cloud);

  var validationLogo = document.getElementById("w3cValidation");
  newCloudDiv.id = "cloud";
  document.body.insertBefore(newCloudDiv, validationLogo);
}

function saveCloud() {
// save contents of textarea as a cookie
}

function loadCloud() {
// load contents of previously stored cookie
}

function clearArea() {
// clear contents of text area
}

function maxFrequency() {

  return tagCountArray.slice().sort()[tagCountArray.length-1];
}

function createDivWith(uniqueTagArray) {

  var someDiv = document.createElement('div');
  someDiv.style.border = ".1em solid silver";
  someDiv.style.background = "blue";
  someDiv.style.color = "silver";
  someDiv.style.fontFamily = "Oswald, sans-serif";

  for (var i = 0; i < uniqueTagArray.length; i++) {
    var newSpan = document.createElement('span');
    newSpan.innerHTML = uniqueTagArray[i] + " ";
    someDiv.appendChild(newSpan);
  }

  return someDiv;

}
