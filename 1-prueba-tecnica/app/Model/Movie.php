<?php

namespace App\Model;

class Movie
{

    protected $imdbId;
    protected $title;
    protected $year;
    protected $rated;
    protected $released;
    protected $runtime;
    protected $genre;
    protected $director;
    protected $writer;
    protected $actors;
    protected $plot;
    protected $language;
    protected $country;
    protected $awards;
    protected $posterUrl;
    protected $type;


    public function __construct(
        string $imdbId,
        string $title,
        string $year,
        string $rated,
        string $released,
        int $runtime,
        array $genre,
        array $director,
        array $writer,
        array $actors,
        string $plot,
        array $language,
        array $country,
        string $awards,
        string $posterUrl,
        string $type
    ) {
        $this->imdbId               = $imdbId;
        $this->title                = $title;
        $this->year                 = $year;
        $this->rated                = $rated;
        $this->released             = $released;
        $this->runtime              = $runtime;
        $this->genre                = $genre;
        $this->director             = $director;
        $this->writer               = $writer;
        $this->actors               = $actors;
        $this->plot                 = $plot;
        $this->language             = $language;
        $this->country              = $country;
        $this->awards               = $awards;
        $this->posterUrl            = $posterUrl;
        $this->type                 = $type;
    }


    public function getImdbId(): string
    {
        return $this->imdbId;
    }


    public function getTitle(): string
    {
        return $this->title;
    }


    public function getYear(): string
    {
        return $this->year;
    }


    public function getRated(): string
    {
        return $this->rated;
    }


    public function getReleased(): string
    {
        return $this->released;
    }


    public function getGenre(): array
    {
        return $this->genre;
    }


    public function getDirector(): array
    {
        return $this->director;
    }


    public function getWriter(): array
    {
        return $this->writer;
    }

    public function getActors(): array
    {
        return $this->actors;
    }


    public function getPlot(): string
    {
        return $this->plot;
    }

    public function getLanguage(): array
    {
        return $this->language;
    }

    public function getCountry(): array
    {
        return $this->country;
    }


    public function getAwards(): string
    {
        return $this->awards;
    }


    public function getPosterUrl(): string
    {
        return $this->posterUrl;
    }


    public function getType(): string
    {
        return $this->type;
    }


    /**
     * Convierte objeto movie en array asociativo.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'ImdbId'                => $this->imdbId,
            'Titulo'                 => $this->title,
            'Ano'                  => $this->year,
            'Valoracion'                 => $this->rated,
            'Estreno'              => $this->released,
            'Genero'                 => $this->genre,
            'Director'              => $this->director,
            'Guionista'                => $this->writer,
            'Actores'                => $this->actors,
            'Argumento'                  => $this->plot,
            'Idioma'              => $this->language,
            'Pais'               => $this->country,
            'Premios'                => $this->awards,
            'Poster'                => $this->posterUrl,
            'Tipo'                  => $this->type,
        ];
    }
}
