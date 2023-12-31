-- MySQL Script generated by MySQL Workbench
-- Tue Nov 28 14:33:14 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-----------------------------------------------------
-- Table `song`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `song` (
  `id` INT(9) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `rating` INT(2) NOT NULL DEFAULT 10,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `album`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `album` (
  `id` INT(9) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `release_date` DATE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `artist`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `artist` (
  `id` INT(9) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NULL,
  `age` INT(3) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `song_artist`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `song_artist` (
  `song_id` INT(9) NOT NULL,
  `artist_id` INT(9) NOT NULL,
  PRIMARY KEY (`song_id`, `artist_id`),
  INDEX `idx_song_artiste_artist_id` (`artist_id` ASC),
  INDEX `idx_song_artiste_song_id` (`song_id` ASC),
  CONSTRAINT `fk_song_artist_song`
    FOREIGN KEY (`song_id`)
    REFERENCES `song` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_song_artist_artist`
    FOREIGN KEY (`artist_id`)
    REFERENCES `artist` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `song_album`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `song_album` (
  `song_id` INT(9) NOT NULL,
  `album_id` INT(9) NOT NULL,
  PRIMARY KEY (`song_id`, `album_id`),
  INDEX `idx_song_album_album_id` (`album_id` ASC),
  INDEX `idx_song_album_song_id` (`song_id` ASC),
  CONSTRAINT `fk_song_album_song`
    FOREIGN KEY (`song_id`)
    REFERENCES `song` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_song_album_album`
    FOREIGN KEY (`album_id`)
    REFERENCES `album` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `playlist`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `playlist` (
  `id` INT(9) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `playlist_song`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `playlist_song` (
  `playlist_id` INT(9) NOT NULL,
  `song_id` INT(9) NOT NULL,
  PRIMARY KEY (`playlist_id`, `song_id`),
  INDEX `idx_playlist_song_song_id` (`song_id` ASC),
  INDEX `idx_playlist_song_playlist_id` (`playlist_id` ASC),
  CONSTRAINT `fk_playlist_song_playlist`
    FOREIGN KEY (`playlist_id`)
    REFERENCES `playlist` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_playlist_song_song`
    FOREIGN KEY (`song_id`)
    REFERENCES `song` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
