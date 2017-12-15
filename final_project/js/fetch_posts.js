function fetchPosts() {

  var xhr = new XMLHttpRequest();
  console.log("fetching");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var posts = JSON.parse(this.responseText);

      writePosts(posts);
      console.log(result);
    }
  }

  xhr.open("GET", "../php/fetch_posts.php");
  xhr.send(null);
}

function writePosts(postsJson) {
  var posts = postsJson["posts"];

  var items = document.getElementById("items");
  items.innerHTML = posts;
}
