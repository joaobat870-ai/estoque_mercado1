CREATE DATABASE IF NOT EXISTS `estoque_mercado_db`;

USE `estoque_mercado_db`;

CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `usuario` VARCHAR(50) NOT NULL UNIQUE,
    `senha` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `categorias` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `produtos` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `descricao` VARCHAR(255) NOT NULL,
    `preco` DECIMAL(10, 2) NOT NULL,
    `estoque` INT(11) NOT NULL,
    `categoria_id` INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`categoria_id`) REFERENCES `categorias`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserir usuário administrador padrão (login: admin / senha: 123456)
INSERT IGNORE INTO `usuarios` (`id`, `nome`, `usuario`, `senha`) VALUES
(1, 'Operador do Sistema', 'admin', '123456');

-- Inserir as categorias do mercado
INSERT INTO `categorias` (`nome`) VALUES
('Açougue'),
('Padaria'),
('Mercearia'),
('Bazar'),
('Hortifruti');

-- Inserir produtos de exemplo para cada setor
INSERT INTO `produtos` (`descricao`, `preco`, `estoque`, `categoria_id`) VALUES
('Contra Filé Bovino Kg', 42.90, 35, 1),
('Pão Francês Kg', 14.90, 50, 2),
('Arroz Branco Tipo 1 5kg', 26.50, 120, 3),
('Jogo de Copos de Vidro 6un', 29.90, 15, 4),
('Batata Doce Roxa Kg', 5.99, 80, 5);
