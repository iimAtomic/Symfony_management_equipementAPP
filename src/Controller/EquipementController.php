<?php

namespace App\Controller;


use App\Entity\Equipement;
use App\Repository\EquipementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipementController extends AbstractController
{
    /**
     * @Route("/equipement", name="app_equipement")
     */
    public function index(EquipementRepository $repo): Response
    {


        $map = array_map(function ($e) {
            return [
                'id' => $e ->getId(),
                'nom' => $e->getNom(),
                'quantite' => $e->getQuantite()
            ];
        }, $repo->findAll());

        return $this->render('equipement/index.html.twig', [
            'entries' => $map
        ]);
    }

    /**
     * @Route("/equipement/{id}", name="app_equipement_info")
     */
    public function info(Request $request, EquipementRepository $repo, int $id): Response
    {
        $entry = $repo->find($id);
        if ($entry !== null) {
            return $this->render("equipement/info.html.twig", [
                'entry' => [
                    'nom' => $entry->getNom(),
                    'quantite' => $entry->getQuantite(),
                    'description' => $entry->getDescription(),
                    'prix' => $entry->getPrix()/100,
                    'marque' => $entry->getMarque()
                ]
            ]);

        }
        return new Response('equipement introuvable', 404);


    }
}
