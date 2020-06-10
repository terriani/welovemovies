<?php

use Scooby\Helpers\Cli;

class MakeClearCache
{
    public static function execOptionMakeClearCache()
     {
         $cacheDir = scandir('System/SysConfig/Cache/');
         if ($cacheDir == false) {
             Cli::println('Um erro desconhecido ocorreu ao limpar o cache da aplicação');
             return;
         }
         if (count($cacheDir) > 2) {
             $clearCache = shell_exec('sudo rm -rf System/SysConfig/Cache/*');
             Cli::println('Diretório de Cache limpo com suscesso');
         } else {
             Cli::println('Você não possui nenhum arquivo de cache disponivel para ser deletado.');
         }
     }
}
