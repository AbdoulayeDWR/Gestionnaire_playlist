<?php
// une_playlist.php

require 'class/BDD.php';
require 'class/Playlist.php';
require 'class/Song.php';

include 'menu.html';

if (isset($_GET['id'])) {

	$playlist = new Playlist();
	$une_playlist = $playlist->findOneById($_GET['id']);

	if ($une_playlist == false) {
		echo '<p>Playlist introuvable</p>';
	} else {
		echo '<h1>' . $une_playlist['name'] . '</h1>';
		echo '<p>' . $une_playlist['description'] . '</p>';
		
		echo '<h2>Musiques</h2>';

		$song = new Song();
		$liste_songs = $song->findAll();

		if (!empty($liste_songs)) {
			foreach ($liste_songs as $un_song) {
				echo '<p><a href="une_musique.php?id='. $un_song['id'].'">' . $un_song['title'] . '</a></p>';
			}
		} else {
			echo '<p>Il n\'y a aucune musique</p>';
		}

		$update = true;
		$update2 = false;
		include 'form_playlist.php';
		include 'form_song.php';

		echo '<p><a href="suppr_playlist.php?id=' . $une_playlist['id'] . '">Supprimer</a></p>';
	}
} else {
	echo '<p>Aucune playlist reçue</p>';
}