<?php

namespace App\EntityListener;

use App\Entity\Animal;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, entity: Animal::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Animal::class)]
class AnimalEntityListener
{

    public function __construct(private readonly SluggerInterface $slugger)
    {

    }

    public function prePersist(Animal $animal, LifecycleEventArgs $args): void
    {
        $animal->computeSlug($this->slugger);
    }

    public function preUpdate(Animal $animal, LifecycleEventArgs $args): void
    {
        if ($animal->getSlug() === '') {
            $animal->computeSlug($this->slugger);
        }
    }
}