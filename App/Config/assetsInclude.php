<?php

require_once 'App/Config/Lang/' . SITE_LANG . '.php';

$html = [
    'header' => [
        "<link rel='stylesheet' href='" . NODE_MODULES . "animate.css/animate.min.css'>",
        "<link rel='stylesheet' href='" . NODE_MODULES . "izitoast/dist/css/iziToast.min.css'>",
        "<link rel='stylesheet' href='".NODE_MODULES."materialize-css/dist/css/materialize.min.css'>",
        "<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>",
        "<link href='https://fonts.googleapis.com/css?family=Cinzel&display=swap' rel='stylesheet'>",
        "<link rel='stylesheet' href='" . ASSET . "css/404.css'>",


        /**
         * Este arquivo carrega todos os arquivos JS minificados criados na pasta App/Public/assets/js/
         */
        "<link rel='stylesheet' href='System/MinifyFiles/min-css/scooby" . ASSETS_HASH . ".min.css'>",
    ],
    'bodyTop' => [
        "<script src='" . NODE_MODULES . "jquery/dist/jquery.min.js'></script>",
        "<script src='" . NODE_MODULES . "sweetalert2/dist/sweetalert2.all.min.js'></script>",
        "<script src='" . NODE_MODULES . "izitoast/dist/js/iziToast.min.js'></script>",
        "<script src='".NODE_MODULES."materialize-css/dist/js/materialize.min.js'></script>",


        /**
         * Este arquivo carrega todos os arquivos JS minificados criados na pasta App/Public/assets/js/
         */
        "<script src='System/MinifyFiles/min-js/scooby" . ASSETS_HASH . ".min.js'></script>"
    ],
    'bodyBottom' => [


        /**
         * Esta função gera um alert do tipo toast sempre a internet do usuario cair ou ser restabelecida,
         * você encontra esta função  em App/Public/assets/js/scooby.js
         */
        '<script>
            isOnline(
                "' . $GLOBALS["CONNECTION_FAILURE_TITLE"] . '",
                "' . $GLOBALS["CONNECTION_FAILURE"] . '",
                "' . $GLOBALS["CONNECTION_TITLE"] . '",
                "' . $GLOBALS["RESTORED_CONNECTION"] . '"
            )
        </script>'
    ]
];
