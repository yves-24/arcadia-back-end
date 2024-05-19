<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document]
class ViewCount
{
    #[MongoDB\Id]
    protected string $id;

    #[MongoDB\Field(type: 'int')]
    protected int $count = 0;

    #[MongoDB\Field(type: 'string')]
    protected string $animal;

    /**
     * @return string
     */
    public function getAnimal(): string
    {
        return $this->animal;
    }

    /**
     * @param string $animal
     * @return ViewCount
     */
    public function setAnimal(string $animal): ViewCount
    {
        $this->animal = $animal;
        return $this;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return ViewCount
     */
    public function setId(string $id): ViewCount
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return ViewCount
     */
    public function setCount(int $count): ViewCount
    {
        $this->count = $count;
        return $this;
    }

}