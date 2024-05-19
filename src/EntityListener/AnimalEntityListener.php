<?php

namespace App\EntityListener;

use App\Document\ViewCount;
use App\Entity\Animal;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, entity: Animal::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Animal::class)]
class AnimalEntityListener
{

    public function __construct(private readonly SluggerInterface $slugger, private readonly DocumentManager $documentManager)
    {

    }

    public function prePersist(Animal $animal, LifecycleEventArgs $args): void
    {
        $viewCount = new ViewCount();
        $viewCount->setCount(0);
        $viewCount->setAnimal($animal->getFirstname());
        $this->documentManager->persist($viewCount);
        $this->documentManager->flush();
        $animal->computeSlug($this->slugger);
    }

    public function preUpdate(Animal $animal, LifecycleEventArgs $args): void
    {
        if ($animal->getSlug() === '') {
            $animal->computeSlug($this->slugger);
        }
    }
}