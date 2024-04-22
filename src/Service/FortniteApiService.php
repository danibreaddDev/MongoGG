<?php

namespace App\Service;

use phpDocumentor\Reflection\Types\This;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FortniteApiService
{
    private $httpclient;
    private $apiKey;
    public function __construct(HttpClientInterface $httpclient, string $apiKey)
    {
        $this->httpclient = $httpclient;
        $this->apiKey = $apiKey;
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
    public function getNews(): array
    {
        $url = "https://fortnite-api.com/v1/news";
        $response = $this->httpclient->request('GET', $url);
        $data = $response->toArray();
        $news = $data["data"];
        return $news;
    }
    public function getPlaylists(): array
    {
        $url = "https://fortnite-api.com/v1/playlists";
        $response = $this->httpclient->request('GET', $url);
        $data = $response->toArray();
        $playlists = $data["data"];
        return $playlists;
    }
    public function getShop(): array
    {
        $url = "https://fortnite-api.com/v2/shop/br/combined";
        $response = $this->httpclient->request('GET', $url);
        $data = $response->toArray();
        $shop = $data["data"];
        return $shop;
    }
    public function getStatsByPlayer(string $name): array
    {
        $url = "https://fortnite-api.com/v2/stats/br/v2";
        $apikey = $this->apiKey;
        $headers = [
            'Authorization' => $apikey,
        ];
        $response = $this->httpclient->request('GET', $url, [
            'headers' => $headers,
            'query' => [
                'name' => $name,
                'accountType' => 'epic',
                'timeWindow' => 'lifetime',
            ],
        ]);
        $data = $response->toArray();
        $player = $data["data"];
        return $player;
    }
}
