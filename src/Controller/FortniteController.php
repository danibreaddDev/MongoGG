<?php

namespace App\Controller;

use App\Service\FortniteApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
