# Migrations

## Conhecendo as migrations

Uma tarefa muito comum no dia a dia de programadores é ter que lidar com banco de dados, criar tabela, e preenchê-las. Para isto o ScoobyPHP utiliza a biblioteca **Phinx** para facilitar o dia a dia do desenvolvedor.

Veja como é fácil criar uma migration usando o **scooby-do**, ferramenta para geração de código automaticamente via linha de comando, o scooby-do será abordado em breve.
Para criarmos uma migration basta abrirmos o terminal e navegarmos ate a raiz do nosso projeto, vamos supor que estamos desenvolvendo no linux usando um servidor Xampp, para acessarmos a raiz do projeto basta abrir o terminal e digitarmos.

```shell
cd /opt/lampp/htdocs/pasta_do_projeto/
```

Após isto, digitamos no terminal:

```shell
php scooby-do
```

Ao abrir a tela do scooby-do, digitamos:

```shell
make:migration
```

Após isto sera pedido o nome da migration, esse nome, por padrão, precisa ser escrito no formato CamelCase, ficando assim **MinhaPrimeiraMigration**, note que a primeira letra de cada palavra esta escrita em maiúsculo.
Ao executar este comando um novo arquivo será criado em **App/Db/Migrations/** com um nome escolhido para a migration, dentro deste arquivo podemos encontrar o seguinte conteúdo:

```php
<?php

use Phinx\Migration\AbstractMigration;

class MinhaPrimeiraMigrationCreateTable extends AbstractMigration
{
    /*
     *
     * @return void
     */
    public function change(): void
    {
        $this->Table('table_name')

        // Adicione colunas à tabela com o método addColum, passando p nome da coluna
        // o tipo do dado e um array com opções como no exemplo abaixo:
        // ->addColum('name', 'string', ['null' => false])

        ->create();
    }
}
```

Para termos nossa migration totalmente funcional basta preenchermos com algumas informações, como, por exemplo, o nome da tabela que queremos criar, os campos desta tabela, seus tipos e etc...

Veja neste exemplo, onde iremos criar uma migration da tabela de usuários.

```php
<?php

use Phinx\Migration\AbstractMigration;

class MinhaPrimeiraMigrationCreateTable extends AbstractMigration
{
    /*
     *
     * @return void
     */
    public function change(): void
    {
    $this->Table('users')
    ->addColumn('name', 'string', ['null' => false])
    ->addColumn('email', 'string', ['null' => false])
    ->addColumn('password', 'string', ['null' => false])
    ->create();
    }
}

```

Neste exemplo passamos primeiramente o nome da tabela a ser criada, apos isto passamos seus campos com os nomes, tipos e um array com as regras, neste caso, **['null' =&gt; false]** e por ultimo chamamos o método **create()**, note que não informamos o **id**, pois o phinx cria um campo com o nome id do tipo primary key automaticamente

Os metodos disponíveis para a criação de migrations são:

 **createTable()**

 **renameTable()**

 **addColumn()**

 **renameColumn()**

 **addIndex()**

 **addForeignKey()**

Já os tipos de dados aceitos são:

**biginteger**

**binary**

**boolean**

**date**

**datetime**

**decimal**

**float**

**double**

**integer**

**smallinteger**

**string**

**text**

**time**

**timestamp**

**uuid**

Configurações aceitas:

**limit** - definir comprimento máximo para as strings

**length** - Apelido para o limite

**default** - definir valor ou ação padrão

**nulo** - permitir valores NULL, padrões como false (não deve ser usado com chaves primárias!) 

**after** - especificar a coluna que uma nova coluna deve ser colocada depois (só se aplica ao MySQL)

**comment** - definir um comentário de texto na coluna

Agora, basta voltarmos ao terminal, digitarmos novamente

```shell
php scooby-do
```

E ao scooby-do abrir, digitamos

```shell
migrate
```

Esse comando irá executar todas as migrationsque ainda não foram executadas na aplicação. Após executar as migrations você tera uma tabela com o nome de **users** criada no banco de dados

