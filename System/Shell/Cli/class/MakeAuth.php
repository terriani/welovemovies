<?php

use Scooby\Helpers\Cli;

class MakeAuth
{
    public static function execOptionMakeAuth()
    {
        Cli::println('Por favor digite sua senha para dar permissão de escrita no cache da aplicação');
        shell_exec('sudo chmod 777 -R System/SysConfig/Cache');
        $userController = file_get_contents('System/Shell/templates/php_tpl/userController.tpl');
        $userController = strtr($userController, ['dateNow' => date('d-m-y - H:i:a')]);

        $dashboardController = file_get_contents('System/Shell/templates/php_tpl/dashboardController.tpl');
        $dashboardController = strtr($dashboardController, ['dateNow' => date('d-m-y - H:i:a')]);


        $userModel = file_get_contents('System/Shell/templates/php_tpl/userModel.tpl');
        $userModel = strtr($userModel, ['dateNow' => date('d-m-y - H:i:a')]);

        $passwordTokenModel = file_get_contents('System/Shell/templates/php_tpl/passwordRescueModel.tpl');
        $passwordTokenModel = strtr($passwordTokenModel, ['dateNow' => date('d-m-y - H:i:a')]);

        $loginView = file_get_contents('System/Shell/templates/twig_tpl/login.tpl');
        $loginView = strtr($loginView, ['dateNow' => date('d-m-y - H:i:a')]);

        $registerView = file_get_contents('System/Shell/templates/twig_tpl/register.tpl');
        $registerView = strtr($registerView, ['dateNow' => date('d-m-y - H:i:a')]);

        $passwordRescue = file_get_contents('System/Shell/templates/twig_tpl/passwordRescue.tpl');
        $passwordRescue = strtr($passwordRescue, ['dateNow' => date('d-m-y - H:i:a')]);

        $newPassword = file_get_contents('System/Shell/templates/twig_tpl/newPassword.tpl');
        $newPassword = strtr($newPassword, ['dateNow' => date('d-m-y - H:i:a')]);

        $dashBoardView = file_get_contents('System/Shell/templates/twig_tpl/dashboard.tpl');
        $dashBoardView = strtr($dashBoardView, ['dateNow' => date('d-m-y - H:i:a')]);

        $updateUser = file_get_contents('System/Shell/templates/twig_tpl/updateUser.tpl');
        $updateUser = strtr($updateUser, ['dateNow' => date('d-m-y - H:i:a')]);

        $routesAuth = file_get_contents('System/Shell/templates/php_tpl/routesAuth.tpl');
        $routesAuth = strtr($routesAuth, ['dateNow' => date('d-m-y - H:i:a')]);

        $navbar = file_get_contents('System/Shell/templates/twig_tpl/navbar.tpl');
        $navbar = strtr($navbar, ['dateNow' => date('d-m-y - H:i:a')]);

        $authConfig = file_get_contents('.env');

        if (file_exists("App/Controllers/UserController.php")) {
            Cli::println("ERROR: Controller UserController já existente na pasta 'App/Controllers'");
            return;
        }
        if (file_exists("App/Controllers/DashboardController.php")) {
            Cli::println("ERROR: Controller UserController já existente na pasta 'App/Controllers'");
            return;
        }
        if (file_exists("App/Models/User.php")) {
            Cli::println("ERROR: Model User já existente na pasta 'App/Models'");
            return;
        }
        if (file_exists("App/Views/Pages/Login.twig")) {
            Cli::println("ERROR: View Login já existente na pasta 'App/Views/Pages'");
            return;
        }
        if (file_exists("App/Views/Pages/Register.twig")) {
            Cli::println("ERROR: View Register já existente na pasta 'App/Views/Pages'");
            return;
        }
        if (file_exists("App/Views/Pages/passwordRescue.twig")) {
            Cli::println("ERROR: View Password Rescue já existente na pasta 'App/Views/Pages'");
            return;
        }
        if (file_exists("App/Views/Pages/NewPassword.twig")) {
            Cli::println("ERROR: View New Password Rescue já existente na pasta 'App/Views/Pages'");
            return;
        }
        $f = fopen("App/Controllers/UserController.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $userController);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("UserController criado em 'App/Controllers' com sucesso.");
        $f = fopen("App/Controllers/DashboardController.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $dashboardController);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("DashboardController criado em 'App/Controllers' com sucesso.");
        $f = fopen("App/Models/User.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $userModel);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        $f = fopen("App/Models/PasswordUserToken.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $passwordTokenModel);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("PasswordUserToken criado em 'App/Models' com sucesso.");
        $f = fopen("App/Views/Pages/Login.twig", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $loginView);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("Login criado em 'App/Views/Pages' com sucesso.");
        $f = fopen("App/Views/Pages/Register.twig", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $registerView);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("Register criado em 'App/Views/Pages' com sucesso.");
        $f = fopen("App/Views/Pages/PasswordRescue.twig", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $passwordRescue);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        $f = fopen("App/Views/Pages/NewPassword.twig", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $newPassword);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("PasswordRescue criado em 'App/Views/Pages' com sucesso.");
        $f = fopen("App/Views/Pages/DashBoard.twig", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $dashBoardView);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("DashBoard criado em 'App/Views/Pages' com sucesso.");
        $f = fopen("App/Views/Pages/UpdateUser.twig", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $updateUser);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("UpdateUser criado em 'App/Views/Pages' com sucesso.");
        $f = fopen("App/Routes/web.php", 'a+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $routesAuth);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("Rotas de Autenticação criadas em 'App/Routes/web.php' com sucesso.");
        $f = fopen("App/Views/Pages/Home.twig", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $navbar);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("Navbar criado em 'App/Views/Pages/Home.twig' com sucesso.");
        $f = fopen(".env", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $authConfig = strtr($authConfig, [
            'VIEWS_AUTH=' => 'VIEWS_AUTH=Dashboard,UpdateUser,'
        ]);
        fwrite($f, $authConfig);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        $migrationUser = shell_exec("php vendor/robmorgan/phinx/bin/phinx create CreateUserAuth --template='System/Shell/templates/migrations_tpl/migration_user_auth_template.tpl'");
        sleep(1);
        $migrationPasswordRescue = shell_exec("php vendor/robmorgan/phinx/bin/phinx create PasswordRescue --template='System/Shell/templates/migrations_tpl/migration_user_password_rescue_template.tpl'");
        if ($migrationUser) {
            Cli::println("Migration UserAuth criada com sucess");
            //Cli::println("Migrate executada com sucess");
        }
        $seed = file_get_contents('System/Shell/templates/seeds_tpl/SeedUserAuth.tpl');
        $seed = strtr($seed, ['dateNow' => date('d-m-y - H:i:a')]);
        $f = fopen("App/Db/Seeds/SeedUserAuth.php", 'w+');
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
        //$migrate = shell_exec("php vendor/robmorgan/phinx/bin/phinx migrate");
        Cli::println("SeedUserAuth criada com sucesso em App/Db/Seeds/" . PHP_EOL);
        Cli::println("\033[1;96m -> [ATENÇÃO] Antes de executar as MIGRATIONS verifique se não deseja alterar suas estruturas em App/Db/Migrations, após isso execute as migrations com o comando MIGRATE via scooby-do" . PHP_EOL);
        exit;
    }

    public static function execOptionMakeAuthApi()
    {
        Cli::println('Por favor digite sua senha para dar permissão de escrita no cache da aplicação');
        shell_exec('sudo chmod 777 -R System/SysConfig/Cache');
        $userController = file_get_contents('System/Shell/templates/php_tpl/userApiController.tpl');
        $userController = strtr($userController, ['dateNow' => date('d-m-y - H:i:a')]);

        $userModel = file_get_contents('System/Shell/templates/php_tpl/userModel.tpl');
        $userModel = strtr($userModel, ['dateNow' => date('d-m-y - H:i:a')]);

        $passwordTokenModel = file_get_contents('System/Shell/templates/php_tpl/passwordRescueModel.tpl');
        $passwordTokenModel = strtr($passwordTokenModel, ['dateNow' => date('d-m-y - H:i:a')]);

        $routesAuth = file_get_contents('System/Shell/templates/php_tpl/routesApiAuth.tpl');
        $routesAuth = strtr($routesAuth, ['dateNow' => date('d-m-y - H:i:a')]);

        if (file_exists("App/Controllers/UserApiController.php")) {
            Cli::println("ERROR: Controller UserApiController já existente na pasta 'App/Controllers'");
            return;
        }

        if (file_exists("App/Models/User.php")) {
            Cli::println("ERROR: Model User já existente na pasta 'App/Models'");
            return;
        }

        $f = fopen("App/Controllers/UserApiController.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $userController);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("UserApiController criado em 'App/Controllers' com sucesso.");
        $f = fopen("App/Models/User.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $userModel);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        $f = fopen("App/Models/PasswordUserToken.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $passwordTokenModel);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("PasswordUserToken criado em 'App/Models' com sucesso.");
        $f = fopen("App/Routes/api.php", 'a+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $routesAuth);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("Rotas de Autenticação criadas em 'App/Routes/api.php' com sucesso.");
        $migrationUser = shell_exec("php vendor/robmorgan/phinx/bin/phinx create CreateUserAuth --template='System/Shell/templates/migrations_tpl/migration_user_auth_template.tpl'");
        sleep(1);
        $migrationPasswordRescue = shell_exec("php vendor/robmorgan/phinx/bin/phinx create PasswordRescue --template='System/Shell/templates/migrations_tpl/migration_user_password_rescue_template.tpl'");
        if ($migrationUser) {
            Cli::println("Migration UserAuth criada com sucess");
            //Cli::println("Migrate executada com sucess");
        }
        $seed = file_get_contents('System/Shell/templates/seeds_tpl/SeedUserAuth.tpl');
        $seed = strtr($seed, ['dateNow' => date('d-m-y - H:i:a')]);
        $f = fopen("App/Db/Seeds/SeedUserAuth.php", 'w+');
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
        //$migrate = shell_exec("php vendor/robmorgan/phinx/bin/phinx migrate");
        Cli::println("SeedUserAuth criada com sucesso em App/Db/Seeds/" . PHP_EOL);
        Cli::println("\033[1;96m -> [ATENÇÃO] Antes de executar as MIGRATIONS verifique se não deseja alterar suas estruturas em App/Db/Migrations, após isso execute as migrations com o comando MIGRATE via scooby-do" . PHP_EOL);
        exit;
    }
}
