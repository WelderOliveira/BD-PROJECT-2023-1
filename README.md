<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Infos

- O modelos Relacionais e Modelo Entidade Relacionamento estão alocados na pasta
  1. [x] **relatorio**
- Os scripts SQL com a criação estruturada do banco de dados estão divididos em 2 arquivos
  - Criação da **Estrutura** da Base de Dados:
    1. [x] database/files/bd_struct_2023_1.sql
  - Criação da Base de Dados com **população das tabelas**
    1. [x] database/files/bd_project_2023_1.sql
- Cadama de persistencia e scripts de utilização no código estão no caminho
  - **app/Models**
- Camada de Visualização com arquivos html estão no caminho
  - **resources/views**
- Camada de Controladores com arquivos de regras lógicas e manipulações estão no caminho
  - **app/Http/Controllers**

---
- Utilize esse acesso como exemplo de Admin.
  ```sh
  - Admin
    Email: admin@admin.com
    Senha: admin 
    ```
---
- Obs: Não é necessário que importe os arquivos SQL, com os comandos de instalação da aplicação já irá criar automaticamente a estrutura no banco de dados, desde que você realize a configurações corretas da conexão ao SGBD.

## Dependências

- PHP >= 8.1
- Laravel Framework >= 10.0
- MySQL >= 5.7
- Composer >= 2.5.4
- node = v16.16.0

## Passo-a-passo - Instalação

1. Em sua pasta raiz, clone o arquivo do projeto usando **git clone** https://github.com/WelderOliveira/BD-PROJECT-2023-1.git
2. Abra o terminal (bash / cmd). Em seguida, vá para a pasta do projeto usando o comando

```sh
cd BD-Project-2023-1
```

3. Em seguida, instale os arquivos e bibliotecas necessários usando

```sh
composer install
```

4. Em seguida, crie um arquivo `.env` e gere a chave para este projeto usando o comando

```sh
cp .env.example .env
php artisan key:generate
```

5. Em seguida, compile todos os arquivos CSS e JS usando este comando

```sh
npm install && npm run dev
```

ou

```sh
yarn install && yarn run dev
```
6. Crie um banco de dados em MYSQL e conecte-o ao seu projeto por meio do arquivo `.env`.

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=NAMEDB
DB_USERNAME=USERDB
DB_PASSWORD=PASSDB
```

8. Após conectar o banco de dados com o projeto, execute o comando

```sh
php artisan migrate
```

Finalmente, estamos prontos para executar este projeto, utilize este comando

```sh
php artisan serve
```

### Acesse através do IP apresentado no prompt.
