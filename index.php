<!DOCTYPE HTML>
<!--
	Escape Velocity by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Learn Japanese By Yourself</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<script type="text/javascript">
		
			window.onload = function() {
				$(document).ready(function() {
				  $(window).keydown(function(event){
				    if(event.keyCode == 13) {
				      event.preventDefault();
				      return false;
				    }
				  });
				});
				loadDoc();
			};
			function loadDoc() {
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
			    if (xhttp.readyState == 4 && xhttp.status == 200) {
			      myFunction(xhttp);
			    }
			  };
			  xhttp.open("GET", "words.xml", true);
			  xhttp.send();
			}
			function myFunction(xml) {
  				var xmlDoc = xml.responseXML;
				var x = xmlDoc.getElementsByTagName("word");
				var random=Math.round(Math.random()*x.length);
				var word=x[random].getElementsByTagName("jp")[0].childNodes[0].nodeValue;
				document.getElementById("word").innerHTML = word;
			}
		</script>
		<?php

			if (isset($_POST['jpword'])) {
				$xml = simplexml_load_file("words.xml");

				$jp=$_POST['jpword'];
				$eng=strtoupper($_POST['engword']);
				$bool=false;


				foreach ($xml->children() as $word) {
					if ($word->jp==$jp) {
						$bool=true;
					}
				}
				if ($bool==false) {
					$child = $xml->addChild("word");
					$child->addChild("jp", $jp);
					$child->addChild("eng", $eng);
				}

				$xml->asXML("words.xml");
			}
		?>
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper" class="wrapper">
					<div id="header">

						<!-- Logo -->
							<div id="logo">
								<h1><a href="index.html">Learn Japanese by yourself</a></h1>
								<p>“If you don't use it, you lose it“</p>
							</div>

					</div>
				</div>

			<!-- Intro -->
				<div id="intro-wrapper" class="wrapper style1">
					<div class="title">Add some words</div>
					<section id="intro" class="container">
						<p class="style1">Let's begin by entering some words that you recently learnt :D</p>
						
							<form action="index.php#intro-wrapper" method="post">
							  <label for="Japanese word">
							    <span>Japanese word</span>
							    <input type="text" name="jpword" />
							  </label>
							  <label for="English translation">
							    <span>English translation</span>
							    <input type="text" name="engword" />
							  </label>

							  <input type="submit" value="Submit">
							</form>

							<br class="mobile-hide" />						
				</div>

			<!-- Main -->
				<div class="wrapper style2">
					<div class="title">Refresh your memory</div>
					<div id="main" class="container">

						<!-- Image -->
							<a href="#" class="image featured">
								<img src="images/pic01.jpg" alt="" />
							</a>

						<section id="features">
								<header class="style1">
									<h2>Please give the meaning of the following word:</h2>
									

									  <p id="word" name="word"></p>
									<form>
									  <label for="Japanese word">
									    <span>English translation</span>
									    <input type="text" name="answer" id="answer" />
									  </label>

									  <input type='button' onclick='check()' id='check_answer' value='Check Answer' />
									  
									</form>
									<div id="ajaxDiv"></div>

								</header>
							</section>
					</div>
				</div>

			</div>

		<!-- Scripts -->

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script type="text/javascript">

				document.onkeydown=function(){
					if(window.event.keyCode=='13'){
						if(document.getElementById('answer').value!=""){
							check();
						}
					}
				}
				
				function check() {

				  	var ajaxRequest;  // The variable that makes Ajax possible!
	
					try{
						// Opera 8.0+, Firefox, Safari
						ajaxRequest = new XMLHttpRequest();
					} catch (e){
						// Internet Explorer Browsers
						try{
							ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
						} catch (e) {
							try{
								ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
							} catch (e){
								// Something went wrong
								alert("Your browser broke!");
								return false;
							}
						}
					}
					ajaxRequest.onreadystatechange = function(){
						if(ajaxRequest.readyState == 4){
							var ajaxDisplay = document.getElementById('ajaxDiv');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							loadDoc();
							document.getElementById('answer').value="";
						}
					}
					var jp = document.getElementById('word').innerHTML;
					var eng = document.getElementById('answer').value.toUpperCase();
					var queryString ="?jp="+jp+"&eng="+eng;
					ajaxRequest.open("GET", "getanswer.php" + queryString, true);
					ajaxRequest.send(null); 
				}

			</script>

	</body>
</html>