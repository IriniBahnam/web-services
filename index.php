<html>
<head>
<title>Bond Web Service Demo</title>
<style>
	body {font-family:georgia;}

    .Game{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }

    .pic img{
	max-width:50px;
 }

</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">

function bondTemplate(game){
  return `
  	
			<div class="game">
             <b>Name</b>: ${game.Name}<br>
             <b>Genre</b>:${game.Genre}<br>
             <b>Year</b>: ${game.Year}<br>
             <b>Company</b>: ${game.Company}<br>
             <b>Producers</b>:${game.Producers}<br>
             <b>Type</b>:${game.Type}<br>
          <div class="pic"><img src="thumbnails/${game.Image}"/>  </div>
      </div>

  `;
}

$(document).ready(function() { 
 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
   console.log("hello");
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
       
   request.done(function( data ) {
     console.log(data);
  
/*
   //using JSON.stringify we can view data on the page
   let myData = JSON.stringify(data, null, 4);
     myData = "<pre>" + myData + "</pre>";
   $("#output").html(myData);
*/

  //use data.title to show the order of films
     $("#gametitle").html(data.title);

  //clear the previous films
     $("#games").html("");
     
     //loop through data.films and add to #films div
    $.each(data.games, function(i, item){
     let myGame = bondTemplate(item);
     $("<div></div>").html(myGame).appendTo("#games");
     });
   //$("#output").html(myData);
 
  });
     
    request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
}); 
}); 


</script>
</head>
	<body>
	<h1>Web Service</h1>
		<a href="year" class="category">Video Games</a><br />
		<a href="box" class="category">Game Description</a>
		<h3 id="gametitle">Types of Video Games</h3>
  
		<div id="games">
<!--         			<div class="film">
             <b>Film</b>: 1<br>
             <b>Title</b>:Dr. No<br>
             <b>Year</b>: 1962<br>
             <b>Director</b>: Terence Young<br>
             <b>Producers</b>: Harry Saltzman and Albert R. Broccoli<br>
             <b>Writers</b>: Richard Maibaum, Johanna Harwood and Berkely Mather<br>
             <b>Composer</b>: Monty Norman<br>
             <b>Bond</b>: Sean Connery<br>
             <b>Budget</b>: $1,000,000.00<br>
             <b>BoxOffice</b>: $59,567,035.00<br>
          <div class="pic"><img src="thumbnails/dr-no.jpg"/>  </div>
      </div>
        -->
		</div>

		<div id="output">Results go here</div>
	</body>
</html>