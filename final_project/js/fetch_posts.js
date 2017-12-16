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
    listItemBottom.appendChild(timeSpan);

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

/** Everything below this line was adapted from https://gist.github.com/skattyadz/1285806
* Converts a timestamp to how long ago syntax
* @param time The time in seconds
* @return The formatted time
*/
public static String timeAgo(int time)
{
  Unit[] units = new Unit[]
  {
      new Unit("s", 60, 1),
      new Unit("m", 3600, 60),
      new Unit("h", 86400, 3600),
      new Unit("d", 604800, 86400),
      new Unit("w", 2629743, 604800),
      new Unit("m", 31556926, 2629743),
      new Unit("y", 0, 31556926)
  };

  long currentTime = System.currentTimeMillis();
  int difference = (int)((currentTime / 1000) - (time));

  if (currentTime < 5)
  {
      return "now";
  }

  int i = 0;
  Unit unit = null;
  while ((unit = units[i++]) != null)
  {
      if (difference < unit.limit || unit.limit == 0)
      {
          int newDiff =  (int)Math.floor(difference / unit.inSeconds);
          return newDiff + "" + unit.name;
      }
  }

  return "";
}

static class Unit
{
  public String name;
  public int limit;
  public int inSeconds;

  public Unit(String name, int limit, int inSeconds)
  {
      this.name = name;
      this.limit = limit;
      this.inSeconds = inSeconds;
  }
}
