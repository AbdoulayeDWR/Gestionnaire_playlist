<?php
// une_playlist.php

require 'class/BDD.php';
require 'class/Playlist.php';
require 'class/Song.php';

include 'menu.html';

if (isset($_GET['id'])) {

	$song = new Song();
	$une_musique = $song->findOneById($_GET['id']);

	if ($une_musique == false) {
		echo '<p>Musique introuvable</p>';
	} else {
		echo '<h1>Titre :' . $une_musique['title'] . '</h1>';
		echo '<p>Rating :' . $une_musique['rating'] . '</p>';

		$update2 = true;
		include 'form_song.php';

		echo '<p><a href="suppr_musique.php?id=' . $une_musique['id'] . '">Supprimer</a></p>';
	}
} else {
	echo '<p>Aucune musique reçue</p>';
}

