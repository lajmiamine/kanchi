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
			  loadDoc();
			};
			function loadDoc() {
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
			    if (xhttp.readyState == 4 && xhttp.status == 200) {
			      myFunction(xhttp);
			    }
			  };
			  xhttp.open("GET", "notes.xml", true);
			  xhttp.send();
			}
			function myFunction(xml) {
  				var xmlDoc = xml.responseXML;
  				var rep="";
				var x = xmlDoc.getElementsByTagName("note");
				for (i = 0; i <x.length; i++) { 
				  rep += "<p>" + x[i].getElementsByTagName("nbr")[0].childNodes[0].nodeValue +
				  ". " + x[i].getElementsByTagName("text")[0].childNodes[0].nodeValue +" </p>";
				}
				document.getElementById("ajaxDiv").innerHTML = rep;
			}

			<?php

				if (isset($_POST['note'])) {
					$xml = simplexml_load_file("notes.xml");

					$text=$_POST['note'];
					$bool=false;

					$nbr=$xml->count()+1;

					foreach ($xml->children() as $note) {
						if ($note->text==$text) {
							$bool=true;
						}
					}
					if ($bool==false) {
						$child = $xml->addChild("note");
						$child->addChild("nbr", $nbr);
						$child->addChild("text", $text);
					}

					$xml->asXML("notes.xml");
				}
			?>
		</script>
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

			<!-- Main -->
				<div class="wrapper style2">
					<div class="title">Get involved</div>
					<div id="main" class="container">

						<section id="features">
								<header class="style1">
									<h2>So how can we improve the website?</h2>
									
									<form action="notes.php#main" method="post">
									  <label for="note">
									    <span>Note/idea:</span>
									    <input type="text" name="note" id="note" />
									  </label>

									  <input type='submit' value='Submit' />
									  
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
			</script>

	</body>
</html>