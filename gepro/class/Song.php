<?php
class Song extends BDD
{
    private $id;
    private $title;
    private $playlist_id;
    private $rating;

    public function setId(int $id): self
	{
		$this->id = $id;
		return $this;
	}
	public function getId(): int
	{
		return $this->id;
	}

	public function setTitle(string $title): self
	{
		$this->title = $title;
		return $this;
	}
	public function getTitle(): string
	{
		return $this->title;
	}

    public function setPlaylistId(int $playlist_id): self
	{
		$this->playlist_id = $playlist_id;
		return $this;
	}
	public function getPlaylistId(): int
	{
		return $this->playlist_id;
	}
    public function setRating(int $rating): self
	{
		$this->rating = $rating;
		return $this;
	}
	public function getRating(): int
	{
		return $this->rating;
	}
	// Tu dois pas chercher le playlist_id ici mais dans la table playlist_song
	public function findAll()
	{
		$sql1 = 'SELECT * FROM song WHERE playlist_id = :playlist_id';
		$requete1 = $this->getConnexion()->prepare($sql1);
		$requete1->execute([
			'playlist_id' => $_GET['id'],
		]);
		// On récupère la connexion et on lance une requete
		//$requete = $this->getConnexion()->query('SELECT * FROM song WHERE playlist_id = :playlist_id');
		// Génère un tableau PHP à partir du résultat de requete
		$songs = $requete1->fetchAll();

		return $songs;
	}

	public function findOneById($id)
	{
		$sql = 'SELECT * FROM song WHERE id = :id';
		$requete = $this->getConnexion()->prepare($sql);
		$requete->execute([
			'id' => $id
		]);

		$song = $requete->fetch();

		return $song;
	}

    public function save($form)
	{
		if (empty($form['title'])) {
			return 'Le nom de la musique est obligatoire';
		} else {
			// Sauvegarde en base
			$playlist_id = $_GET['id'];
			$sql = "INSERT INTO song (title, rating, playlist_id) VALUES (:title, :rating, $playlist_id)";
			$requete = $this->getConnexion()->prepare($sql);
			$requete->execute([
				'title' => $form['title'],
				'rating' => $form['rating'],
			]);

			return 'Musique ajoutée';
		}
	}

    public function update($form)
	{
		$id = $_GET['id'];
		if (empty($form['title'])) {
			return 'Le nom de la musique est obligatoire';
		} else if (empty($id)) {
			return 'Impossible de retrouver la musique à mettre à jour';
		} else {
			// Mise à jour en base
			$sql = "UPDATE song SET title = :t, rating = :r WHERE id = :id";
			$requete = $this->getConnexion()->prepare($sql);
			$requete->execute([
				't' => $form['title'],
				'r' => $form['rating'],
				'id' => $id,
			]);

			return 'Musique mise à jour';
		}
	}

    public function delete($id)
	{
		$sql = "DELETE FROM song WHERE id = :id";
		$requete = $this->getConnexion()->prepare($sql);
		$requete->execute([
			'id' => $id,
		]);

		if ($requete->rowCount() > 0) {
			return 'Musique supprimée';
		} else {
			return 'Musique introuvable';
		}
	}
}
?>