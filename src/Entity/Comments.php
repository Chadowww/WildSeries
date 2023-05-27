<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpClient\HttpClient;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
#[ApiResource]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentsBySeriesId(int $id): array
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://api.betaseries.com/comments/comments?type=show&&key=17d61e0acf16&id=' . $id
        );

        $statusCode = $response->getStatusCode();

        $response = $response->toArray();
        return $response;
    }
}
