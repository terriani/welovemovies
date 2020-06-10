# Configurações

## Desvendando as configurações do ScoobyPHP

Raramente o programador precisará alterar os arquivos de configuração do Scooby, porém, é de suma importância termos conhecimentos sobre seus arquivos.

### Conhecendo a pasta App/Config

Possuímos alguns arquivos de configuração dentro da pasta App/Config, são estes:

#### App/Config/Lang/

Nesta pasta ficam os arquivos de idioma do ScoobyPHP, para criar novos arquivos de tradução dentro do Scooby é bem simples, basta criar um novo arquivo dentro desta pasta, o nome deste arquivo deve seguir a tabela contida nesta página <a href='https://www.w3schools.com/tags/ref_language_codes.asp' target='_blank'>www.w3schools.com/tags/ref_language_codes.asp</a>, Após nomear o arquivo com referência ao idioma que sera incluso basta copiar o conteúdo de um dos arquivos já existentes, o conteúdo dos arquivos de tradução é um array $GLOBAL['key' => 'value'], onde a tradução devera ser feita substituindo o valor do value dentro do array.

```php

//Simulação de criação de novo arquivo de tradução

//Arquivo existente en.php
$GLOBALS = [
'WELLCOME_MSG' => 'Welcome to the Scooby framework. If you are viewing this page,
     it means that scooby was installed correctly! '
];

//Primeiro Criamos o arquivo pt-br.php e adicionamos o conteúdo do en.php, após isso traduzimos as mensagens e caso precise criamos novas mensagens
//Tradução, note que a chave do array permanece a mesma só alteramos o valor

$GLOBALS = [
'WELLCOME_MSG' => 'Bem vindo ao Scooby framework. Se Você esta visualizando esta página,
     quer dizer que o scooby foi instalado corretamente!'
]

```

Para acessarmos essas mensagens traduzidas em qualquer parte do sistema é muito fácil, basta chamarmos $GLOBALS[''], passando a chave que desejamos recuperar o valor.

```php
// Recuperando o valor de um arquivo de tradução
//chame-se a global passando a chave desejada
echo $GLOBALS['WELLCOME_MSG'];
```

Esse código ira imprimir na tela a mensagem de boas-vindas.

Para configurar um novo idioma basta abrir o arquivo situado em App/Config/appConfig.php e alterar a constante SITE_LANG para o idioma desejado.

```php
// Alteração de idioma de inglês para português

//Site lang definido em inglês
 define('SITE_LANG', 'en');

// Alterar para o idioma desejado, lembrando que o arquivo de tradução devera ter sido criado previamente
 define('SITE_LANG', 'pt_br'); 
```

#### App/Config/apiConfig.php

Este arquivo é muito importante, pois contém as configurações básicas para o desenvolvimento de APIs utilizando o scooby

Neste arquivo encontramos:

```php

// Definir se a aplicação será uma API ou um projeto WEB monolítico
define('IS_API', false);

// Hash para encriptação do jwt único, gerado ao criar o projeto
define('SECRET_KEY', '76783e11c38704ce746fa4f01cf4c85cb5db840077d4d4e4a4bf250824f155bb');

// Constante para definição de origens permitidas 
define('ORIGIN_ALLOW', '*');

// Constante para definição de metodos permitodos 
define('METHODS_ALLOW', 'GET, POST, PUT, DELETE');

// 
define('CREDENTIALS_ALLOW', true);

```

#### App/Config/appConfig.php

No arquivo appConfig encontramos as configurações básicas da aplicação como APP_NAME, BASE_URL e etc...

```php
//define o nome do site em desenvolvimento
    define('APP_NAME', 'ScoobyPHP');

    //Url base para caso o controller não seja indicado na url
    define("HOME", "home");

    //define o idioma das menssagens exibidas automaticamente pelo o framework em desenvolvimento
    define('SITE_LANG', 'pt-br');

    //define a url base do sistema
    define("BASE_URL", "/");

    // Nome dado a rota de erro http
    define('ROUTE_ERROR', 'ooops');
```

#### App/Config/assetsConfig

Neste arquivo encontramos todas as configurações de assets da aplicação.
Em **ASSETS_VERSION** temos um valor definido como 1, este valor é a versão atual dos seus assets, ao um projeto em produção, alteramos o conteúdo do arquivo  ***env.php*** para "***production***" e subimos o projeto para o servidor, com o projeto em ambiengte de produção ao alterarmos o conteúdo de algum de nossos arquivos de assets como os ***CSS*** ou o ***JS*** da nossa aplicação devemos mudar a verssão da constante **ASSETS_VESRION** para 2 e assim por diante, agora caso queira voltar uma versão especifica dos assets do projeto basta alterar o assets versio para o número desejado.

#### App/Config/assetsInclude.php

A utilização deste arquivo é bem simples e intuitivo, dentro do array ***html*** temos 3 arrays, o ***header***, ***bodyTop*** e ***bodyBottom***, a função destes arrays são receber as tags ***Link*** e ***Script***, por exemplo, vamos supor que precisamos adicionar uma tag link no ***header*** do template da nossa aplicação, arquivo assetsInclude.php ficaria assim

```php

$html = [
    'header' => [
        // Este arquivo sera carregado no header da aplicação
        "<link rel='stylesheet' href='" . ASSET . "css/404.css'>"
    ],
    'bodyTop' => [
        // Aqui ficara os arquivos carregados na parte superior da body
    ],
    'bodyBottom' => [
        // Aqui ficara os arquivos carregados na parte superior da body
    ]
];

```

#### App/Config/authConfig.php

Por padrão o ScoonyPHP não autentica somente suas rotas e controllers, ele também autentica suas views, oferecendo assim mais uma camada de segurança para suas aplicações.
Ao criarmos uma view, precisamos registar ela no arquivo ***authConfig.php***, este arquivo possui dois arrays, um chamado ***notAutentication*** e o outro nomeado como ***autentication***, para as views públicas, que serão vistas por todos e não somente por usuário logados no sistema, devera ser adicionado o nome ao array notAutentication, e as views que só poderão ser visualizadas por usuários logados deverão ser registradas no array autentication. Para registrar uma view e muito simples, basta adicionar o nome da mesma, sem a extensão ***.twig***.

```php

/**
 * Array contendo as views que não passarão pela autenticação
 */
$notAutentication = [
    // Aqui ficam as view não autenticadas 
    '404',
    'home',
];

/**
 * Array contendo as views que passarão pela autenticação
 */
$autentication = [
    // Aqui ficam as views autenticadas
];

```

#### App/Config/databaseConfig.php

Neste arquivo podemos efetuar todas as configurações de banco de dados, tanto em modo de desenvolvimento como em produção

#### App/Config/emailConfig.php

Neste arquivo podemos efetuar todas as configurações de um servidor ***SMTP***, tanto em modo de desenvolvimento como em produção

#### App/Config/env.php

Neste arquivo definimos se nossa aplicação está em modo desenvolvimento ou em produção

#### App/Config/SEOConfig.php

Neste arquivo podemos efetuar todas as configurações de ***SEO*** da aplicação, tanto em modo de desenvolvimento como em produção

#### App/Config/twigGlobalVariables.php

Neste arquivo podemos definir variáveis globais para usarmos em nosso frontend com ***.twig***, segue um exemplo de definição de variável global em twig e sua recuperação no frontend da aplicação.

```php
$twig->addGlobal('nome_dado_a_variavel', 'Conteudo_da_variavel'),
```

e para usarmos essa variável em nossos arquivos ***.twig*** usamos:

```twig
{{ nome_dado_a_variavel }}
```