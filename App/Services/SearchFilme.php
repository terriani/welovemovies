<?php

namespace Scooby\Services;

use Scooby\Helpers\HttpClient;
use Scooby\Models\User;

class SearchFilme
{
    public static function serachById($filmId)
    {
        $adult = '';
        if (isset($_SESSION['id'])) {
            $user = new  User;
            $u = $user->find($_SESSION['id']);
            if ($u->adult_content == 1) {
                $adult = '&include_adult=true';
            }
        } else {
            $adult = '&include_adult=false';
        }
        $url = TMDB_BASE_URL . 'movie/' . $filmId . '?language=pt-BR&append_to_response=videos'.$adult;
        $response = HttpClient::get($url, [], ['Authorization' => 'Bearer ' . TMDB_KEY]);
        $res = $response->body['json'];
        $genre = [];
        for ($i = 0; $i < count(($res['genres'])); $i++) {
            $genre[] = $res['genres'][$i]['name'];
        }
        $genre = implode(' - ', $genre);
        $res['genres'] = $genre;
        return $res;
    }

    public static function serachByName(string $name)
    {
        $adult = '';
        if (isset($_SESSION['id'])) {
            $user = new  User;
            $u = $user->find($_SESSION['id']);
            if ($u->adult_content == 1) {
                $adult = '&include_adult=true';
            }
        } else {
            $adult = '&include_adult=false';
        }
        $name = str_replace(' ', '+', $name);
        $url = TMDB_BASE_URL . 'search/movie?query=' . $name . '&language=pt-BR'.$adult;
        $response = HttpClient::get($url, [], ['Authorization' => 'Bearer ' . TMDB_KEY]);
        $res = $response->body['json'];

        if (count($res['results']) > 1) {
            for ($j = 0; $j < 20; $j++) {
                for ($i = 0; $i < count(($res['results'][$j]['genre_ids'])); $i++) {
                    $res['results'][$j]['genre_ids'][$i] = GenersList::getGender($res['results'][$j]['genre_ids'][$i]);
                }
                $res['results'][$j]['genre_ids']  = implode(' - ', $res['results'][$j]['genre_ids']);
            }
        } else {
            for ($i = 0; $i < count(($res['results'][0]['genre_ids'])); $i++) {
                $res['results'][0]['genre_ids'][$i] = GenersList::getGender($res['results'][0]['genre_ids'][$i]);
            }
            $res['results'][0]['genre_ids']  = implode(' - ', $res['results'][0]['genre_ids']);
        }

        return $res;
    }
}
