# Controllers

## Desvendadndo os Controllers

Ao se trabalhar com o padrão MVC grande parte do projeto será desenvolvido nos controllers, neste tópico iremos criar nosso primeiro controller, descobrir como chamar uma view, como instanciar um model, como utilizar alguns dos helpers do ScoobyPHP e muito mais...

### Criando um controller

para criarmos um controller, basta irmos ate a pasta Controllers, que se encontra em App/Controllers/, lá criaremos um novo arquivo com o nome desejado, com a primeira letra maiúscula e acompanhado da palavra Controller e finalizando com .php, ficando deste jeito por exemplo: HomeController.php.

Ao abrir o Controller recém criado basta adicionar o código abaixo:

```php

namespace Scooby\Controllers;

use Scooby\Core\Controller;

class HomeController extends Controller
{
    /**
    * @return void
    */
    public function index(): void
    {
        //
    }
}
```

Pronto, com algumas linhas de código já temos um controller criado e pronto para o uso. Uma rotina muito comum de se fazer nos controllers é o ato de chamar uma view, seja ela um formulário, uma tela de login ou qualquer outra tela existente na aplicação e para exibirmos uma view no navegador do usuário é muito simples, por estarmos estendendo o controller base do Scooby, temos acesso aos seus métodos e um deles é o metodo view, que é responsável por exibir uma view para o usuário final do app.

Para chamar uma view no navegador do usuário, levando em consideração que a view já foi previamente criada na pasta App/Views/Pages/, basta escrever o seguinte código dentro do método desejado. Exemplo de um controller chamando uma view na action index.

```php

namespace Scooby\Controllers;

use Scooby\Core\Controller;

class HomeController extends Controller
{
    /**
    * Metodo index está chamando uma view na pasta Pages com o nome Home.twig
    *
    * @return void
    */
    public function index(): void
    {
        $this->view('Pages', 'Home', []);
    }
}
```

Note que o método view mapeia a chamada para dentro da pasta App/Views, sendo necessário somente informar a pasta em que você deseja chamar o arquivo de visualização. Note também que o método view recebe como terceiro parâmetro um array, que no caso do exemplo está vazio, porém neste array mandamos informações para a view, podendo ser strings, retornos de métodos, ou qualquer coisa que desejarmos.

Exemplo de envio de um texto de boa vindas do metodo index para a view home.

```php

namespace Scooby\Controllers;

use Scooby\Core\Controller;

class HomeController extends Controller
{
    /**
    * Envio de msg de boas vindas para a view home.twig que se encontra em: App/Views/pages/
    *
    * @return void
    */
    public function index(): void
    {
        $this->view('Pages', 'Home', [
            'wellcomeMessage' => 'Sejam Bem Vindos ao SccobyPHP!!!'
        ]);
    }
}
```

Para passarmos o valor para a view usamos um array associativo, onde a chave do array, que no nosso exemplo é ' wellcomeMessage ', será a variável que acessaremos na view, neste momento não precisa se preocupar e caso não tenha entendido como será feita esta tarefa, quando entrarmos no estudo de views todas as dúvidas serão sanadas.

Podemos também setar um titulo para a view a ser apresentada, para isto basta usarmos o metodo

```php
$this->setTitle('Titulo da página');
```

Neste caso o controller ficaria assim:

```php

namespace Scooby\Controllers;

use Scooby\Core\Controller;

class HomeController extends Controller
{
    /**
    * Adiciona o titulo Hello World para a view wellcome
    *
    * @return void
    */
    public function index(): void
    {
        $this->setTitle('Hello world');
        $this->view('Pages', 'Home', [
            'wellcomeMessage' => 'Sejam Bem Vindos ao SccobyPHP!!!'
        ]);
    }
}
```

Caso nenhum titulo seja informado no controller, o APP_NAME será o titulo de todas as páginas do projeto, neste caso como o APP_NAME esta definodo para ScoobyPHP, todas as páginas herdarão este titulo.

Caso precisemos recuperar parametros enviados pelas **rotas** da nossa aplicação, basta adicionar uma variável na chamada da **action** e passar essa variável no formato de um array com a chave contendo o nome dado ao elemento a ser recuperado.
Vamos supor que uma rota envia um nome e desejamos recuperar este nome no HomeController


O arquivo de rota ficaria assim:
```php
$route->get('/{name}', 'HomeController@index');
```

Eo controller ficaria:

```php

namespace Scooby\Controllers;

use Scooby\Core\Controller;

class HomeController extends Controller
{
    /**
    * Adiciona o titulo Hello World para a view wellcome
    *
    * @return void
    */
    public function index($param): void
    {

        $name = $param['name'];

        $this->setTitle('Hello world');
        $this->view('Pages', 'Home', [
            'nome' => $name
        ]);
    }
}
```

Muitas vezes em que estamos escrevendo uma aplicação, principalmente quando estamos criando uma **API**, precisamos retornar não uma **view**, mas sim um **Json**, para retornar um jason no ScoobyPHP basta chamar $this->Json() e passar um array com os dados a ser retornado

```php

namespace Scooby\Controllers;

use Scooby\Core\Controller;

class HomeController extends Controller
{
    /**
    * Retorna um json
    *
    * @return void
    */
    public function index(): void
    {
        $this->Json(['data' => 'Dado a ser retornado']);
    }
}
```

Outra coisa muito comum é trabalharmos com dados vindos do banco de dados, por usarmos o Eloquente como ORM no ScoobyPHP, temos uma facilidade muito grande ao lidarmos com os Models.

Veja agora um exemplo de consulta em uma tabela de usuarios.
OBS: Na sessão de Models será melhor explicado como se tarbalhar corretamente com o Eloquent e com o models dentro do ScoobyPHP.

```php

namespace Scooby\Controllers;

use Scooby\Core\Controller;
use Scooby\Models\User;

class HomeController extends Controller
{
    /**
    * Retorna um json
    *
    * @return void
    */
    public function index(): void
    {
        $user = new User;
        $u = $user->find(1);
        $this->Json(['user' => $u->name']);
    }
}
```

Veja como é simples trabalhar com controllers no ScoobyPHP. Mais para a frente aprenderemos a usar o ***scooby-do***, o CLI integrado no Scooby.