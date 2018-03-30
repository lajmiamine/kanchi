<?php

	if (isset($_POST['jpword'])) {
		$xml = simplexml_load_file("words.xml");

		$jp=$_POST['jpword'];
		$eng=$_POST['engword'];
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

		echo '<div class="wrong">
		  <h3>Worng</h3>
		  </div>';
	}
?>