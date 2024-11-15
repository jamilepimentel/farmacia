CREATE DATABASE IF NOT EXISTS farmacia CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE farmacia;

-- Tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    role ENUM('admin', 'atendente') NOT NULL DEFAULT 'atendente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de medicamentos
CREATE TABLE IF NOT EXISTS medicamentos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT UNSIGNED NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    validade DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de vendas
CREATE TABLE IF NOT EXISTS vendas (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    medicamento_id INT UNSIGNED NOT NULL,
    quantidade INT UNSIGNED NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    data_venda TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (medicamento_id) REFERENCES medicamentos(id)
);

-- Inserindo um usuário administrador padrão
INSERT INTO usuarios (nome, email, senha, role) 
VALUES ('Admin', 'admin@farmacia.com', PASSWORD('admin123'), 'admin');