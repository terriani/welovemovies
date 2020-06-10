<?php

use Scooby\Helpers\Cli;

class MakeMigration
{
    public static function execOptionMakeMigration()
    {
        $migrationName = Cli::getParam('Por favor, DIGITE o nome da Migration a ser criada. Use o formato CamelCase');
        $migrationName = ucfirst($migrationName);

        $convertName = ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', $migrationName)), '_');
        $fileName = date('YmdHis') . "_" . $convertName;

        if (file_exists("App/Db/Migrations/$fileName.php")) {
            Cli::println("ERROR: Migration já existente na pasta 'App/Db/Migrations/'");
            return;
        }
        $migration = file_get_contents('System/Shell/templates/migrations_tpl/migration.tpl');
        $migration = strtr($migration, [
            'migrationName' => $migrationName,
            'dateNow' => date('d-m-y - H:i:a')
        ]);
        $f = fopen('App/Db/Migrations/' . $fileName . '.php', 'w+');
        fwrite($f, $migration);
        fclose($f);
        if (!$f) {
            Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
            return;
        }

        Cli::println("Migration $migrationName criada com sucesso em App/Db/Migrations/");
    }
}
