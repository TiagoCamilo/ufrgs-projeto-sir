## Sobre o projeto
* **O que ele faz?**  Permite a educadores, através de um sistema WEB, a gestão de atividades de alunos com necessidades especiais educacionais em salas de integração de recursos.
* **Como ele faz?** Através da linguagem PHP com o framework Symfony e arquitetura MVC
* **Quem utilizará esse projeto?**  Qualquer escola que tenha interesse
* **Qual objetivo desse projeto?** Permitir aos educadores organizar seus registros de atendimentos, permitindo uma visualização do avanço de seus alunos.

## Requisitos
* PHP 7.3
* * Composer
* PostgreSQL 10
* Git

## Procedimento
1. Clonar o projeto:
	`git clone https://bitbucket.org/camilo_tiago/sala_recursos.git`

2. Acessar diretório:
	`cd sala_recursos`

3. Checkout para branch desejada:
	`git checkout develop`

4. Instalar dependências do projeto:
	 `composer install`

5. Configurar credenciais do banco de dados:
	 `vi .env`
	 Alterar linha `DATABASE_URL=pgsql://postgres:postgres@127.0.0.1:5432/sala_recursos`

6. Criar base de dados:
	`./bin/console doctrine:database:create`

7. Estruturar/popular base de dados com "Migrations":
	`./bin/console doctrine:migrations:migrate`

8. Popular registros auxiliar com "Fixtures":
	`./bin/console doctrine:fixtures:load --append`
	
## Imagens

![Alt text](images/perfil.png?raw=true "Perfil do Aluno")
![Alt text](images/home.png?raw=true "Home")
![Alt text](images/add_parecer.png?raw=true "Adicionar Parecer")

