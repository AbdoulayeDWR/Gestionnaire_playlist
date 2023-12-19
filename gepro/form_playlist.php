<?php
if (isset($update) && $update == true) {
	$isUpdate = true;
	$legend = 'Mettre à jour la playlist';
	$submit = 'Mettre à jour';
} else {
	$isUpdate = false;
	$legend = 'Ajout d\'une playlist';
	$submit = 'Ajouter';
}
?>

<form action="" method="POST">
	<fieldset>
		<legend>
			<?= $legend; ?>
		</legend>

		<label for="name">Nom : </label>
		<input type="text" name="name" id="name" placeholder="Nom de la playlist" <?php
																		if ($isUpdate == true) {
																			echo 'value="' . $une_playlist['name'] . '"';
																		}
																		?>>
		<br />
		<label for="description">Description :</label>
		<br />
		<textarea cols="30" rows="10" name="description" id="description"><?php
																			if ($isUpdate == true) {
																				echo $une_playlist['description'];
																			}
																			?></textarea>
		<br />
		<input type="submit" value="<?= $submit; ?>" name="submit">
	</fieldset>
</form>

<?php
// Test si on a reçu le bouton de soumission du formulaire
if (isset($_POST['submit'])) {
	$playlist = new Playlist();

	if ($isUpdate == true) {
		echo $playlist->update($_POST, $_GET['id']);
	} else {
		echo $playlist->save($_POST);
	}
}
?>