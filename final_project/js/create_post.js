function createPost() {

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
