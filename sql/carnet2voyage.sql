-- -----------------------------------------------------
-- Table `carnet2voyage__carnets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `carnet2voyage__carnets` (
  `id` INT NOT NULL COMMENT '',
  `titre` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `carnet2voyage__lieux`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `carnet2voyage__lieux` (
  `id` INT NOT NULL COMMENT '',
  `nom` VARCHAR(45) NULL COMMENT '',
  `carnet2voyage__carnets_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`, `carnet2voyage__carnets_id`)  COMMENT '',
  INDEX `fk_carnet2voyage__lieux_carnet2voyage__carnets_idx` (`carnet2voyage__carnets_id` ASC)  COMMENT '',
  CONSTRAINT `fk_carnet2voyage__lieux_carnet2voyage__carnets`
    FOREIGN KEY (`carnet2voyage__carnets_id`)
    REFERENCES `carnet2voyage__carnets` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
