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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAll(){
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://api.betaseries.com/news/last?number=20&key=17d61e0acf16'
        );

        $statusCode = $response->getStatusCode();

        $response = $response->toArray();
        return $response;
    }
    public function showDiscover(){
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://api.betaseries.com/shows/discover?limit=20&key=17d61e0acf16'
        );

        $statusCode = $response->getStatusCode();

        $response = $response->toArray();
        return $response;
    }
}
