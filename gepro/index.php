<?php

require 'class/BDD.php';

require 'class/Playlist.php';
require 'class/Song.php';

include 'menu.html';

echo '<h2>Playlists</h2>';

include 'form_playlist.php';

$playlist = new Playlist();
$playlists = $playlist->findAll();

foreach ($playlists as $une_playlist) {
	echo '<p><a href="une_playlist.php?id=' . $une_playlist['id'] . '">' . $une_playlist['name'] . '</a></p>';
}
