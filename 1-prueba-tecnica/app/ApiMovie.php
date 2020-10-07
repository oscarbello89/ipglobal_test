<?php

namespace App;

use App\Model\Movie;
use App\Exception\ApiError;



class APIMovie {
    protected $apiUrl;
    protected $apiKey;

    public function __construct($apiKey, $apiUrl) {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
    }

    /**
     * Película por IMDb ID.
     *
     * @param string $imdbId
     * @return Movie
     * @throws ApiErrorException
     */
    public function getByImdbId(string $imdbId): Movie {
        $params     = $this->parametros('i', $imdbId, '', 0, 0);
        $response   = $this->apiGet($params);
        $parsed     = $this->parseResponse($response);

        return $this->createMovieObject($parsed);
    }

    /**
     * Película por identificación de título.
     *
     * @param string $title
     * @return Movie
     * @throws ApiError
     */
    public function getByTitle(string $title): Movie {
        $params     = $this->parametros('t', $title, "", 0, 0);
        $response   = $this->apiGet($params);
        $parsed     = $this->parseResponse($response);

        return $this->createMovieObject($parsed);
    }

    /**
     * Listado de películas.
     *
     * @param string $title
     * @param string $type
     * @param int    $year
     * @param int    $page
     *
     * @return array
     * @throws ApiError
     */
    public function search(string $title, string $type = 'movie', int $year = 0, int $page = 1): array {
        $params     = $this->parametros('s', $title, $type, $year, $page);
        $response   = $this->apiGet($params);

        return $this->parseResponse($response);
    }


    /**
     * Parámetros de la solicitud CURL HTTP.
     *
     * @param string $getBy
     * @param string $value
     * @param string $type
     * @param int    $year
     * @param int    $page
     *
     * @return array
     */
    protected function parametros(string $getBy, string $value, string $type, int $year, int $page): array {
        $params = [$getBy => $value];

        if ($type) {
            $params['type'] = $type;
        }

        if ($year) {
            $params['y'] = $year;
        }

        if ($page) {
            $params['page'] = $page;
        }

        return $params;
    }

    /**
     * Comprobar errores.
     *
     * @param array $response
     * @return array
     * @throws ApiError
     */
    protected function parseResponse(array $response): array {
        $value = array_values($response['Params'])[0];
        $array = json_decode($response['Response'], true);

        /* Lanzamiendo de excepciones en caso de error
       *
       * 
       * 
       if (empty($array['Response'])) {
            throw new ApiError($value, $response['Response']);
        }

        if ($array['Response'] === 'False') {
            throw new ApiError($value, $array['Error']);
        }*/

        return $array;
    }


    /**
     * API Get - Obtenemos datos y devolvemos array
     *
     * @param array $params
     * @return array
     */
    protected function apiGet(array $params): array {
        $query = http_build_query(array_merge($params, [
            'r' => 'json',
        ]));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, sprintf('%s?apikey=%s&%s', $this->apiUrl, $this->apiKey, $query));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response   = curl_exec($ch);
        $info       = curl_getinfo($ch);

        curl_close($ch);

        return [
            'Params'    => $params,
            'Response'  => $response,
            'Info'      => $info,
        ];
    }

    /**
     * Crea instancia de la clase película a partir de la respuesta parseada.
     *
     * @param array $data
     * @return Movie
     */
    protected function createMovieObject(array $data): Movie {
        return new Movie(
            $data['imdbID'],
            $data['Title'],
            $data['Year'],
            $data['Rated'],
            $data['Released'],
            intval($data['Runtime']),
            explode(', ', $data['Genre']),
            explode(', ', $data['Director']),
            explode(', ', $data['Writer']),
            explode(', ', $data['Actors']),
            $data['Plot'],
            explode(', ', $data['Language']),
            explode(', ', $data['Country']),
            $data['Awards'],
            $data['Poster'],
            $data['Type']
        );
    }
}
