<?php

namespace App\EntityListener;

use App\Entity\Habitat;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, entity: Habitat::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Habitat::class)]
class HabitatEntityListener
{

    public function __construct(private readonly SluggerInterface $slugger)
    {

    }

    public function prePersist(Habitat $habitat, LifecycleEventArgs $args): void
    {
        $habitat->computeSlug($this->slugger);
    }

    public function preUpdate(Habitat $habitat, LifecycleEventArgs $args): void
    {
        if ($habitat->getSlug() === '') {
            $habitat->computeSlug($this->slugger);
        }
    }
}