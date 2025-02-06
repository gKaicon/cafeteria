create database if not exists trabalho;
use trabalho;

create table users(
	id integer auto_increment primary key,
	email varchar(255),
	pwd varchar(255),
	username varchar(255),
    tipoUsuario varchar(20)
);

insert into users (email, pwd, username, tipoUsuario) values ('administrador@gmail.com', '$2y$10$v.FksP6V7pkzhCK04xVAJuFhMVQl0e8Ijh2YSZAOFrk0.4cQl9m5u', 'admin', 'admin');
insert into users (email, pwd, username, tipoUsuario) values ('kaicon@gmail.com', '$2y$10$bFmRFyzBw22Ji1TTULdpYecZZffbGmxyp/BDnRzTzHcUUn6A/RUpy', 'kaicon', 'default');
insert into users (email, pwd, username, tipoUsuario) values ('rosinei.figueiredo@ifmg.edu.br', '$2y$10$b1Eeiojia0FRI5aSC05Kou4we02VMj5TzKXPBF9VKoVvn9DrTHgWe', 'rosinei.figueiredo', 'default');

-- Tabela de Funcionários
CREATE TABLE Funcionarios (
    registro INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    cargo VARCHAR(255),
    cpf VARCHAR(14) UNIQUE,
    telefone VARCHAR(20),
    email VARCHAR(255) UNIQUE
);

-- Tabela de Fornecedores
CREATE TABLE Fornecedores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    razao_social VARCHAR(255) NOT NULL,
    cnpj VARCHAR(18) UNIQUE,
    logradouro VARCHAR(255),
    num VARCHAR(20),
    bairro VARCHAR(255),
    cidade VARCHAR(255),
    complemento VARCHAR(255),
    UF VARCHAR(2),
    cep VARCHAR(9),
    codigoMunicipio VARCHAR(7), -- Código do IBGE
);

-- Tabela de Produtos
CREATE TABLE Produtos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descr VARCHAR(255),
    precoCusto DECIMAL(10, 2),
    nomeImg VARCHAR(255)
);

-- Tabela de Compras
CREATE TABLE Compras (
    idCompra INT PRIMARY KEY AUTO_INCREMENT,
    funcionario INT,
    fornecedor INT,
    dtCompra DATE,
    valorFinal DECIMAL(15, 2),
    FOREIGN KEY (funcionario) REFERENCES Funcionarios(Registro),
    FOREIGN KEY (fornecedor) REFERENCES Fornecedores(id)
);

-- Tabela de Itens da Compra
CREATE TABLE ItensCompra (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idCompra INT,
    idProduto INT,
    qtd INT,
    valorUnitario DECIMAL(10, 2),
    valorTotal DECIMAL(15, 2),
    FOREIGN KEY (idCompra) REFERENCES Compras(idCompra),
    FOREIGN KEY (idProduto) REFERENCES Produtos(id)
);

-- Tabela de Gastos
CREATE TABLE Gastos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descr VARCHAR(255),
    dt_gasto DATE,
    valor_gasto DECIMAL(15, 2)
);

-- Índices para otimizar consultas (importante para performance)
CREATE INDEX idx_nome_funcionario ON Funcionarios(nome);
CREATE INDEX idx_razao_social_fornecedor ON Fornecedores(razao_social);
CREATE INDEX idx_descr_produto ON Produtos(descr);
CREATE INDEX idx_dtCompra ON Compras(dtCompra);
CREATE INDEX idx_dt_gasto ON Gastos(dt_gasto);
CREATE INDEX idx_idCompra_itens ON ItensCompra(idCompra);
CREATE INDEX idx_idProduto_itens ON ItensCompra(idProduto);

-- Exemplo de inserção de dados
INSERT INTO Funcionarios (nome, cargo, cpf, telefone, email) VALUES ('João da Silva', 'Gerente', '123.456.789-00', '(11) 99999-9999', 'joao@email.com');
INSERT INTO Fornecedores (razao_social, cnpj) VALUES ('Fornecedor ABC Ltda.', '12.345.678/0001-90');
INSERT INTO Produtos (descr, precoCusto) VALUES ('Produto X', 10.50);
INSERT INTO Compras (funcionario, fornecedor, dtCompra, valorFinal) VALUES (1, 1, '2024-10-27', 150.00);
INSERT INTO ItensCompra (idCompra, idProduto, qtd, valorUnitario, valorTotal) VALUES (1, 1, 2, 75.00, 150.00);
INSERT INTO Gastos(descr, dt_gasto, valor_gasto) VALUES ('Aluguel', '2024-10-15', 1200.00);



