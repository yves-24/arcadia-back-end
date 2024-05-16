<?php

namespace App\Entity;

use App\Repository\HealthStateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HealthStateRepository::class)]
class HealthState
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $state = null;

    /**
     * @var Collection<int, VetReport>
     */
    #[ORM\OneToMany(targetEntity: VetReport::class, mappedBy: 'healthState')]
    private Collection $vetReports;

    public function __construct()
    {
        $this->vetReports = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->state;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): static
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection<int, VetReport>
     */
    public function getVetReports(): Collection
    {
        return $this->vetReports;
    }

    public function addVetReport(VetReport $vetReport): static
    {
        if (!$this->vetReports->contains($vetReport)) {
            $this->vetReports->add($vetReport);
            $vetReport->setHealthState($this);
        }

        return $this;
    }

    public function removeVetReport(VetReport $vetReport): static
    {
        if ($this->vetReports->removeElement($vetReport)) {
            // set the owning side to null (unless already changed)
            if ($vetReport->getHealthState() === $this) {
                $vetReport->setHealthState(null);
            }
        }

        return $this;
    }
}
