<?php

namespace Scooby\Services;

class GenersList
{
    /**
     * Array com os generos de filmes
     *
     * @var array
     */
    private static $geners =
    [
        28 => "Ação",
        12 => "Aventura",
        16 => "Animação",
        35 => "Comédia",
        80 => "Crime",
        99 => "Documentário",
        18 => "Drama",
        10751 => "Família",
        14 => "Fantasia",
        36 => "História",
        27 => "Terror",
        10402 => "Música",
        9648 => "Mistério",
        10749 => "Romance",
        878 => "Ficção Científica",
        10770 => "Cinema TV",
        53 => "Thriller",
        10752 => "Guerra",
        37 => "Faroeste"
    ];

    public static function getGender(int $generId = 0)
    {
        if ($generId != 0 and in_array($generId, array_keys(self::$geners))) {
            return self::$geners[$generId];
        } else if (empty($generId) or $generId == 0) {
            return self::$geners;
        }
        return 'Este id não existe';
    }

    public static function getGenderId(string $gendername)
    {
        $gendername = ucfirst($gendername);
        if ($gendername == 'Medo' or $gendername == 'Terror' or $gendername == 'Horror') {
            $gendername = 'Terror';
        }
        if ($gendername == 'Suspense') {
            $gendername = 'Mistério';
        }
        if ($gendername == 'Policial') {
            $gendername = 'Crime';
        }
        if ($gendername == 'Ficção') {
            $gendername = 'Ficção Científica';
        }
        $gendername = ucfirst($gendername);
        if (in_array($gendername, self::$geners)) {
            return array_search($gendername, self::$geners);
        }
        return 'Este filme não existe';
    }
}
