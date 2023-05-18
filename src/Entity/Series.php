<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SeriesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpClient\HttpClient;

#[ORM\Entity(repositoryClass: SeriesRepository::class)]
#[ApiResource]
class Series
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getById(int $id): array
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://api.betaseries.com/shows/display?key=17d61e0acf16&id='. $id
        );

        $statusCode = $response->getStatusCode();

        $response = $response->toArray();
        return $response;
    }

    public function getAll(): array
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://api.betaseries.com/search/shows?key=17d61e0acf16&limit=100'
        );

        $statusCode = $response->getStatusCode();

        $response = $response->toArray();
        return $response;
    }
    public function showDiscover(): array
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://api.betaseries.com/shows/discover?limit=20&key=17d61e0acf16'
        );

        $statusCode = $response->getStatusCode();

        $response = $response->toArray();
        return $response;
    }
    public function showNews(): array
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://api.betaseries.com/news/last?number=20&key=17d61e0acf16'
        );

        $statusCode = $response->getStatusCode();

        $response = $response->toArray();
        return $response;
    }
}
