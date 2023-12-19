<?php

require 'class/BDD.php';
require 'class/Playlist.php';
include 'class/Song.php';

include 'menu.html';

if (isset($_GET['id'])) {
	$song = new Song();
	$liste_songs = $song->findAll();
	foreach ($liste_songs as $un_song) {
		echo $song->delete($un_song['id']);
	};
	$playlist = new Playlist();
	echo $playlist->delete($_GET['id']);
}