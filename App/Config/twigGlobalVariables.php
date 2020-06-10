<?php

// Crie variaveis globais para serem usadas nos templates twig
return [
    $twig->addGlobal('btn_sign_in', $GLOBALS['BTN_SIGN_IN']),
    $twig->addGlobal('btn_sign_out', $GLOBALS['BTN_SIGN_OUT']),
    $twig->addGlobal('btn_sign_up', $GLOBALS['BTN_SIGN_UP']),
    $twig->addGlobal('btn_update', $GLOBALS['BTN_UPDATE']),
    $twig->addGlobal('btn_delete', $GLOBALS['BTN_DELETE']),
    $twig->addGlobal('btn_back', $GLOBALS['BTN_BACK']),
    $twig->addGlobal('btn_send', $GLOBALS['BTN_SEND']),
    $twig->addGlobal('btn_password_reset', $GLOBALS['BTN_PASSWORD_RESET']),
];
