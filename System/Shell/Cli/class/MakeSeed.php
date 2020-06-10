<?php

use Scooby\Helpers\Cli;

class MakeSeed
{
    public static function execOptionMakeSeed()
    {
        $seedName = Cli::getParam('Por favor, DIGITE o nome da Seed a ser criada. Use o formato CamelCase');
        $seedName = ucfirst($seedName);
        if (file_exists("App/Db/Seeds/$seedName.php")) {
            Cli::println("ERROR: Seed já existente na pasta 'App/Db/Seeds/'");
            return;
        }
        $seed = file_get_contents('System/Shell/templates/seeds_tpl/seedFile.tpl');
        $seed = strtr($seed, ['dateNow' => date('d-m-y - H:i:a')]);
        $f = fopen("App/Db/Seeds/$seedName.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $seed);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("Seed {$seedName}Seed criada com sucesso em App/Db/Seeds/");
    }
}
