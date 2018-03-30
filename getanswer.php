<?php

$xml = simplexml_load_file("words.xml");

$jp=$_GET['jp'];
$eng=$_GET['eng'];
$r_eng='';
$bool=false;


foreach ($xml->children() as $word) {
	if (($word->jp==$jp)){
		$r_eng=$word->eng;
	}
	if (($word->jp==$jp)&&($word->eng==$eng)) {
		$bool=true;
	}
}
if ($bool==true) {
	echo '<div class="right">
		  <h3>Correct ('.$jp.'='.$r_eng.')</h3>
		  </div>';
}

if ($bool==false) {
	echo '<div class="wrong">
		  <h3>Worng ('.$jp.'='.$r_eng.')</h3>
		  </div>';
}
?>