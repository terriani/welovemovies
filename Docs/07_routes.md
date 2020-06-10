# Rotas

## Desvendando as rotas

Os arquivos de rota do ScoobyPHP encontra-se no diretório **App/Routes/**, note que dentro da pasta Routes encontramos dois arqiovos, o **api.php** e o **web.php**, o uso destes arquivos não é obrigatório, o programador pode criar seus próprios arquivos de rota para uma melhor organização do código da aplicação. Nesta sessão será explicado a criação de rotas utilizando os arquivos padrões que já vem por padrão na pasta Routes, porém fica a critério do desenvolvedor utilizar os conhecimentos adquiridos neste guia em qualquer outro arquivo de rotas por ele criado.

### Criando nossa primeira rota

Para definirmos uma rota tanto no arquivo web.php, api.php como em qualquer outro arquivo dentro da pasta Routes é  muito simples, basta utilizar uma variável chamada **$route->tipo_da_rota('/caminho_da_rota', 'Controller@action');**, este exemplo de rota ficaria da seguinte maneira

```php
$route->get('/home', 'HomeController@index');
```

Para passarmos parâmetros pela rota, basta adicionarmos o nome do parâmetro entre {}, vamos supor que precisamos passar um id e um nome de usuário pela rota que criamos acima:

```php
$route->get('/home/{id}/{name}', 'HomeController@index');
```

e lá no HomeController, na action index, recuperamos este valor da seguinte maneira:

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

        $id = $param['id'];
        $name = $param['name'];

    }
}
```

Vale ressaltar que posemos passar parâmetros para os controllers via rotas ilimitadamente.

À também uma outra forma de criarmos nossas rotas, podemos utilizar **clojures**, ficando da seguinte, maneira:

```php
$route->get('/home', function () {
    // Ao acessar a rota /home o que estiver aqui dentro será executado
});
```

Podemos também passar parâmetros para essas rotas, da seguinte maneira:

```php
$route->get('/home/{id}', function ($param) {
    echo "o id vindo da rota é - ". $param['id'];
});
```

## Tipos de Rotas do ScoobyPHP

no ScoobyPHP podemos trabalhar com rotas dos tipos:

### GET

As rotas do tipo **get** recebem o caminho que sera digitado pelo usuário no navegador e o controller ou a clojure que esse caminho irá apontar
A criação de uma rota do tipo get é feita da seguinte maneira:

```php
$route->get('/caminho_da_rota', 'Controller@action');
```

ou em forma de clojure

```php
$route->get('/home', function () {
    // Ao acessar a rota /home o que estiver aqui dentro será executado
});
```

### POST

As rotas do tipo **post** recebem o caminho que sera digitado pelo usuário no navegador e o controller ou a clojure que esse caminho irá apontar
A criação de uma rota do tipo post é feita da seguinte maneira:

```php
$route->post('/caminho_da_rota', 'Controller@action');
```

ou em forma  de clojure

```php
$route->post('/home', function () {
    // Ao acessar a rota /home o que estiver aqui dentro será executado
});
```

### PUT

As rotas do tipo **put** recebem o caminho que sera digitado pelo usuário no navegador e o controller ou a clojure que esse caminho irá apontar
A criação de uma rota do tipo put é feita da seguinte maneira:

```php
$route->put('/caminho_da_rota', 'Controller@action');
```

ou em forma de clojure

```php
$route->put('/home', function () {
    // Ao acessar a rota /home o que estiver aqui dentro será executado
});
```

### DELETE

As rotas do tipo **delete** recebem o caminho que sera digitado pelo usuário no navegador e o controller ou a clojure que esse caminho irá apontar
A criação de uma rota do tipo delete é feita da seguinte maneira:

```php
$route->delete('/caminho_da_rota', 'Controller@action');
```

ou em forma de clojure

```php
$route->delete('/home', function () {
    // Ao acessar a rota /home o que estiver aqui dentro será executado
});
```

### PATH

As rotas do tipo **path** recebem o caminho que sera digitado pelo usuário no navegador e o controller ou a clojure que esse caminho irá apontar
A criação de uma rota do tipo path é feita da seguinte maneira:

```php
$route->path('/caminho_da_rota', 'Controller@action');
```

ou em forma de clojure

```php
$route->path('/home', function () {
    // Ao acessar a rota /home o que estiver aqui dentro será executado
});
```

### FORM

As rotas do tipo **form** recebem o caminho que sera digitado pelo usuário no navegador e o controller ou a clojure que esse caminho irá apontar, por padrão ela aceitará rotas do tipo **get** e **post** 
A criação de uma rota do tipo form é feita da seguinte maneira:

```php
$route->form('/caminho_da_rota', 'Controller@action');
```

ou em forma de clojure

```php
$route->form('/home', function () {
    // Ao acessar a rota /home o que estiver aqui dentro será executado
});
```

### ANY

As rotas do tipo **any** recebem o caminho que sera digitado pelo usuário no navegador e o controller ou a clojure que esse caminho irá apontar, por padrão, rotas do tipo any aceitam os métodos **['get', 'post', 'put', 'delete']**
A criação de uma rota do tipo any é feita da seguinte maneira:

```php
$route->any('/caminho_da_rota', 'Controller@action');
```
ou em forma de clojure

```php
$route->any('/home', function () {
    // Ao acessar a rota /home o que estiver aqui dentro será executado
});
```

### MATCH

As rotas do tipo **math** recebem  um array com os métodos permitidos, o caminho que sera digitado pelo usuário no navegador e o controller ou a clojure que esse caminho irá apontar
A criação de uma rota do tipo match é feita da seguinte maneira:

```php
$route->math(['get', 'post', 'etc...'], '/caminho_da_rota', 'Controller@action');
```

ou em forma de clojure

```php
$route->match(['get', 'post', 'etc...'], '/home', function () {
    // Ao acessar a rota /home o que estiver aqui dentro será executado
});
```

### AUTH

As rotas do tipo **auth** recebem  um array com os métodos permitidos, o caminho que sera digitado pelo usuário no navegador e o controller ou a clojure que esse caminho irá apontar, por padrão as rotas do tipo **auth** irão fazer a vallidação do usuário antes de executar o controller ou a clojure, caso o usuário não esteja logado na aplicação ela ira redirecionar o usuário para a página de erro **404**
A criação de uma rota do tipo match é feita da seguinte maneira:

```php
$route->auth(['get', 'post', 'etc...'], '/caminho_da_rota', 'Controller@action');
```

ou em forma de clojure

```php
$route->auth(['get', 'post', 'etc...'], '/home', function () {
    // Ao acessar a rota /home o que estiver aqui dentro será executado
});
```

## Grupos de rotas (prefixo)

Para criarmos rotas com prefixos pré definidos basta antes do grupo de rotas a ser implementados colocar o seginte trecho de código

```php
$route->group("nome_do_prefixo");
```

Para exemplificar vamos supor que estamos desenvolvendo um api e precisamos que todas as nossas rotas tenha o prefixo **/api/**, para isso basta adicionar o código

```php
$route->group("api");
$route->get('/home', 'HomeController@index');
```

para acessarmos essa rota precisamos digitar no navegador **/api/home**

Se precisarmos trocar o prefixo ou não queiramos mais usar o mesmo basta passar o novo nome do dentro de **$route->group("novo_prefixo")**, ou **$route->group(null)** 


```php
// para adicionar um novo prefixo
$route->group("novo_prefixo");
$route->get('/home', 'HomeController@index');
```

```php
// para remover um prefixo existente
$route->group("novo_prefixo");
$route->get('/home', 'HomeController@index');
```