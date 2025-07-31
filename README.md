-----

# ☕ Cafeteria Ponto e Vírgula

Um sistema de gestão feito de DEV para DEV, focado no que realmente importa para um negócio iniciante: **o controle financeiro e o crescimento sustentável**. Este projeto nasceu da ideia de criar uma ferramenta simples, direta e poderosa para pequenas cafeterias (especialmente aquelas com um público gamer/dev) gerenciarem seus custos e tomarem decisões estratégicas.

A proposta é oferecer uma visão clara sobre despesas, compras e estoque, ajudando a ajustar preços, planejar salários e cortar gastos desnecessários, tudo isso sem a complexidade de um ERP gigante.

## ✨ Funcionalidades Atuais (Versão 0.1.0 - 09/02/2025)

  * **💰 Controle Financeiro:**

      * Relatório detalhado de gastos e compras do último mês.
      * CRUD completo para registrar e gerenciar despesas fixas (aluguel, internet, salários).

  * **👥 Gestão de Pessoas e Parceiros:**

      * CRUD completo de Fornecedores.
      * CRUD completo de Funcionários.

  * **📦 Gestão de Produtos e Estoque:**

      * CRUD completo de Produtos.
      * Funcionalidade de "Destaque", permitindo selecionar produtos para serem exibidos na página inicial, criando uma vitrine digital.
      * Controle para remover produtos da vitrine ou deletá-los permanentemente do banco de dados.

  * **🔑 Sistema de Autenticação:**

      * Um sistema de login básico para proteger as áreas administrativas.

## ⚙️ Stack Tecnológica (De Volta às Raízes\!)

Este projeto foi construído intencionalmente com uma stack "vanilla" para focar nos fundamentos da programação web e na lógica de negócios, sem a abstração de frameworks pesados.

<p align="left">
  	<a href="#"><img alt="HTML5" src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white"></a>
  	<a href="#"><img alt="CSS3" src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white"></a>
   <a href="#"><img alt="MySQL" src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white"></a>
	  <a href="#"><img alt="PHP" src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"></a>
		 <a href="#"><img alt="JavaScript" src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black"></a>
</p>


---
 
</p>

## 📂 Estrutura do Projeto

A organização dos diretórios foi pensada para separar as responsabilidades de forma clara dentro de uma arquitetura PHP procedural.

```
/
├── js/             # Scripts de interação (AJAX, manipulação de DOM)
├── midia/          # Imagens, ícones e outros recursos visuais
├── pages/          # O coração da aplicação
│   ├── include/    # Lógica de backend (conexão com BD, funções, sessões)
│   └── *.html       # Arquivos de frontend (as páginas visíveis)
├── script-sql/     # Scripts de criação e modelagem do banco de dados
└── style/          # Folhas de estilo (CSS)
```

## 🚀 Como Executar o Projeto Localmente

1.  **Clone o repositório:**

    ```bash
    git clone https://github.com/seu-usuario/seu-repositorio.git
    cd seu-repositorio
    ```

2.  **Configure o Banco de Dados:**

      * Crie um novo banco de dados no seu MySQL.
      * Importe o arquivo `.sql` que está na pasta `script-sql/` para criar as tabelas e a estrutura inicial.

3.  **Configure a Conexão:**

      * Dentro da pasta `pages/include/`, localize o arquivo de conexão com o banco de dados (ex: `conexao.php` ou `config.php`).
      * Altere as credenciais (`host`, `usuário`, `senha`, `nome do banco`) para as suas credenciais locais.

4.  **Inicie o Servidor:**

      * Use o servidor embutido do PHP para uma experiência rápida. Execute este comando na raiz do projeto:

    <!-- end list -->

    ```bash
    php -S localhost:8000
    ```

5.  **Acesse a aplicação** no seu navegador em `http://localhost:8000/pages/login.php` (ou a sua página de login).

## 🗺️ Roadmap Futuro

Este projeto está em constante evolução. Os próximos passos planejados são:

  - [ ] **Módulo de Ponto de Venda (PDV):** Implementar uma interface de caixa para registrar vendas em tempo real.
  - [ ] **Atualização de Estoque Automática:** Integrar o módulo de vendas e compras para que o estoque seja atualizado dinamicamente.
  - [ ] **Dashboard de Métricas:** Criar um painel visual com gráficos sobre vendas, produtos mais vendidos e faturamento.
  - [ ] **Aplicativo Web para Clientes:** Desenvolver uma interface para que os clientes possam ver o cardápio e, eventualmente, fazer pedidos online.
  - [ ] **Refatoração para Arquitetura MVC:** Migrar a estrutura atual para um padrão Model-View-Controller para melhor organização e escalabilidade.
