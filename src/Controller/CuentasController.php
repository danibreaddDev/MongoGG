<?php

namespace App\Controller;

use App\Entity\Cuentas;
use App\Form\CuentasType;
use App\Repository\CuentasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cuentas')]
class CuentasController extends AbstractController
{
    const ELEMENTOS_POR_PAGINA = 10;
    #[Route('/{pagina}', name: 'app_cuentas_index', defaults: ['pagina' => 1], requirements: ['pagina' => '\d+'], methods: ['GET'])]
    public function index(int $pagina,CuentasRepository $cuentasRepository): Response
    {
        return $this->render('cuentas/index.html.twig', [
            'cuentas' => $cuentasRepository->buscarTodas($pagina,self::ELEMENTOS_POR_PAGINA),
            'pagina'=>$pagina,
        ]);
    }

    #[Route('/new', name: 'app_cuentas_new', methods: ['GET', 'POST'])]
    public function new(Security $security,Request $request, EntityManagerInterface $entityManager): Response
    {
        $cuenta = new Cuentas();

        $form = $this->createForm(CuentasType::class, $cuenta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cuenta->setUsuario($security->getUser());
            $entityManager->persist($cuenta);
            $entityManager->flush();

            return $this->redirectToRoute('app_cuentas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cuentas/new.html.twig', [
            'cuenta' => $cuenta,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cuentas_show', methods: ['GET'])]
    public function show(Cuentas $cuenta): Response
    {
        return $this->render('cuentas/show.html.twig', [
            'cuenta' => $cuenta,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cuentas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cuentas $cuenta, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CuentasType::class, $cuenta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cuentas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cuentas/edit.html.twig', [
            'cuenta' => $cuenta,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cuentas_delete', methods: ['POST'])]
    public function delete(Request $request, Cuentas $cuenta, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cuenta->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($cuenta);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cuentas_index', [], Response::HTTP_SEE_OTHER);
    }
}
