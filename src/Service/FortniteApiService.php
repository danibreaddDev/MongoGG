<?php

namespace App\Service;

use phpDocumentor\Reflection\Types\This;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FortniteApiService
{
    private $httpclient;
    public function __construct(HttpClientInterface $httpclient)
    {
        $this->httpclient = $httpclient;
    }
    public function getBanners(): array
    {
        $url = "https://fortnite-api.com/v1/banners";
        $response = $this->httpclient->request('GET', $url);
        $data = $response->toArray();
        $banners = $data["data"];
        return $banners;
    }
    public function getColors(): array
    {
        $url = "https://fortnite-api.com/v1/banners/colors";
        $response = $this->httpclient->request('GET', $url);
        $data = $response->toArray();
        $colors = $data["data"];
        return $colors;
    }
    public function getCosmetics(): array
    {
        $url = "https://fortnite-api.com/v2/cosmetics/br/new";
        $response = $this->httpclient->request('GET', $url);
        $data = $response->toArray();
        $cosmetics = $data["data"];
        $cosmetics = $cosmetics["items"];
        return $cosmetics;
    }
    public function getCodes(string $name): array
    {
        $url = "https://fortnite-api.com/v2/creatorcode" . "?name=" . $name;
        $response = $this->httpclient->request('GET', $url);
        $data = $response->toArray();
        $codes = $data["data"];
        return $codes;
    }
    public function getMap(): array
    {
        $url = "https://fortnite-api.com/v1/map";
        $response = $this->httpclient->request('GET', $url);
        $data = $response->toArray();
        $map = $data["data"];
        return $map;
    }
}
