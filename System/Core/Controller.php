<?php

namespace Scooby\Core;

use Scooby\Helpers\Auth;
use Scooby\Helpers\Redirect;
use Scooby\Helpers\Response;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

abstract class Controller
{
    protected $ViewData = [];

    /**
     * Analisa e carrega os templates logado e deslogado
     *
     * @param string $ViewPath
     * @param string $ViewName
     * @param array $ViewData
     * @return void
     */
    public function view(string $viewPath, string $ViewName, array $ViewData = [])
    {
        $viewAutentication = [];
        include "System/SysConfig/viewsAuthentication.php";
        $loader = new FilesystemLoader('App/Views');
        $debug = false;
        if (getenv('ENV') == 'development') {
            $debug = true;
        }
        $twig = new Environment($loader, [
            'debug' => $debug,
            'cache' => 'System/SysConfig/Cache'
        ]);
        $twig->addGlobal('csrfToken', $_SESSION['csrfToken']);
        $twig->addGlobal('base_url', BASE_URL);
        $twig->addGlobal('assets', ASSET);
        $twig->addGlobal('session', $_SESSION);
        $twig->addGlobal('session', $_SESSION);
        $twig->addGlobal('upload', "Public/uploaded/");
        $twig->addGlobal('method_put', '<input type="hidden" name="_method" value="PUT">');
        $twig->addGlobal('method_delete', '<input type="hidden" name="_method" value="DELETE">');
        $twig->addGlobal('method_patch', '<input type="hidden" name="_method" value="PATCH">');
        require_once 'App/Config/twigGlobalVariables.php';
        $ViewName = ucwords($ViewName);
        if (in_array($ViewName, $viewAutentication) === true or in_array(strtolower($ViewName), $viewAutentication) === true) {
            if (Auth::authValidOrFail()) {
                require_once 'System/Html/Templates/Header.php';
                $template = $twig->load(ucfirst($viewPath).'/'.ucfirst($ViewName).'.twig');
                extract($ViewData);
                echo $template->render($ViewData);
                require_once 'System/Html/Templates/Footer.php';
            } else {
                Redirect::redirectTo('ooops/404');
            }
        } else {
                require_once 'System/Html/Templates/Header.php';
                $template = $twig->load(ucfirst($viewPath) . '/' . ucfirst($ViewName) . '.twig');
                extract($ViewData);
                echo $template->render($ViewData);
                require_once 'System/Html/Templates/Footer.php';
        }
    }

    /**
     * Seta um title para a view carregada
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title = ''): void
    {
        if (!empty($title)) {
            $_SESSION['pageTitle'] = $title;
        }
    }

    /**
     * Retorna um json
     *
     * @param string|array $data
     * @return void
     */
    public function Json($data)
    {
        return Response::Json($data);
    }
}
