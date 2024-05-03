<?php

namespace App\Controller;

use App\Service\LolApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LeagueOfLegendsController extends AbstractController
{
    private $LolApi;
    private $id;
    private $tag;
    public function __construct(LolApiService $LolApi)
    {
        $this->LolApi = $LolApi;
    }
    #[Route('/leagueoflegends', name: 'app_league_of_legends')]
    public function index(): Response
    {
        return $this->render('league_of_legends/index.html.twig', [
            'controller_name' => 'LeagueOfLegendsController',
        ]);
    }
    #[Route('/leagueoflegends/campeones', name: 'app_league_of_legends_campeones')]
    public function getListCampeones(): Response
    {
        $infoCampeones = $this->LolApi->getListCampeones();
        return $this->render('league_of_legends/listadoCampeones.html.twig', [
            'campeones' => $infoCampeones,
        ]);
    }
    #[Route('/leagueoflegends/campeonesrotacion', name: 'app_league_of_legends_campeones_rotacion')]
    public function getListCampeonesRotacion(): Response
    {
        $infoCampeonesRotacion = $this->LolApi->getListCampeonesRotacion();
        return $this->render('league_of_legends/listadoCampeonesRotacion.html.twig', [
            'campeonesRotacion' => $infoCampeonesRotacion,
        ]);
    }
    #[Route('/leagueoflegends/clasificaciones', name: 'app_league_of_legends_clasificaciones')]
    public function muestraPaginaClasificaciones(): Response
    {
        return $this->render('league_of_legends/clasificaciones.html.twig', [
            'clasificaciones' => "clasificaciones",
        ]);
    }
    #[Route('/leagueoflegends/clasificacionesfiltradas', name: 'app_league_of_legends_clasificaciones_filtradas')]
    public function getClasificacionesFiltradas(Request $request): Response
    {
        $tier = $request->query->get('tier-select');
        if ($tier === "CHALLENGER" || $tier === "GRANDMASTER" || $tier === "MASTER") {
            $division = "I";
        } else {
            $division = $request->query->get('division-select');
        }
        $queue = $request->query->get('queue-select');
        $infoClasificaciones = $this->LolApi->getListDivision($division, $tier, $queue);
        //recuperar la info
        return $this->render('league_of_legends/AjaxclasificacionesTabla.html.twig', [
            'tablaclasificaciones' => $infoClasificaciones,
        ]);
    }
    #[Route('/leagueoflegends/summonername/{nombre}&{tag}', name: 'app_league_of_legends_summonername')]
    public function getInfoSummoner(Request $request, $nombre,$tag): Response
    {
        $this->LolApi->setName($nombre);
        $this->LolApi->setTag($tag);
        $this->id = $this->LolApi->getName();
        $this->tag = $this->LolApi->getTag();

        //me interesa queueType, tier, rank, summonername, leaguePoints, wins, losses.
        $infoSummoner = $this->LolApi->getInfoSummoners($this->LolApi->getName(), $this->LolApi->getTag());

        //recuperar la info
        return $this->render('league_of_legends/summoner.html.twig', [
            'summoner' => $infoSummoner,
        ]);
    }
    #[Route('/leagueoflegends/partidas/{name}&{tag}', name: 'app_league_of_legends_partidas')]
    public function getInfoPartida($name,$tag): Response
    {
        $this->LolApi->setName($name);
        $this->LolApi->setTag($tag);
        $infoPartidas = $this->LolApi->getPartidas($this->LolApi->getName(), $this->LolApi->getTag());
        //recuperar la info
        return $this->render('league_of_legends/Partidas.html.twig', [
            'partidas' => $infoPartidas,
        ]);
    }
}
