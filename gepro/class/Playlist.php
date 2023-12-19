<?php
class Playlist extends BDD{
    private $id;
    private $name;
    private $description;

    public function setId(int $id): self{
        $this->id = $id;
        return $this;
    }

    public function getId(): int{
        return $this->id;
    }

    public function setName(string $name): self{
        $this->name = $name;
        return $this;
    }

    public function getName(): string{
        return $this->name;
    }

    public function setDescription(string $desc): self{
        $this->description = $desc;
        return $this;
    }
    public function getDescription(): string{
        return $this->description;
    }

    public function findAll()
	{
		// On récupère la connexion et on lance une requete
		$requete = $this->getConnexion()->query('SELECT * FROM playlist');
		// Génère un tableau PHP à partir du résultat de requete
		$categories = $requete->fetchAll();

		return $categories;
	}

    public function findOneById($id)
	{
		$sql = 'SELECT * FROM playlist WHERE id = :id';
		$requete = $this->getConnexion()->prepare($sql);
		$requete->execute([
			'id' => $id
		]);

		$produit = $requete->fetch();

		return $produit;
	}

    public function save($form)
	{
		if (empty($form['name'])) {
			return 'Le nom de la playlist est obligatoire';
		} else if (empty($form['description'])) {
			return 'La description de la playlist est obligatoire';
		} else {
			// Sauvegarde en base
			$sql = "INSERT INTO playlist (name, description) VALUES (:name, :description)";
			$requete = $this->getConnexion()->prepare($sql);
			$requete->execute([
				'name' => $form['name'],
				'description' => $form['description'],
			]);

			return 'Playlist ajoutée';
		}
	}

    public function update($form, $id)
	{
		if (empty($form['nom'])) {
			return 'Le nom de la playlist est obligatoire';
		} else if (empty($form['description'])) {
			return 'La description de la playlist est obligatoire';
		} else if (empty($id)) {
			return 'Impossible de retrouver la playlist à mettre à jour';
		} else {
			// Mise à jour en base
			$sql = "UPDATE playlist SET nom = :n, description = :d WHERE id = :id";
			$requete = $this->getConnexion()->prepare($sql);
			$requete->execute([
				'n' => $form['nom'],
				'd' => $form['description'],
				'id' => $id,
			]);

			return 'Playlist mise à jour';
		}
	}

    public function delete($id)
	{
		$sql = "DELETE FROM playlist WHERE id = :id";
		$requete = $this->getConnexion()->prepare($sql);
		$requete->execute([
			'id' => $id,
		]);

		if ($requete->rowCount() > 0) {
			return 'Playlist supprimée';
		} else {
			return 'Playlist introuvable';
		}
	}
}
?>