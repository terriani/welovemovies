<?php
//Controller gerado automaticamente via - Scooby-CLI em 06-06-20 - 11:57:am

namespace Scooby\Controllers;

use Scooby\Core\Controller;
use Scooby\Models\User;
use Scooby\Helpers\FlashMessage;
use Scooby\Helpers\Login;
use Scooby\Helpers\Session;
use Scooby\Helpers\Request;
use Scooby\Models\Watch;
use Scooby\Services\GenersList;
use Scooby\Services\RecomendationByGenre;
use Scooby\Services\RecomendationOfDay;
use Scooby\Services\SearchFilme;


class DashboardController extends Controller
{
    public function index(): void
    {
        $userInfo = (Login::userInfo());
        FlashMessage::getFlashMessage('successKey');
        FlashMessage::getFlashMessage('error');
        $this->view("Pages", "DashBoard", ['name' => $userInfo->userName]);
    }

    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function recomendation(): void
    {
        $userInfo = (Login::userInfo());
        $data = RecomendationOfDay::getRecomendation()['results'];

        $watch = new Watch;
        $watchId = $watch->where('user_id', $userInfo->userId)->get();
        $watchArr = [];
        foreach ($watchId as $watch) {
            $watchArr[] = $watch->film_id;
        }

        $response = '';
        for ($i = 0; $i < 20; $i++) {
            if ($data[$i]['poster_path'] != null and $data[$i]['backdrop_path'] != null) {
                for ($j = 0; $j < count($data[$i]['genre_ids']); $j++) {
                    $data[$i]['genre_ids'][$j] = GenersList::getGender($data[$i]['genre_ids'][$j]);
                }
                $data[$i]['genre_ids'] = implode(' - ', $data[$i]['genre_ids']);
            }
            if (!in_array($data[$i]['id'], $watchArr)) {
                $response = $data;
            }
        }

        $this->Json([
            'recomendations' => $response
        ]);
    }

    public function recomendationByGenre($param)
    {
        $userInfo = (Login::userInfo());
        $data = RecomendationByGenre::getRecomendationByGenre($param['genre'])['results'];

        $watch = new Watch;
        $watchId = $watch->where('user_id', $userInfo->userId)->get();
        $watchArr = [];
        foreach ($watchId as $watch) {
            $watchArr[] = $watch->film_id;
        }


        $response = '';
        for ($i = 0; $i < 20; $i++) {
            if ($data[$i]['poster_path'] != null and $data[$i]['backdrop_path'] != null) {
                for ($j = 0; $j < count($data[$i]['genre_ids']); $j++) {
                    $data[$i]['genre_ids'][$j] = GenersList::getGender($data[$i]['genre_ids'][$j]);
                }
                $data[$i]['genre_ids'] = implode(' - ', $data[$i]['genre_ids']);
            }
            if (!in_array($data[$i]['id'], $watchArr)) {
                $response = $data;
            }
        }

        $this->Json([
            'recomendations' => $response,
        ]);
    }

    /**
     * Faz o logout do usuario
     *
     * @return void
     */
    public function exit(): void
    {
        Login::sessionLoginDestroyWithRedirect("login");
    }

    /**
     * Deleta o usuario logado
     *
     * @param integer $id
     * @return void
     */
    public function deleteUser(): void
    {
        $id = $_SESSION['id'];
        $user = new User;
        $u = $user->find($id);
        $u->delete();
        $this->exit();
    }
    /**
     * Busca as informações dos usuario e chama a view de edição
     *
     * @return void
     */
    public function alterUser(): void
    {
        $id = Session::getSession('id');
        $user = new User;
        $u = $user->find($id);
        if ($u == null) {
            $this->view('pages', 'Dashboard', [
                'msg' => FlashMessage::toast('Error:', $GLOBALS['SOMETHING_WRONG'], 'error')
            ]);
            exit;
        }
        $this->view('pages', 'UpdateUser', [
            'name' => $u->name,
            'email' => $u->email,
            'deep' => $u->deep_search,
            'adult' => $u->adult_content
        ]);
    }

    /**
     * Atualiza as informações do usuario
     *
     * @return void
     */
    public function updateUser(): void
    {
        $id = Session::getSession('id');
        $name = Request::post('name');
        $email = Request::post('email');
        $password = Request::post('pass');
        $deep = Request::post('deep');
        $adult = Request::post('adult');
        if ($adult == false) {
            $adult = 0;
        } else {
            $adult = 1;
        }
        $user =  new User;
        $u = $user->find($id);
        if (empty($password)) {
            $u->name = $name;
            $u->email = $email;
            $u->deep_search = $deep;
            $u->adult_content = $adult;
            $u->save();
            FlashMessage::flashMessage('error', 'Ok...', $GLOBALS['UPDATE_DATA_SUCCESS'], 'success', 'dashboard');
            exit;
        }
        if (empty($name)) {
            $u->password = Login::passwordHash($password);
            $u->email = $email;
            $u->deep_search = $deep;
            $u->adult_content = $adult;
            $u->save();
            FlashMessage::flashMessage('error', 'Ok...', $GLOBALS['UPDATE_DATA_SUCCESS'], 'success', 'dashboard');
            exit;
        } elseif (empty($email)) {
            $u->name = $name;
            $u->password = Login::passwordHash($password);
            $u->deep_search = $deep;
            $u->adult_content = $adult;
            $u->save();
            FlashMessage::flashMessage('error', 'Ok...', $GLOBALS['UPDATE_DATA_SUCCESS'], 'success', 'dashboard');
            exit;
        } elseif (empty($password)) {
            $u->name = $name;
            $u->email = $email;
            $u->deep_search = $deep;
            $u->adult_content = $adult;
            $u->save();
            FlashMessage::flashMessage('error', 'Ok...', $GLOBALS['UPDATE_DATA_SUCCESS'], 'success', 'dashboard');
            exit;
        }
        $u->name = $name;
        $u->email = $email;
        $u->password = Login::passwordHash($password);
        $u->deep_search = $deep;
        $u->adult_content = $adult;
        $u->save();
        FlashMessage::flashMessage('error', 'Ok...', $GLOBALS['UPDATE_DATA_SUCCESS'], 'success', 'dashboard');
        exit;
    }

    public function watch()
    {
        FlashMessage::getFlashMessage('successKey');
        FlashMessage::getFlashMessage('error');
        $userInfo = (Login::userInfo());
        $this->View('Pages','Watch', ['name' => $userInfo->userName]);
    }

    public function watchData()
    {
        $whatch = new Watch;
        $data = $whatch->where('watched', 0)->get();
        $this->Json([
            $data
        ]);
    }

    public function watched()
    {
        FlashMessage::getFlashMessage('successKey');
        FlashMessage::getFlashMessage('error');
        $userInfo = (Login::userInfo());
        $this->View('Pages','Watched', ['name' => $userInfo->userName]);
    }

    public function watchedData()
    {
        $whatch = new Watch;
        $data = $whatch->where('watched', 1)->get();
        $this->Json([
            $data
        ]);
    }

    public function watcheds()
    {
        $whatch = new Watch;
        $data = $whatch->where('watched', 1)->get();
        $this->View('Pages', 'Watcheds', [
            'whatchedMovies' => $whatch->where('watched', 1)->count(),
            'film' => $data
        ]);
    }

    public function saveToWatch($param)
    {
        $response = SearchFilme::serachById($param['filmId']);
        $watch = new Watch;
        $id = [];
        $arr = $watch->all();
        foreach ($arr as $f) {
            $id[] = $f->film_id;
        }
        if (!empty($response['status_code'])) {
            FlashMessage::flashMessage('successKey', 'Opss', 'Filme não encontrado', 'error');
            exit;
        }
        if (in_array($param['filmId'], $id)) {
            $status = $watch->where('film_id', $param['filmId'])->get()->first();
            if ($status->watched == 1) {
                FlashMessage::flashMessage('successKey', 'Opss', 'Você já possui este filme na sua lista de filmes assistidos', 'info');
                exit;
            }
            FlashMessage::flashMessage('successKey', 'Opss', 'Você já possui este filme na sua lista de desejos', 'info');
            exit;
        }
        $watch->name = (!empty($response['title'])) ? $response['title'] : 'Não informado';
        $watch->genre = (!empty($response['genres'])) ? $response['genres'] : 'Não informado';
        $watch->tagline = (!empty($response['tagline'])) ? str_replace('. ', ' - ', $response['tagline']) : 'Não informado';
        $watch->overview = (!empty($response['overview'])) ? $response['overview'] : 'Não informado';
        $watch->cover = (!empty($response['backdrop_path'])) ? TMDB_BASE_IMG . $response['backdrop_path'] : 'Não informado';
        $watch->background = (!empty($response['poster_path'])) ? TMDB_BASE_IMG . $response['poster_path'] : 'Não informado';
        $watch->original_lang = (!empty($response['original_language'])) ? $response['original_language'] : 'Não informado';
        $watch->original_title = (!empty($response['original_title'])) ? $response['original_title'] : 'Não informado';
        $watch->vote_average = (!empty($response['vote_average'])) ? \number_format($response['vote_average'], 1) : 0;
        $watch->popularity = (!empty($response['popularity'])) ? \number_format($response['popularity'], 1) : 0;
        $watch->date_limit = date('y-m-d', strtotime('+5 days'));
        $watch->release_date = (!empty($response['release_date'])) ? $response['release_date'] : 'Não informado';
        $watch->film_id = (!empty($response['id'])) ? $response['id'] : 'Não informado';
        $watch->user_id = Login::userInfo()->userId;
        $watch->watched = 0;
        if (!$watch->save()) {
            $this->Json('Falha ao salvar o filme ' . $response['title'] . ' na sua lista de desejos');
        }
        FlashMessage::flashMessage('successKey', 'Ok', $response['title'] . ' salvo com sucesso na sua lista de desejos', 'success');
    }

    public function logedFilm()
    {
        FlashMessage::getFlashMessage('successKey');
        $this->view('Pages', 'LogedFilm');
    }

    public function viewDetail($param)
    {
        $response = SearchFilme::serachById($param['filmId']);
        $this->Json($response);
    }

    public function addViewed($param)
    {
        $watch = new Watch;
        $w = $watch->where('film_id', $param['filmId'])->get()->first();
        $w->watched = 1;
        $w->watch_date = date('Y-m-d');
        if (!$w->save()) {
            FlashMessage::flashMessage('successKey', 'Opsss', 'Filme mantido na sua lista de desejos', 'error');
        }
        FlashMessage::flashMessage('successKey', 'Tudo Certo', 'Filme salvo com sucesso na sua lista de assistidos', 'success');
    }

    public function removeViewed($param)
    {
        $watch = new Watch;
        $w = $watch->where('film_id', $param['filmId'])->get()->first();
        $w->watched = 0;
        $w->watch_date = null;
        if (!$w->save()) {
            FlashMessage::flashMessage('successKey', 'Opsss', 'Filme mantido na sua lista de assistidos', 'error');
        }
        FlashMessage::flashMessage('successKey', 'Tudo Certo', 'Filme retornado com sucesso para a sua lista de desejos', 'success');
    }
}
