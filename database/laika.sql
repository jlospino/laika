-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.11-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para laika
CREATE DATABASE IF NOT EXISTS `laika_01` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `laika_01`;

-- Volcando estructura para procedimiento laika.add_document_type
DELIMITER //
CREATE PROCEDURE `add_document_type`(
	`code_doc` VARCHAR(5),
	`description` VARCHAR(30)
)
BEGIN

INSERT INTO document_type(code,description,created_at)
VALUES (code_doc, description, NOW());

END//
DELIMITER ;

-- Volcando estructura para procedimiento laika.delete_document_type
DELIMITER //
CREATE PROCEDURE `delete_document_type`(
	`id` INT
)
BEGIN

	UPDATE `document_type`
	SET updated_at = NOW(),
	deleted_at = NOW()
	WHERE id = id;
	
END//
DELIMITER ;

-- Volcando estructura para tabla laika.document_type
CREATE TABLE IF NOT EXISTS `document_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `description` varchar(30) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla laika.document_type: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `document_type` DISABLE KEYS */;
INSERT INTO `document_type` (`id`, `code`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'CC', 'Cedula De Ciudadania', '2021-02-23 20:53:27', '2021-02-23 21:27:53', '2021-02-23 21:27:53'),
	(2, 'TI', 'Tarjeta De Identidad', '2021-02-24 00:34:59', NULL, NULL);
/*!40000 ALTER TABLE `document_type` ENABLE KEYS */;

-- Volcando estructura para procedimiento laika.get_document_types
DELIMITER //
CREATE PROCEDURE `get_document_types`()
SELECT dt.id, dt.code, dt.description
FROM document_type dt
WHERE deleted_at IS NULL

/*CALL add_document_type('CC', 'Cédula de ciudadania')*/
/*CALL get_document_types*/
/*CALL update_document_type(1,'CC', 'Cedula De Ciudadania');*/
/*CALL delete_document_type(1)*/

-- Volcando estructura para procedimiento laika.update_document_type
DELIMITER //
CREATE PROCEDURE `update_document_type`(
	`id` INT,
	`code_doc` VARCHAR(5),
	`description` VARCHAR(30)
)
BEGIN

	UPDATE `document_type`
	SET code = code_doc,
	description = description,
	updated_at = NOW()
	WHERE id = id;
	

END//
DELIMITER ;

-- Volcando estructura para tabla laika.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `document` varchar(15) NOT NULL,
  `document_type_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `document` (`document`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_user_document_type` (`document_type_id`),
  CONSTRAINT `FK_user_document_type` FOREIGN KEY (`document_type_id`) REFERENCES `document_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla laika.user: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `address`, `email`, `document`, `document_type_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Jose Ospino', 'Bogotá', 'ospinojose36@gmail.com', '1033799695', 1, '2021-02-24 04:38:39', '2021-02-24 04:38:39', NULL),
	(2, 'Jose User Prueba - Editado', 'Calle 55 # 20-65', 'usuario1262@gmail.com', '103379969536', 2, '2021-02-24 04:57:29', '2021-02-24 16:35:15', NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
