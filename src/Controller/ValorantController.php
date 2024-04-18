<?php

namespace App\Controller;

use App\Service\ValorantApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ValorantController extends AbstractController
{
    private $ValorantApi;
    public function __construct(ValorantApiService $ValorantApi)
    {
        $this->ValorantApi = $ValorantApi;
    }
    #[Route('/valorant', name: 'app_valorant')]
    public function index(): Response
    {
        return $this->render('valorant/index.html.twig', [
            'controller_name' => 'ValorantController',
        ]);
    }
    #[Route('/valorant/agentes', name: 'app_valorant_agentes')]
    public function getListAgentes(): Response
    {
        $infoAgentes = $this->ValorantApi->getListAgentes();
        return $this->render('valorant/ListadoAgentes.html.twig', [
            'agentes' => $infoAgentes,
        ]);
    }
    #[Route('/valorant/mapas', name: 'app_valorant_mapas')]
    public function getListMapas(): Response
    {
        $infoMapas = $this->ValorantApi->getListMapas();
        return $this->render('valorant/ListadoMapas.html.twig', [
            'mapas' => $infoMapas,
        ]);
    }
    #[Route('/valorant/armas', name: 'app_valorant_armas')]
    public function getListArmas(): Response
    {
        $infoArmas = $this->ValorantApi->getListArmas();
        $infoEscudos = $this->ValorantApi->getEscudos();
        return $this->render('valorant/ListadoArmas.html.twig', [
            'armas' => $infoArmas,
            'escudos' => $infoEscudos
        ]);
    }
    #[Route('/valorant/skins', name: 'app_valorant_skins')]
    public function getListSkins(): Response
    {
        $infoSkins = $this->ValorantApi->getSkins();
        return $this->render('valorant/ListadoSkins.html.twig', [
            'skins' => $infoSkins,
        ]);
    }
    #[Route('/valorant/tarjetas', name: 'app_valorant_tarjetas')]
    public function getListTarjetas(): Response
    {
        $infoTarjetas = $this->ValorantApi->getTarjetas();
        return $this->render('valorant/ListadoTarjetas.html.twig', [
            'tarjetas' => $infoTarjetas,
        ]);
    }
    #[Route('/valorant/tarjetasTall', name: 'app_valorant_tarjetasTall')]
    public function getListTarjetasTall(): Response
    {
        $infoTarjetas = $this->ValorantApi->getTarjetas();
        return $this->render('valorant/TarjetasTall.html.twig', [
            'tarjetas' => $infoTarjetas,
        ]);
    }
    #[Route('/valorant/tarjetasWide', name: 'app_valorant_tarjetasWide')]
    public function getListTarjetasWide(): Response
    {
        $infoTarjetas = $this->ValorantApi->getTarjetas();
        return $this->render('valorant/TarjetasWide.html.twig', [
            'tarjetas' => $infoTarjetas,
        ]);
    }
    #[Route('/valorant/tarjetasIcon', name: 'app_valorant_tarjetasIcon')]
    public function getListTarjetasIcon(): Response
    {
        $infoTarjetas = $this->ValorantApi->getTarjetas();
        return $this->render('valorant/TarjetasIcon.html.twig', [
            'tarjetas' => $infoTarjetas,
        ]);
    }
    #[Route('/valorant/llaveros', name: 'app_valorant_llaveros')]
    public function getListLlaveros(): Response
    {
        $infoLlaveros = $this->ValorantApi->getLlaveros();
        return $this->render('valorant/listadoLlaveros.html.twig', [
            'llaveros' => $infoLlaveros,
        ]);
    }
    #[Route('/valorant/grafitis', name: 'app_valorant_grafitis')]
    public function getListGrafitis(): Response
    {
        $infoGrafitis = $this->ValorantApi->getGrafitis();
        return $this->render('valorant/ListadoGrafitis.html.twig', [
            'grafitis' => $infoGrafitis,
        ]);
    }
    #[Route('/valorant/modosDeJuego', name: 'app_valorant_modosJuego')]
    public function getModosDeJuego(): Response
    {
        $infoModos = $this->ValorantApi->getModosJuego();
        return $this->render('valorant/ListadoModosJuego.html.twig', [
            'modos' => $infoModos,
        ]);
    }
    #[Route('/valorant/rangos', name: 'app_valorant_rangos')]
    public function getRangos(): Response
    {
        $infoRangos = $this->ValorantApi->getRangos();
        return $this->render('valorant/ListadoRangos.html.twig', [
            'rangos' => $infoRangos,
        ]);
    }
    #[Route('/valorant/ceremonias', name: 'app_valorant_ceremonias')]
    public function getCeremonias(): Response
    {
        $infoceremonias = $this->ValorantApi->getCeremonias();
        return $this->render('valorant/ListadoCeremonies.html.twig', [
            'ceremonias' => $infoceremonias,
        ]);
    }
    #[Route('/valorant/skinsLevel', name: 'app_valorant_nivelskins')]
    public function getNivelSkins(): Response
    {
        $infocontenido = $this->ValorantApi->getStrangeSkins();
        return $this->render('valorant/ListadoRarezaSkins.html.twig', [
            'contenido' => $infocontenido,
        ]);
    }
    #[Route('/valorant/currencies', name: 'app_valorant_currencies')]
    public function getCurrencies(): Response
    {
        $infomonedas = $this->ValorantApi->getMonedas();
        return $this->render('valorant/ListadoMoneda.html.twig', [
            'monedas' => $infomonedas,
        ]);
    }
    #[Route('/valorant/events', name: 'app_valorant_events')]
    public function getEvents(): Response
    {
        $infoEventos = $this->ValorantApi->getEventos();
        return $this->render('valorant/ListadoEventos.html.twig', [
            'eventos' => $infoEventos,
        ]);
    }
    #[Route('/valorant/borders', name: 'app_valorant_borders')]
    public function getBorders(): Response
    {
        $infoBorders = $this->ValorantApi->getBordesNivel();
        return $this->render('valorant/ListadoBordes.html.twig', [
            'bordes' => $infoBorders,
        ]);
    }
    #[Route('/valorant/titles', name: 'app_valorant_titles')]
    public function getTitles(): Response
    {
        $infotitles = $this->ValorantApi->getTitulos();
        return $this->render('valorant/ListadoTitulos.html.twig', [
            'titulos' => $infotitles,
        ]);
    }
    #[Route('/valorant/seasons', name: 'app_valorant_seasons')]
    public function getSeasons(): Response
    {
        $infoSeasons = $this->ValorantApi->getTemporadas();
        return $this->render('valorant/ListadoTemporadas.html.twig', [
            'temporadas' => $infoSeasons,
        ]);
    }
}
