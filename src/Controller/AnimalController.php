<?php

namespace App\Controller;

use App\Document\ViewCount;
use App\Entity\Animal;
use App\Repository\AnimalRepository;
use App\Repository\ServiceRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\MongoDBException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnimalController extends AbstractController
{
    #[Route('/animals', name: 'arcadia_animals')]
    public function index(Request $request, AnimalRepository $animalRepository): Response
    {
        return $this->render('animal/index.html.twig', [
            'animals' => $animalRepository->getPaginatedAnimals($request->query->get('page', 1)),
        ]);
    }

    /**
     * @throws MongoDBException
     */
    #[Route('/animal/{slug}', name: 'arcadia_animal_single')]
    public function animalSingle(Animal $animal, ServiceRepository $serviceRepository, DocumentManager $documentManager): Response
    {
        $mongoDBAnimal = $documentManager->getRepository(ViewCount::class)->findOneBy(['animal' => $animal->getFirstname()]);
        $actualCounter = (int) $mongoDBAnimal->getCount();
        $mongoDBAnimal->setCount($actualCounter + 1);
        $documentManager->persist($mongoDBAnimal);
        $documentManager->flush();
        return $this->render('animal/single.html.twig', [
            'animal' => $animal,
            'services' => $serviceRepository->getLastThreeServices(),
            'mongoDBAnimal' => $documentManager->getRepository(ViewCount::class)->findOneBy(['animal' => $animal->getFirstname()]),
        ]);
    }
}
