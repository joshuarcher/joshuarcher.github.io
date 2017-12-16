function timeAgo(timestamp) {
  var hours = Math.floor(timestamp / 3600);

  return hours + " hours ago";
}

function fetchPosts() {

  var xhr = new XMLHttpRequest();
  console.log("fetching");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // console.log(xhr.responseText);
      var posts = JSON.parse(xhr.responseText);

      writePosts(posts);
      // console.log(result);
    }
  }

  xhr.open("GET", "./php/fetch_posts.php");
  xhr.send(null);
}

function writePosts(postsJson) {
  var posts = postsJson["posts"];
  var i = 0;
  for (var index in posts) {
    var post = JSON.parse(posts[index]);
    i++;

    var listItem = document.createElement("div");
    listItem.className = "listItem";

    var listItemTop = document.createElement("div");
    listItemTop.className = "listItemTop";
    listItem.appendChild(listItemTop);

    var rankSpan = document.createElement("span");
    rankSpan.className = "rank";
    rankSpan.innerHTML = i + "."; // JARCH
    listItemTop.appendChild(rankSpan);

    var upvoteSpan = document.createElement("span");
    upvoteSpan.className = "upvote";
    upvoteSpan.id = "up_1";
    listItemTop.appendChild(upvoteSpan);

    var upvoteLink = document.createElement("a");
    upvoteLink.href = "#";
    upvoteLink.innerHTML = "<svg height=\"10\" width=\"10\"\><polygon points=\"10,10 5,0 0,10\" style=\"fill:#555;\" /></svg>";
    upvoteSpan.appendChild(upvoteLink);

    var titleSpan = document.createElement("span");
    titleSpan.className = "title";
    listItemTop.appendChild(titleSpan);

    var titleLink = document.createElement("a");
    titleLink.href = post.url;
    titleLink.innerHTML = post.title;
    titleSpan.appendChild(titleLink);

    var listItemBottom = document.createElement("div");
    listItemTop.className = "listItemBottom";
    listItem.appendChild(listItemBottom);

    var pointsSpan = document.createElement("span");
    pointsSpan.className = "listLink";
    pointsSpan.innerHTML = post.upvoteCount + " points";
    listItemBottom.appendChild(pointsSpan);

    var spacerOne = document.createTextNode(" |");
    listItemBottom.appendChild(spacerOne);

    var timeSpan = document.createElement("span");
    timeSpan.className = "listLink";
    timeSpan.innerHTML = timeAgo(post.timestamp);
    listItemBottom.appendChild(timeSpan);

    var spacerTwo = document.createTextNode(" |");
    listItemBottom.appendChild(spacerTwo);

    var hideSpan = document.createElement("span");
    hideSpan.className = "listLink";
    listItemBottom.appendChild(hideSpan);

    var hideLink = document.createElement("a");
    hideLink.href = "#";
    hideLink.innerHTML = "hide";
    hideSpan.appendChild(hideLink);

    document.getElementById("items").appendChild(listItem);

    // `
    // <div class="listItem">
    //   <div class="listItemTop">
    //     <span class="rank">1.</span>
    //     <span id="up_123456" class="upvote">
    //       <a href="#">
    //         <svg height="10" width="10">
    //           <polygon points="10,10 5,0 0,10" style="fill:#555;" />
    //         </svg>
    //       </a>
    //     </span>
    //     <span class="title">
    //       <a href="#link">Overcoming Us vs. Them</a>
    //     </span>
    //   </div>
    //   <div class="listItemBottom">
    //     <span class="listLink">115 points</span> |
    //     <span class="listLink">2 hours ago</span> |
    //     <span class="listLink" onclick="hide">
    //       <a href="#">hide</a>
    //     </span>
    //   </div>
    // </div>`;
  }

  // var items = document.getElementById("items");
  // items.innerHTML = posts;
}
