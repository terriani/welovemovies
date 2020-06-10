# Instalação

### OS X & Linux

O modo mais fácil de instalar o ScoobyPHP é clonar o repositório do instalador no github, ou baixar o instalador no site oficial.
Lembrando que será necessário ter o composer e o npm instalado no computador em questão.

Clonando o instalador:

```sh
git clone https://github.com/terriani/ScoobyNewProject.git
```

Baixando o instalador pelo site oficial:

vá ate o site oficial que se encontra em ScoobyPHP.tech/install, baixe o instalador, descompacte no diretório onde será criado o projeto, htdocs/ ou www/ por exemplo e pronto isso será o bastante para iniciarmos com o ScoobyPHP.

Após clonar o repositório ScoobyNewProject acesse ele e copie o arquivo que encontra-se em seu interior, caso tenha efetuado o download no site o arquivo estará pronto para o uso, não sendo necessário entrar na pasta e copiar o mesmo.

para rodarmos o instalador do ScoobyPHP basta e entrar na pasta onde o arquivo scooby-create-app se encontra e executar o comando:

```sh
php scooby-create
```

Ao executar este comando, será solicitado no terminal que o programador de um nome para o novo projeto, informe este nome e aguarde o termino da instalação. Pode ser que o instalador necessite da senha do usuário logado para a manipulação do cache e para dar as devidas permissões no projeto, caso isso aconteça, informe a senha requerida e aguarde o fim da instalação.

Quando a instalação chegar ao final uma mensagem de informando o sucesso desta operação sera apresentada, note que também será criado um repositório com o nome que foi informado no começo da instalação. Este diretório contem tudo que será necessário para o desenvolvimento da sua nova aplicação web.

### Windows

Primeiramente será necessário fazer o download do git bash no site: git-scm.com

Após o download e instalação do git bash siga o guia de instalação para LINUX e OS X

### Clonando o ScoobyPHP direto do github

Também é possível clonar o repositório do ScoobyPHP direto do github, para isso basta entrar no terminal, ou caso esteja usando windows, será necessário utilizar o git bash e navegar ate a pasta onde ficam os projetos, por exemplo, htdocs/ ou www/, execute o comando:

```sh
git clone https://github.com/terriani/ScoobyPHP.git
```

Após clonar o projeto será necessário instalar as suas dependências, para isto basta rodar dois comandos no terminal na pasta raiz do projeto. Primeiro instale as dependências do composer, para isto execute:

```sh
composer install
```

Após o termino da instalação das dependências do composer, vamos instalar as dependências do javascript:

```sh
npm install
```

Pronto agora com as dependências instaladas, já é possível renomear a pasta do ScoobyPHP para o nome do seu projeto, Lembrando que será necessário entrar na pasta que do projeto, lá dentro entre em: App/Config/appConfig.php e altere o nome do seu projeto na constante APP_NAME, trocando o scoobyPHP para o nome que do projeto. Caso a instalação tenha sido feito com o instalador não será necessário fazer nenhuma alteração nas configurações do framework.

## Executando o projeto no navegador

Levando em consideração que todos os passos anteriores foram executados corretamente e seu servidor local, por exemplo o xampp, esteja rodando sem erro, abra seu navegador e digite na barra de endereço:

```sh
http://localhost/NomeDoProjeto/
```

Ou caso esteja utilizando um virtual host, digite no navegador o link setado nos arquivos de configuração da sua VHost.

Caso a instalação tenha dado tudo cero, uma tela de boas vindas será apresentada.

![image](Docs/Images/wellcome.png)
