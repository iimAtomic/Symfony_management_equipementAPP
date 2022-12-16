<?php

namespace App\Controller;

use App\Entity\Equipement;
use App\Repository\EquipementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormulairesubmitController extends AbstractController
{
    /**
     * @Route("/formulaire/submit", name="app_formulairesubmit", methods={"POST"})
     */
    public function index(Request $req, EquipementRepository $repo): Response
    {
        try {
            $e = new Equipement();
            $e->setMarque($req->request->get('marque'));
            $e->setNom($req->request->get('nom'));
            $e->setDescription($req->request->get('description'));
            $e->setPrix($req->request->get('prix') * 100);
            $e->setQuantite($req->request->get('quantite'));
            $repo->add($e, true);

            return $this->render('formulaire/index.html.twig', [
                'statut' => 'success',
            ]);
        }
        catch (\Exception $e){
            return $this->render('formulaire/index.html.twig', [
                'statut' => 'danger'
            ]);
        }

    }
}
