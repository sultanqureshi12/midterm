    <div class="container">
        <button id="portfolio-posts-btn">Load More Posts</button>
        <div id="portfolio-posts-container"></div>
    </div>
    

    <script type="text/javascript">
        
var portfoliopostbtn = document.getElementById("portfolio-posts-btn");
var portfoliopostscontainer= document.getElementById("portfolio-posts-container");

if(portfoliopostbtn){
portfoliopostbtn.addEventListener("click", function(){

    var ourRequest = new XMLHttpRequest();
ourRequest.open('GET', 'http://localhost/mid/about-us/wp-json/wp/v2/posts');
ourRequest.onload = function() {
  if (ourRequest.status >= 200 && ourRequest.status < 400) {
    var data = JSON.parse(ourRequest.responseText);
    console.log(data);
  } else {
    console.log("We connected to the server, but it returned an error.");
  }
};

ourRequest.onerror = function() {
  console.log("Connection error");
};

ourRequest.send();
})


}


    </script>
    