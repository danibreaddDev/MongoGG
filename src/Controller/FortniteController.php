<?php

namespace App\Controller;

use App\Service\FortniteApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FortniteController extends AbstractController
{
    private $fortniteApi;
    public function __construct(FortniteApiService $fortniteApi)
    {
        $this->fortniteApi = $fortniteApi;
    }
    #[Route('/fortnite', name: 'app_fortnite')]
    public function index(): Response
    {
        return $this->render('fortnite/index.html.twig', [
            'controller_name' => 'FortniteController',
        ]);
    }
    #[Route('/fortnite/banners', name: 'app_fortnite_banners')]
    public function getBanners(): Response
    {
        $infoBanners = $this->fortniteApi->getBanners();
        return $this->render('fortnite/Banners.html.twig', [
            'banners' => $infoBanners,
        ]);
    }
    #[Route('/fortnite/cosmetics', name: 'app_fortnite_cosmetics')]
    public function getCosmetics(): Response
    {
        $infoCosmetics = $this->fortniteApi->getCosmetics();
        return $this->render('fortnite/Cosmetics.html.twig', [
            'cosmetics' => $infoCosmetics,
        ]);
    }
    #[Route('/fortnite/creatorCodes', name: 'app_fortnite_creatorcode')]
    public function viewCreatorCode(): Response
    {
        return $this->render('fortnite/CreatorsCode.html.twig', [
            'codes' => 'code',
        ]);
    }
    #[Route('/fortnite/creatorCodesfilter', name: 'app_fortnite_creatorcode_filter')]
    public function getCreatorCodes_filter(Request $request): Response
    {
        $name = $request->query->get('name');

        $infocreator = $this->fortniteApi->getCodes($name);
        return $this->render('fortnite/AjaxcreatorsCode.html.twig', [
            'creator' => $infocreator,
        ]);
    }
    #[Route('/fortnite/map', name: 'app_fortnite_map')]
    public function getMap(): Response
    {

        $infoMap = $this->fortniteApi->getMap();
        return $this->render('fortnite/Map.html.twig', [
            'map' => $infoMap,
        ]);
    }
    #[Route('/fortnite/news', name: 'app_fortnite_news')]
    public function getNews(): Response
    {

        $infoNews = $this->fortniteApi->getNews();
        return $this->render('fortnite/News.html.twig', [
            'news' => $infoNews,
        ]);
    }
    #[Route('/fortnite/playlists', name: 'app_fortnite_playlists')]
    public function getPlaylists(): Response
    {

        $infoPlaylists = $this->fortniteApi->getPlaylists();
        return $this->render('fortnite/Playlists.html.twig', [
            'playlists' => $infoPlaylists,
        ]);
    }
    #[Route('/fortnite/shop', name: 'app_fortnite_shop')]
    public function getShop(): Response
    {

        $infoShop = $this->fortniteApi->getShop();
        return $this->render('fortnite/Shop.html.twig', [
            'shops' => $infoShop,
        ]);
    }
    #[Route('/fortnite/stats/', name: 'app_fortnite_stats')]
    public function getStatsByPlayer(Request $request): Response
    {
        $name = $request->query->get('name');

        $infoPlayer = $this->fortniteApi->getStatsByPlayer($name);
        return $this->render('fortnite/Player.html.twig', [
            'player' => $infoPlayer,
        ]);
    }
}
