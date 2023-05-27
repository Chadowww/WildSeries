<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpClient\HttpClient;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ApiResource]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getById(int $id): array
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://api.betaseries.com/movies/movie?key=17d61e0acf16&id=' . $id
        );

        $statusCode = $response->getStatusCode();

        $response = $response->toArray();
        return $response;
    }
    public function getCharacters(int $id): array
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://api.betaseries.com/movies/characters?key=17d61e0acf16&id=' . $id
        );

        $statusCode = $response->getStatusCode();

        $response = $response->toArray();
        return $response;
    }
}
