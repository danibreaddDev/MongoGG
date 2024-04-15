<?php

namespace App\Service;

use phpDocumentor\Reflection\Types\This;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LolApiService
{
    private $container;
    private $httpClient;
    private $apiKey;
    private $name;
    private $tag;

    public function __construct(ContainerInterface $container, HttpClientInterface $httpClient, string $apiKey, string $name, string $tag)
    {
        $this->container = $container;
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


    public function getListCampeones(): array
    {
        $jsonFilePath = $this->container->getParameter('kernel.project_dir') . '/src/Data/champions.json';

        $championsData = file_get_contents($jsonFilePath);
        $championsJson = json_decode($championsData, true);

        // Crear un array para almacenar los nombres de los campeones
        $campeones = [];
        foreach ($championsJson['data'] as $champion) {
            $nombre = $champion['image']['full'];
            $nombreSinExtension = explode(".", $nombre)[0];
            $campeones[] = $nombreSinExtension;
        }
        return $campeones;
    }
    public function getListCampeonesRotacion(): array
    {
        // Construir la URL completa
        $baseUrl = "https://euw1.api.riotgames.com/lol/platform/v3/champion-rotations";
        $url = $baseUrl . '?api_key=' . $this->apiKey;

        // Realizar la solicitud GET a la API de Riot Games
        $response = $this->httpClient->request('GET', $url);

        // Decodificar la respuesta JSON
        $data = $response->toArray();

        // Obtener la lista de campeones
        $campeonesid = $data['freeChampionIds']; // Asegúrate de que la respuesta JSON tiene esta estructura
        // Obtener la ruta absoluta al archivo JSON
        $jsonFilePath = $this->container->getParameter('kernel.project_dir') . '/src/Data/champions.json';

        $championsData = file_get_contents($jsonFilePath);
        $championsJson = json_decode($championsData, true);

        // Crear un array para almacenar los nombres de los campeones
        $campeones = [];

        // Iterar sobre los IDs de los campeones y buscar el nombre correspondiente en el JSON
        foreach ($campeonesid as $id) {
            foreach ($championsJson['data'] as $champion) {
                if ($champion['key'] == $id) {
                    $nombre = $champion['image']['full'];
                    $nombreSinExtension = explode(".", $nombre)[0];
                    $campeones[] = $nombreSinExtension;
                    break;
                }
            }
        }

        return $campeones;
    }
    public function getListDivision(string $division, string $tier, string $queue): array
    {
        $baseUrl = "https://euw1.api.riotgames.com/lol/league-exp/v4/entries/" . $queue . "/" . $tier . "/" . $division . "?page=" . "1";
        $url = $baseUrl . '&api_key=' . $this->apiKey;

        // Realizar la solicitud GET a la API de Riot Games
        $response = $this->httpClient->request('GET', $url);

        // Decodificar la respuesta JSON
        $data = $response->toArray();
        $summonerid = [];
        foreach (array_slice($data, 0, 10) as $elemento) {
            $summonerid[] = [
                "summonerId" => $elemento["summonerId"],
                "tier" => $elemento["tier"],
                "rank" => $elemento["rank"],
                "leaguePoints" => $elemento["leaguePoints"],
                "wins" => $elemento["wins"],
                "losses" => $elemento["losses"]
            ];
        }
        $puid = [];
        foreach (array_slice($data, 0, 10) as $elemento) {
            $baseUrl = "https://euw1.api.riotgames.com/lol/summoner/v4/summoners/" . $elemento["summonerId"];
            $url = $baseUrl . '?api_key=' . $this->apiKey;
            $response = $this->httpClient->request('GET', $url);
            $data = $response->toArray();
            $puid[] = [
                "puuid" => $data["puuid"]
            ];
        }
        $gameNames =[];
        foreach ($puid as $elemento) {
            $baseUrl = "https://europe.api.riotgames.com/riot/account/v1/accounts/by-puuid/" . $elemento["puuid"];
            $url = $baseUrl . '?api_key=' . $this->apiKey;
            $response = $this->httpClient->request('GET', $url);
            $data = $response->toArray();
            $gameNames[] = [
                "gameName" => $data["gameName"],
                "tagLine" => $data["tagLine"]
            ];
        }
        $arraycombinado = [];
        foreach ($summonerid as $key => $elemento) {
            if(isset($gameNames[$key]['gameName']) && isset($gameNames[$key]['tagLine'])){
                $arraycombinado[] =[
                    "gameName" => $gameNames[$key]["gameName"],
                    "tagLine" => $gameNames[$key]["tagLine"],
                    "tier" => $elemento["tier"],
                    "rank" => $elemento["rank"],
                    "leaguePoints" => $elemento["leaguePoints"],
                    "wins" => $elemento["wins"],
                    "losses" => $elemento["losses"],
                ];
            }
        }
        return $arraycombinado;
    }

    public function getInfoSummoners(string $name, string $tag): array
    {

        //aqui tenemos el nombre y el tag por lo que hay que pedir peti a https://europe.api.riotgames.com/riot/account/v1/accounts/by-riot-id/
        $baseUrl = "https://europe.api.riotgames.com/riot/account/v1/accounts/by-riot-id/" . $name . "/" . $tag;
        $url = $baseUrl . '?api_key=' . $this->apiKey;
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $puuid = ($data['puuid']);

        $baseUrl = "https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-puuid/" . $puuid;
        $url = $baseUrl . '?api_key=' . $this->apiKey;
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $id = $data['id'];



        $baseUrl = "https://euw1.api.riotgames.com/lol/league/v4/entries/by-summoner/" . $id;
        $url = $baseUrl . '?api_key=' . $this->apiKey;
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $infoinvocador = $data;

        return $infoinvocador;
    }
    public function getPartidas(string $name, string $tag): array
    {
        $baseUrl = "https://europe.api.riotgames.com/riot/account/v1/accounts/by-riot-id/" . $name . "/" . $tag;
        $url = $baseUrl . '?api_key=' . $this->apiKey;
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $puuid = ($data['puuid']);
        //me interesa queueType, tier, rank, summonername, leaguePoints, wins, losses.
        $baseUrl = "https://europe.api.riotgames.com/lol/match/v5/matches/by-puuid/" . $puuid . "/ids?start=0&count=10";
        $url = $baseUrl . '&api_key=' . $this->apiKey;
        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();
        $ids = $data;
        $partidas = [];

        foreach ($ids as $partidaId) {
            $baseUrl = "https://europe.api.riotgames.com/lol/match/v5/matches/"  . $partidaId;
            $url = $baseUrl . '?api_key=' . $this->apiKey;
            $response = $this->httpClient->request('GET', $url);
            $data = $response->toArray();
            $partidas[] = $data;
        }

        return $partidas;
    }
}
