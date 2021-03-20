-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.8-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para db_join
CREATE DATABASE IF NOT EXISTS `db_join` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_join`;

-- Copiando estrutura para tabela db_join.tb_categoria_produto
CREATE TABLE IF NOT EXISTS `tb_categoria_produto` (
  `id_categoria_planejamento` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(150) NOT NULL,
  PRIMARY KEY (`id_categoria_planejamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_join.tb_categoria_produto: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `tb_categoria_produto` DISABLE KEYS */;
INSERT INTO `tb_categoria_produto` (`id_categoria_planejamento`, `nome_categoria`) VALUES
	(29, 'Eletrônicos');
/*!40000 ALTER TABLE `tb_categoria_produto` ENABLE KEYS */;

-- Copiando estrutura para tabela db_join.tb_produto
CREATE TABLE IF NOT EXISTS `tb_produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria_produto` int(11) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `nome_produto` varchar(150) NOT NULL,
  `valor_produto` float(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id_produto`),
  KEY `IXFK_tb_produto_tb_categoria_produto` (`id_categoria_produto`),
  CONSTRAINT `FK_tb_produto_tb_categoria_produto` FOREIGN KEY (`id_categoria_produto`) REFERENCES `tb_categoria_produto` (`id_categoria_planejamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_join.tb_produto: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `tb_produto` DISABLE KEYS */;
INSERT INTO `tb_produto` (`id_produto`, `id_categoria_produto`, `data_cadastro`, `nome_produto`, `valor_produto`) VALUES
	(30, 29, '2021-03-20 09:19:29', 'Tv', 2000.00);
/*!40000 ALTER TABLE `tb_produto` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
