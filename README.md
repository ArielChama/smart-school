<h1 align="center"> Smart </h1>

<p align="justify"> Um sistema web de gestão escolar que serviu como meu TCC.</p>

## Configurando o ambiente

### Criando o banco de dados e o usuário

> CREATE DATABASE smart_school;

> CREATE USER smart_school_user@'%' IDENTIFIED BY 'BEh3pY9q3C6pZPA';

> GRANT ALL TO e_commerce.* TO e_commerce_user@'%';

### Instalando dependências e configurando

> git clone https://github.com/ArielChama/e-commerce

> cd e-commerce

<p align="justify"> Instalando dependências do php: </p>

> composer install

<p align="justify"> Instalando os modulos do Node e rodando o laravel mix: </p>

> npm install && npm run dev

<p align="justify"> Configurando arquivo env: </p>

> cp .env.example .env

<p align="justify"> Gerando nova chave: </p>

> php artisan key:generate

<p align="justify"> Executando as migrações: </p>

> php artisan migrate

### Rodando a aplicação :arrow_forward:

> php artisan serve :signal_strength:

<p align="justify">Abra seu navegador e acesse: </p>

> localhost:8000/

### Administraçao

<p align="justify">Rode o seed User para criar um usuário admin.</p>

> ...