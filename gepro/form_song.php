<?php
if (isset($update2) && $update2 == true) {
	$isUpdate2 = true;
	$legend2 = 'Mettre à jour la musique';
	$submit2 = 'Mettre à jour';
} else {
	$isUpdate2 = false;
	$legend2 = 'Ajout d\'une musique';
	$submit2 = 'Ajouter';
}
?>

<form action="" method="POST">
    <fieldset>
        <legend>
            <?= $legend2; ?>
        </legend>

        <label for="title">Nom : </label>
        <input type="text" name="title" id="title" placeholder="Nom de la musique">
        <br />
        <label for="rating">Rating (note de 0 à 10) : </label>
        <input type="number" min="0" max="10" name="rating" id="rating">
        <br />

        <input type="submit" value="<?= $submit2; ?>" name="submit2">
    </fieldset>
</form>

<?php
// Test si on a reçu le bouton de soumission du formulaire
if (isset($_POST['submit2'])) {
	$song = new Song();

	if ($isUpdate2 == true) {
		echo $song->update($_POST);
		header('location:une_musique.php?id='.$_GET['id']);
	} else {
		echo $song->save($_POST);
		header('location:une_playlist.php?id='.$_GET['id']);
	}
}
?>