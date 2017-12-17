function upvote(timestamp) {
  // make ajax call
  // store cookie for upvoted
  // refresh page

  var xhr = new XMLHttpRequest();
  console.log("fetching");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      saveCookie(timestamp);
      fetch();
    }
  }

  xhr.open("POST", "./php/upvote_post.php?timestamp=" + timestamp);
  xhr.send(null);
}

function saveCookie(timestamp) {

  var da = new Date();
  da.setTime(da.getTime() + (365*60000));

  var cookie = document.cookie;

  if (!cookie) {
    document.cookie = "timestamps=" + timestamp + ";" + "expires=" + da.toGMTString();
    return;
  }

  var firstCookie = cookie.split(";")[0];

  if (!firstCookie) {
    return;
  }

  var timeStamps = firstCookie.split("=")[1].split(",");

  if (!timeStamps) {
    return;
  }

  timeStamps.push(timestamp);

  document.cookie = "timestamps=" + timeStamps.join(",") + ";" + "expires=" + da.toGMTString();
}

function timeAgo(timestamp) {

  var diffSeconds = Math.floor(Date.now() / 1000) - timestamp;
  var diffMinutes = Math.floor(diffSeconds / 60);
  var diffHours = Math.floor(diffMinutes / 60);

  if (diffHours < 1) {
    if (diffMinutes < 1) {
      return "less than a minute ago";
    } else if (diffMinutes == 1) {
      return "1 minute ago";
    }
    return diffMinutes + " minutes ago";
  } else if (diffHours == 1) {
    return "1 hour ago";
  }

  return diffHours + " hours ago";
}

function fetch() {

  var xhr = new XMLHttpRequest();
  console.log("fetching");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // console.log(xhr.responseText);
      var posts = JSON.parse(xhr.responseText);

      writePosts(posts);
    }
  }

  xhr.open("GET", "./php/fetch_posts.php");
  xhr.send(null);
}

function hideUpvotes() {
  var cookie = document.cookie;

  if (!cookie) {
    return;
  }

  var firstCookie = cookie.split(";")[0];

  if (!firstCookie) {
    return;
  }

  var timeStamps = firstCookie.split("=")[1].split(",");

  for (var i=0; i < timeStamps.length; i++) {
    var someId = "up_" + timeStamps[i];
    var element = document.getElementById(someId);

    if (element) {
        element.style.visibility = "hidden";
    }
  }
}

function writePosts(postsJson) {
  var posts = postsJson["posts"];
  var i = 0;

  document.getElementById("items").innerHTML = "";
  for (var index in posts) {
    var post = JSON.parse(posts[index]);
    i++;

    var listItem = document.createElement("div");
    listItem.className = "listItem";

    var listItemTop = document.createElement("div");
    listItemTop.className = "listItemTop";

    var rankSpan = document.createElement("span");
    rankSpan.className = "rank";
    rankSpan.innerHTML = i + ".";
    listItemTop.appendChild(rankSpan);

    var upvoteSpan = document.createElement("span");
    upvoteSpan.className = "upvote";
    upvoteSpan.id = "up_"+post.timestamp;

    var upvoteLink = document.createElement("a");
    upvoteLink.href = "#";
    upvoteLink.onclick = function () {
      upvote(post.timestamp);
    }
    upvoteLink.innerHTML = "<svg height=\"10\" width=\"10\"\><polygon points=\"10,10 5,0 0,10\" style=\"fill:#555;\" /></svg>";
    upvoteSpan.appendChild(upvoteLink);

    listItemTop.appendChild(upvoteSpan);

    var titleSpan = document.createElement("span");
    titleSpan.className = "title";
    var titleLink = document.createElement("a");
    titleLink.href = post.url;
    titleLink.innerHTML = post.title;
    titleSpan.appendChild(titleLink);

    listItemTop.appendChild(titleSpan);
    listItem.appendChild(listItemTop);

    var listItemBottom = document.createElement("div");
    listItemBottom.className = "listItemBottom";

    var pointsSpan = document.createElement("span");
    pointsSpan.className = "listLink";
    pointsSpan.innerHTML = post.upvoteCount + " points";
    listItemBottom.appendChild(pointsSpan);

    var spacerOne = document.createTextNode(" | ");
    listItemBottom.appendChild(spacerOne);

    var timeSpan = document.createElement("span");
    timeSpan.className = "listLink";
    timeSpan.innerHTML = timeAgo(post.timestamp);
    listItemBottom.appendChild(timeSpan);

    var spacerTwo = document.createTextNode(" | ");
    listItemBottom.appendChild(spacerTwo);

    var hideSpan = document.createElement("span");
    hideSpan.className = "listLink";

    var hideLink = document.createElement("a");
    hideLink.href = "#";
    hideLink.innerHTML = "hide";
    hideSpan.appendChild(hideLink);

    listItemBottom.appendChild(hideSpan);

    listItem.appendChild(listItemBottom);

    document.getElementById("items").appendChild(listItem);

    hideUpvotes();
  }

}
