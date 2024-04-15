<?php

namespace App\Service;

use phpDocumentor\Reflection\Types\This;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ValorantApiService
{

    private $httpClient;
    private $apiKey;
    private $name;
    private $tag;

    public function __construct(HttpClientInterface $httpClient, string $apiKey, string $name, string $tag)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;
        $this->name = $name;
        $this->tag = $tag;
    }
    // Setter para name
    public function setName($name)
    {
        $this->name = $name;
    }

    // Getter para name
    public function getName()
    {
        return $this->name;
    }

    // Setter para tag
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    // Getter para tag
    public function getTag()
    {
        return $this->tag;
    }
    public function getListAgentes(): array
    {
        //$url = "https://eu.api.riotgames.com/val/content/v1/contents" . "?api_key=" . $this->apiKey;
        $url = "https://valorant-api.com/v1/agents";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $agentes = $data["data"];
        return $agentes;
    }
    public function getListMapas(): array
    {
        //$url = "https://eu.api.riotgames.com/val/content/v1/contents" . "?api_key=" . $this->apiKey;
        $url = "https://valorant-api.com/v1/maps";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $mapas = $data["data"];
        return $mapas;
    }
    public function getListArmas():array{
        $url = "https://valorant-api.com/v1/weapons";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $armas = $data["data"];
        return $armas;

    }
    public function getLlaveros(): array
    {
        $url = "https://valorant-api.com/v1/buddies";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $llaveros = $data["data"];
        return $llaveros;
    }
    public function getSkins(): array
    {
        $url = "https://valorant-api.com/v1/bundles";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $skins = $data["data"];
        return $skins;
    }
    public function getTarjetas(): array
    {
        $url = "https://valorant-api.com/v1/playercards";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $tarjetas = $data["data"];
        return $tarjetas;
    }
    public function getGrafitis(): array
    {
        $url = "https://valorant-api.com/v1/sprays";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $grafitis = $data["data"];
        return $grafitis;
    }
    public function getModosJuego(): array
    {
        $url = "https://valorant-api.com/v1/gamemodes";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $modos = $data["data"];
        return $modos;
    }
    public function getRangos(): array{
        $url = "https://valorant-api.com/v1/competitivetiers";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $rangos = $data["data"];
        return $rangos;
    }
}
