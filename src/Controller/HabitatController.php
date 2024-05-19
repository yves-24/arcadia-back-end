<?php

namespace App\Controller;

use App\Entity\Habitat;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HabitatController extends AbstractController
{
    #[Route('/habitats', name: 'arcadia_habitats')]
    public function index(Request $request, HabitatRepository $habitatRepository): Response
    {
        return $this->render('habitat/index.html.twig', [
            'habitats' => $habitatRepository->getPaginatedHabitats($request->query->get('page', 1)),
        ]);
    }

    #[Route('/habitat/{slug}', 'arcadia_single_habitat')]
    public function habitat(Habitat $habitat): Response
    {
        return $this->render('habitat/habitat.html.twig', [
            'habitat' => $habitat,
        ]);

    }
}
