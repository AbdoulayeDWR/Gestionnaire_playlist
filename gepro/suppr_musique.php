<?php

require 'class/BDD.php';
require 'class/Song.php';

include 'menu.html';

if (isset($_GET['id'])) {
	$song = new Song();
	echo $song->delete($_GET['id']);
}