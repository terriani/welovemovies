<?php

namespace Scooby\Services;

use Scooby\Helpers\HttpClient;
use Scooby\Models\User;

class RecomendationOfDay
{
    public static function getRecomendation()
    {
        $adult = '';
        $deep = '';
        if (isset($_SESSION['id'])) {
            $user = new  User;
            $u = $user->find($_SESSION['id']);
            $deep = $u->deep_search;
            if ($u->adult_content == 1) {
                $adult = '&include_adult=true';
            }
        } else {
            $adult = '&include_adult=false';
            $deep = 20;
        }
        $url = TMDB_BASE_URL . 'trending/movie/day?page=' . rand(1, $deep) . '&sort_by=popularity.desc&append_to_response=videos'. $adult .'&language=pt-BR';
        $response = HttpClient::get($url, [], ['Authorization' => "Bearer ". TMDB_KEY]);
        return $response->body['json'];
    }
}