# <img src="App/Public/assets/img/scooby_logo.svg" width="40"/> ScoobyPHP

> Um framework MVC feito com PHP e muito amor para tornar o desnvolvimento web muito mais simples e divertido.

O desenvolvimento de aplicações web tem se tornado cada vez mais necessário no cenário atual, seguindo esta tendência, a padronização de escrita de código, estruturação de projeto e etc tem evoluído cada dia mais, não é difícil nos depararmos com novos padrões adotados pela comunidade. Levando em consideração toda essa evolução e necessidade, proporcionamos aos desenvolvedores, principalmente aqueles que estão tendo um primeiro contato com um framework
php
, uma maior facilidade e conforto na estruturação dos diretórios, agilidade e desempenho nas entregas, segurança e organização do projeto.

## Estrutura de pastas

A pasta *** App *** será onde toda a regra de negócio ficará, esta pasta contém os controllers, models, rotas, arquivos de configuração, seeds, migrations, a pasta public onde ficaram os arquivos css, javascript, imagens utilizadas na aplicação, imagens vindas de uploads, views e uma pasta nomeada de Utils, que será explicada sua função no decorrer deste guia.

**Atenção:** Por convenção o ScoobyPHP nomeia suas pastas com a primeira letra maiúscula, sendo assim, quando criar uma pasta ou uma sub-pasta,  por favor siga esta recomendação.

Estrutura de pasta App/:

![strat00](Docs/Images/skeleton.png)

### Breve descrição de cada pasta dentro do diretório App/

##### App/

Pasta onde será criada toda a regra de negócios da aplicação, em todo o ciclo de vida do web app só será necessário ter conhecimento desta pasta em questão.

##### App/Config

Esta pasta conterá todos os arquivos de configurações da aplicação, como por exemplo, configurações de banco de dados, envio de e-mail e etc...

##### App/Config/lang

Nesta pasta ficam os arquivos de tradução do systema, caso deseje fazer um sistema multilinguagem será abordado mais a diante deste guia como implementar esta funcionalidade.

##### App/Controllers

Aqui ficam todos os controlers da aplicação, esta pasta não aceita outras pastas dentro dela, ou seja, o ScoobyPHP até a versão atual não aceita pastas especificas para a criação de controllers específicos, por exemplo: App/Controllers/Auth/UserController, essa arquitetura de organização dos controllers separados em pastas irá gerar um erro na aplicação.

##### App/Db

Nesta pasta ficam os arquivos de migrations e seeds

##### App/Db/Migration

Dentro desta pasta ficaram todas as migrations geradas pelo sistema.

##### App/Db/Seeds

Dentro desta pasta ficaram todas as seeds geradas pelo sistema, ao decorrer deste guia sera abordado como gerar migrations, seeds e muito mais utilizando o scooby-do, uma ferramenta de linha de comando.

##### App/Utils

Nesta pasta pode ser usada para um propósito geral, para a criação de metodos auxiliares, extensão dos helpers, validações, etc...

##### App/Models

Aqui ficaram todo os models da aplicação, ao decorrer deste guia sera abordado como gerar models via terminal utilizando o scooby-do.

##### App/Public

Nesta pasta ficaram os arquivos públicos da aplicação.

##### App/Public/assats/css

Neste local ficará todos os arquivos css da aplicação, não deverá ser criadas pastas aqui dentro, pois o ScoobyPHP mapeia esta pasta para minificar os arquivos e inclui-los no template.

##### App/Public/assets/img

Aqui ficaram as imagem utilizadas pela aplicação

##### App/Public/assats/js

Neste local ficará todos os arquivos javascript da aplicação, não deverá ser criadas pastas aqui dentro, pois o ScoobyPHP mapeia esta pasta para minificar os arquivos e incluí-los no template.

##### App/Public/uploaded

Nesta pasta ficará todos os arquivos upados da aplicação

##### App/Routes

Nesta pasta ficaram todos os arquivos de rotas, caso necessário poderá ser criado mais de um arquivo contendo diferentes rotas do sistema.

##### App/tests

Aqui ficará todos os testes da aplicação [Ainda não está em funcionamento]

##### App/Views

Aqui ficam as paginas da aplicação, templates e paginas de erro

##### App/Views/Error

Nesta pasta ficam as páginas de erro do sistema, como por exemplo a página de erro 404.

##### App/Views/pages

Aqui ficam todas as páginas da aplicação, sendo assim o diretório responsável pelo frontend do app.

## Os componentes do MVC

Tradicionalmente usado para interfaces gráficas de usuário (GUIs), esta arquitetura tornou-se popular para projetar aplicações web e até mesmo para aplicações móveis, para desktop e para outros clientes. Linguagens de programação populares como Java, C#, Ruby, PHP e outras possuem frameworks MVC populares que são atualmente usados no desenvolvimentos de aplicações web.

### Camada de modelo ou da lógica da aplicação (Model)

Modelo é a ponte entre as camadas Visão (View) e Controle (Controller), consiste na parte lógica da aplicação, que gerencia o comportamento dos dados através de regras de negócios, lógica e funções. Esta fica apenas esperando a chamada das funções, que permite o acesso para os dados serem coletados, gravados e, exibidos.

É o coração da execução, responsável por tudo que a aplicação vai fazer a partir dos comandos da camada de controle em um ou mais elementos de dados, respondendo a perguntas sobre o sua condição e a instruções para mudá-las. O modelo sabe o que o aplicativo quer fazer e é a principal estrutura computacional da arquitetura, pois é ele quem modela o problema que está se tentando resolver. Modela os dados e o comportamento por trás do processo de negócios. Se preocupa apenas com o armazenamento, manipulação e geração de dados. É um encapsulamento de dados e de comportamento independente da apresentação.

### Camada de apresentação ou visualização (View)

Visão pode ser qualquer saída de representação dos dados, como uma tabela ou um diagrama. É onde os dados solicitados do Modelo (Model) são exibidos. É possível ter várias visões do mesmo dado, como um gráfico de barras para gerenciamento e uma visão tabular para contadores. A Visão também provoca interações com o usuário, que interage com o Controle (Controller). O exemplo básico disso é um botão gerado por uma Visão, no qual um usuário clica e aciona uma ação no Controle.

Não se dedica em saber como o conhecimento foi retirado ou de onde ela foi obtida, apenas mostra a referência. Segundo Gamma et al (2006), ”A abordagem MVC separa a View e Model por meio de um protocolo inserção/notificação (subscribe/notify). Uma View deve garantir que sua expressão reflita o estado do Model. Sempre que os dados do Model mudam, o Model altera as Views que dependem dele. Em resposta, cada View tem a oportunidade de modificar-se”. Adiciona os elementos de exibição ao usuário : HTML, ASP, XML, Applets. É a camada de interface com o usuário. É utilizada para receber a entrada de dados e apresentar visualmente o resultado.

### Camada de controle ou controlador (Controller)

Controle é o componente final da tríade, faz a mediação da entrada e saída, comandando a visão e o modelo para serem alterados de forma apropriada conforme o usuário solicitou através do mouse e teclado. O foco do Controle é a ação do usuário, onde são manipulados os dados que o usuário insere ou atualiza, chamando em seguida o Modelo.

O Controle (Controller) envia essas ações para o Modelo (Model) e para a janela de visualização (View) onde serão realizadas as operações necessárias.
