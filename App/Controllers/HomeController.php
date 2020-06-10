<?php

namespace Scooby\Controllers;

use Scooby\Core\Controller;
use Scooby\Helpers\FlashMessage;
use Scooby\Services\GenersList;
use Scooby\Services\RecomendationByGenre;
use Scooby\Services\RecomendationOfDay;
use Scooby\Services\SearchFilme;


class HomeController extends Controller
{

    public function index()
    {
        $this->view('Pages', 'Home');
    }

    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function recomendation(): void
    {
        FlashMessage::getFlashMessage('error');
        FlashMessage::getFlashMessage('successKey');
        $data = RecomendationOfDay::getRecomendation()['results'];

        $response = '';
        for ($i = 0; $i < 20; $i++) {
            if ($data[$i]['poster_path'] != null and $data[$i]['backdrop_path'] != null) {
                for ($j = 0; $j < count($data[$i]['genre_ids']); $j++) {
                    $data[$i]['genre_ids'][$j] = GenersList::getGender($data[$i]['genre_ids'][$j]);
                }
                $data[$i]['genre_ids'] = implode(' - ', $data[$i]['genre_ids']);
                $response = $data;
            }
        }

        $this->Json([
            'recomendations' => $response
        ]);
    }

    public function recomendationByGenre($param)
    {
        $data = RecomendationByGenre::getRecomendationByGenre($param['genre'])['results'];

        $response = '';
        for ($i = 0; $i < 20; $i++) {
            if ($data[$i]['poster_path'] != null and $data[$i]['backdrop_path'] != null) {
                for ($j = 0; $j < count($data[$i]['genre_ids']); $j++) {
                    $data[$i]['genre_ids'][$j] = GenersList::getGender($data[$i]['genre_ids'][$j]);
                }
                $data[$i]['genre_ids'] = implode(' - ', $data[$i]['genre_ids']);
                $response = $data;
            }
        }

        $this->Json([
            'recomendations' => $response,
        ]);
    }

    public function film()
    {
        $this->view('Pages', 'Film', ['statusLog' => $_SESSION['statusLog']]);
    }

    public function viewDetail($param)
    {
        $response = SearchFilme::serachById($param['filmId']);
        $this->Json($response);
    }

    public function search()
    {
        $this->view('Pages', 'Search', ['statusLog' => $_SESSION['statusLog']]);
    }

    public function searchFilm($param)
    {
        $response = SearchFilme::serachByName($param['filmName']);
        $this->Json($response);
    }
}
