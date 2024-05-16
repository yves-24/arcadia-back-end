<?php

namespace App\Controller;

use App\Entity\Advice;
use App\Form\AdviceFormType;
use App\Repository\AdviceRepository;
use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'arcadia_home')]
    public function index(
        AnimalRepository       $animalRepository,
        HabitatRepository      $habitatRepository,
        ServiceRepository      $serviceRepository,
        AdviceRepository       $adviceRepository,
        Request                $request,
        EntityManagerInterface $manager
    ): Response
    {
        $animals = $animalRepository->findAll();
        $habitats = $habitatRepository->findAll();
        $services = $serviceRepository->getLastThreeServices();
        $advices = $adviceRepository->getLatestAdvices();

        $advice = new Advice();
        $adviceForm = $this->createForm(AdviceFormType::class, $advice);
        $adviceForm->handleRequest($request);
        if ($adviceForm->isSubmitted() && $adviceForm->isValid()) {
            $manager->persist($advice);
            $manager->flush();
            return $this->redirectToRoute('arcadia_home', ['_fragment' => 'a-testimonials']);
        }

        return $this->render('home/index.html.twig', [
            'animals' => $animals,
            'habitats' => $habitats,
            'services' => $services,
            'advices' => $advices,
            'adviceForm' => $adviceForm->createView(),
        ]);
    }
}
