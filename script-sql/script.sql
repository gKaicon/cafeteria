drop database if exists trabalho;
create database if not exists trabalho;
use trabalho;
create table users
(
    id          integer auto_increment primary key,
    email       varchar(255),
    pwd         varchar(255),
    username    varchar(255),
    tipoUsuario varchar(20)
);

insert into users (email, pwd, username, tipoUsuario)
values ('administrador@gmail.com', '$2y$10$v.FksP6V7pkzhCK04xVAJuFhMVQl0e8Ijh2YSZAOFrk0.4cQl9m5u', 'admin', 'admin');
insert into users (email, pwd, username, tipoUsuario)
values ('kaicon@gmail.com', '$2y$10$bFmRFyzBw22Ji1TTULdpYecZZffbGmxyp/BDnRzTzHcUUn6A/RUpy', 'kaicon', 'default');
insert into users (email, pwd, username, tipoUsuario)
values ('rosinei.figueiredo@ifmg.edu.br', '$2y$10$b1Eeiojia0FRI5aSC05Kou4we02VMj5TzKXPBF9VKoVvn9DrTHgWe',
        'rosinei.figueiredo', 'default');

-- Tabela de Funcionários
CREATE TABLE Funcionarios
(
    registro INT PRIMARY KEY AUTO_INCREMENT,
    nome     VARCHAR(255) NOT NULL,
    cargo    VARCHAR(255),
    cpf      VARCHAR(14) UNIQUE,
    telefone VARCHAR(20),
    email    VARCHAR(255) UNIQUE
);

-- Tabela de Fornecedores
CREATE TABLE Fornecedores
(
    id              INT PRIMARY KEY AUTO_INCREMENT,
    razao_social    VARCHAR(255) NOT NULL,
    cnpj            VARCHAR(18) UNIQUE,
    telefone        VARCHAR(255),
    email           VARCHAR(255),
    logradouro      VARCHAR(255),
    num             VARCHAR(20),
    bairro          VARCHAR(255),
    cidade          VARCHAR(255),
    complemento     VARCHAR(255),
    UF              VARCHAR(2),
    cep             VARCHAR(9),
    codigoMunicipio VARCHAR(7),
    dt_delete date
);


-- Tabela de Produtos
CREATE TABLE Produtos
(
    id         INT PRIMARY KEY AUTO_INCREMENT,
    nome       varchar(255),
    descr      VARCHAR(255),
    precoCusto DECIMAL(10, 2),
    precoVenda DECIMAL(10, 2),
    listavel   enum ('0','1'),
    nomeImg    VARCHAR(255),
    idFornecedor INT,
    FOREIGN KEY (idfornecedor) REFERENCES Fornecedores (id)
);

-- Tabela de Compras
CREATE TABLE Compras
(
    idCompra    INT PRIMARY KEY AUTO_INCREMENT,
    idfuncionario INT,
    idfornecedor  INT,
    dtCompra    DATE,
    valorFinal  DECIMAL(15, 2),
    FOREIGN KEY (idfuncionario) REFERENCES Funcionarios (Registro),
    FOREIGN KEY (idfornecedor) REFERENCES Fornecedores (id)
);

-- Tabela de Itens da Compra
CREATE TABLE ItensCompra
(
    id            INT PRIMARY KEY AUTO_INCREMENT,
    idCompra      INT,
    idProduto     INT,
    qtd           INT,
    valorUnitario DECIMAL(10, 2),
    valorTotal    DECIMAL(15, 2),
    FOREIGN KEY (idCompra) REFERENCES Compras (idCompra),
    FOREIGN KEY (idProduto) REFERENCES Produtos (id)
);

-- Tabela de Gastos
CREATE TABLE Gastos
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    descr       VARCHAR(255),
    dt_gasto    DATE,
    valor_gasto DECIMAL(15, 2)
);

-- Índices para otimizar consultas (importante para performance)
CREATE INDEX idx_nome_funcionario ON Funcionarios (nome);
CREATE INDEX idx_razao_social_fornecedor ON Fornecedores (razao_social);
CREATE INDEX idx_descr_produto ON Produtos (descr);
CREATE INDEX idx_dtCompra ON Compras (dtCompra);
CREATE INDEX idx_dt_gasto ON Gastos (dt_gasto);
CREATE INDEX idx_idCompra_itens ON ItensCompra (idCompra);
CREATE INDEX idx_idProduto_itens ON ItensCompra (idProduto);

-- Exemplo de inserção de dados
INSERT INTO Funcionarios (nome, cargo, cpf, telefone, email)
VALUES ('João da Silva', 'Gerente', '123.456.789-00', '(11) 99999-9999', 'joao@email.com');
INSERT INTO Fornecedores (razao_social, cnpj)
VALUES ('Fornecedor ABC Ltda.', '12.345.678/0001-90');
INSERT INTO Produtos (nome, descr, precoVenda, nomeImg)
VALUES ('Java Jive', 'Um clássico robusto com um toque de doçura, perfeito para começar o dia com energia.', 12.00,
        'java.jpeg'),
       ('Python Punch', 'Uma mistura suave e elegante, ideal para quem busca um café refrescante.', 10.00,
        'python.jpeg'),
       ('Debugging Delight', 'Um café forte e intenso para te ajudar a resolver qualquer problema.', 15.00,
        'debug.jpeg'),
       ('Docker Double', 'Um café duplo e cremoso, perfeito para quem precisa de um boost de energia.', 14.00,
        'docker.jpeg'),
       ('Syntax Error Smoothie',
        'Um smoothie refrescante com frutas vermelhas e um toque de chocolate, para adoçar os seus dias de código.',
        10.00, 'syntax.jpeg'),
       ('JavaScript Jolt',
        'Um café vibrante e dinâmico, para te dar a energia que você precisa para criar sites interativos.', 13.00,
        'js.jpeg'),
       ('CSS Cascade', 'Um café equilibrado e harmonioso, para deixar seu dia mais estiloso.', 11.00, 'css.jpeg'),
       ('HTML Hustle', 'Um café clássico e fundamental, para construir a base de seus projetos.', 12.00, 'html.jpeg'),
       ('Database Double Shot', 'Um café forte e concentrado, para te ajudar a armazenar todas as suas ideias.', 14.00,
        'database.jpeg'),
       ('Algorithm Americano', 'Um café suave e refrescante, perfeito para pensar em soluções criativas.', 10.00,
        'algorithm.jpeg'),
       ('Framework Frappe',
        'Um café cremoso e saboroso, para te ajudar a construir seus projetos de forma rápida e eficiente.', 13.00,
        'framework.jpeg'),
       ('Cloud Cappuccino',
        'Um cappuccino leve e aerado, para te conectar com a nuvem e suas infinitas possibilidades.', 12.00,
        'cloud.jpeg'),
       ('Open Source Oat Milk Latte',
        'Um latte vegano e cremoso, para quem busca opções mais saudáveis e sustentáveis.', 11.00, 'open_source.webp'),
       ('AI Americano', 'Um café forte e estimulante, para te inspirar a criar inteligências artificiais incríveis.',
        15.00, 'IA.jpeg');

update Produtos
set listavel = '1'
where Produtos.precoVenda < 1000;

update Produtos
set precoCusto = precoVenda / 1.25
where Produtos.precoVenda < 15555555;

INSERT INTO Compras (idfuncionario, idfornecedor, dtCompra, valorFinal)
VALUES (1, 1, '2024-10-27', 150.00);
INSERT INTO ItensCompra (idCompra, idProduto, qtd, valorUnitario, valorTotal)
VALUES (1, 1, 2, 75.00, 150.00);
INSERT INTO Gastos(descr, dt_gasto, valor_gasto)
VALUES ('Aluguel', '2025-01-15', 1200.00);
INSERT INTO Gastos(descr, dt_gasto, valor_gasto)
VALUES ('Agua', '2025-01-21', 600.00);
INSERT INTO Gastos(descr, dt_gasto, valor_gasto)
VALUES ('Luz', '2025-01-22', 789.80);
INSERT INTO Compras (idfuncionario, idfornecedor, dtCompra, valorFinal)
VALUES (1, 1, '2025-01-15', 150.00);
INSERT INTO Compras (idfuncionario, idfornecedor, dtCompra, valorFinal)
VALUES (1, 1, '2025-01-16', 250.00);
INSERT INTO Compras (idfuncionario, idfornecedor, dtCompra, valorFinal)
VALUES (1, 1, '2025-01-31', 150.00);


select * from produtos order by id desc