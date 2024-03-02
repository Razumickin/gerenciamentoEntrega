# Gerenciamento de Entrega

## Ferramentas
1. PHP 8 com framework Laravel para o desenvolvimento da API.
2. React para o desenvolvimento da SPA.
3. Bootstrap e Fontawesome para estilização.

## Fontes, exemplos e inspirações
1. Inspirado em https://www.youtube.com/watch?v=qJq9ZMB2Was&t=6539s
2. Documentação React https://react.dev/learn
3. Documentação Laravel https://laravel.com/docs/10.x

## Instruções para instalação local

### Instalar API
1. Criar um banco de dados MySql chamado "gerenciamentoentregas"
2. Configurar no .env as credenciais para o banco local
3. No diretorio ..\gerenciamentoEntrega\core-api\ executar o comando "composer install" para instalação das dependências.
4. No diretorio ..\gerenciamentoEntrega\core-api\ executar o comando "php artisan migrate:fresh" para aplicar migrações no banco.
5. No diretorio ..\gerenciamentoEntrega\core-api\ executar o comando "php artisan serve" para criar uma instância da API.
6. Por padrão a API estará rodando em http://localhost:8000

### Instalar SPA
1. Finalizar a instalação da API.
2. No diretorio ..\gerenciamentoEntrega\app\ executar o comando "npm install" para instalação das dependências.
3. No diretorio ..\gerenciamentoEntrega\app\ executar o comando "npm run dev"  para criar uma instância da SPA.
4. Por padrão a API estará rodando em http://localhost:3000
