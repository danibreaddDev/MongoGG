<?php

namespace App\Service;

use phpDocumentor\Reflection\Types\This;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ValorantApiService
{

    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }
    public function getListAgentes(): array
    {
        
        $url = "https://valorant-api.com/v1/agents";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $agentes = $data["data"];
        return $agentes;
    }
    public function getListMapas(): array
    {
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
    public function getEscudos(): array{
        $url = "https://valorant-api.com/v1/gear";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $escudos = $data["data"];
        return $escudos;
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
    public function getCeremonias(): array{
        $url = "https://valorant-api.com/v1/ceremonies";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $ceremonias = $data["data"];
        return $ceremonias;
    }
    public function getStrangeSkins(): array{
        $url = "https://valorant-api.com/v1/contenttiers";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $contenido = $data["data"];
        return $contenido;
    }
    public function getContratos(): array{
        $url = "https://valorant-api.com/v1/contracts";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $contratos = $data["data"];
        return $contratos;
    }
    public function getMonedas(): array{
        $url = "https://valorant-api.com/v1/currencies";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $monedas = $data["data"];
        return $monedas;
    }
    public function getEventos(): array{
        $url = "https://valorant-api.com/v1/events";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $eventos = $data["data"];
        return $eventos;
    }

    public function getBordesNivel(): array{
        $url = "https://valorant-api.com/v1/levelborders";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $bordes = $data["data"];
        return $bordes;
    }
    public function getTitulos(): array{
        $url = "https://valorant-api.com/v1/playertitles";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $titulos = $data["data"];
        return $titulos;
    }
    public function getTemporadas(): array{
        $url = "https://valorant-api.com/v1/seasons/competitive";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $temporadas = $data["data"];
        return $temporadas;
    }
    public function getTemas(): array{
        $url = "https://valorant-api.com/v1/themes";
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $temas = $data["data"];
        return $temas;
    }
    
}
