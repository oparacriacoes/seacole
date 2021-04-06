<p align="center"><a href="https://laravel.com" target="_blank">SEACOLE</a></p>

## Sobre SEACOLE

Descrição do Projeto

Nesse projeto são utilizadas tecnologias como:

- [Laravel](https://laravel.com/)
- [Laravel Sail](https://laravel.com/docs/master/sail): como infraestrutura de desenvolvimento para a aplicação.

## Inicilizando o ambiente de desenvolvimento
Como se trata de um projeto que pode ser mantido por diversas pessoas, mas será um projeto de longo prazo, são necessárias algumas tecnologias para o desenvolvimento além de um padrão para o projeto, permitindo manter a estrutura igual para qualquer desenvolvedor. Para facilitar esse processo os principais comandos estão abstraidos no arquivo Makefile.

### Tecnologias
- PHP 7.4
- Docker

Todo resto como banco e cache fica a par do Sail

#### Sistema Operacional
O que você usa no dia-a-dia. A única dica é que no caso do windows utilze o WSL2, pois o Docker funciona melhor sem muitas surpresas, do que o Docker for Windows

#### Docker
Para instalação no seu sistema operacional, siga o tutorial em https://docs.docker.com/engine/install/. Para ambientes Windows é recomendado o uso do WSL2 que permite ter um ambiente completo e melhor compatibilidade com o docker.

#### PHP
A inicialização do projeto já possui uma versão definitiva do PHP a ser usado dentro da configurações dos containers que será a 7.4

#### Editor de texto
O editor de texto pode ser a escolha do desenvolvedor. Uma dica seria o uso do Visual Studio Code com o plugin [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client), pois o mesmo já possui uma excelente compatibilidade com o Framework Laravel

### Iniciando o core do projeto

1) clone o projeto do repositório https://github.com/oparacriacoes/seacole
```bash
git clone https://github.com/oparacriacoes/seacole.git cd seacole
```
2) copie o arquivo .env.example com o nome .env
```bash
cp .env.example .env
```
2) gere a chave do projeto atraves do comando
```bash
php artisan key:generate
```
ou
```bash
sail artisan key:generate
```
2) instalar o composer para instalação das dependencias
```bash
make install-composer
```
3) instalando as dependências do projeto
```bash
make install-dependencies
```
4) para iniciar os containers com a aplicação
```bash
make run-dev
```
Para parar a aplicação
```bash
make stop-dev
```
5) instalar e iniciar os assets de front-end
```bash
make run-assets
```
6) iniciar as migrations para criar o banco de dados e adiciona as informações iniciais
```bash
make migrate-seed
```
Caso queira apenas criar as tabelas sem nenhum processo para popular o banco de dados
```bash
make migrate
```

### Verificando o projeto

Após realizar os passos acima você pode verificar se o projeto está corretamente funcionando acessando os links abaixo

* [Link do Seacole](http://localhost:80)
* [MailHog](http://localhost:8025)

O MailHog funciona como uma caixa de email local, que recebe todos os email enviados durante o processo de desenvolvimento

### Outros comandos
