<?php

namespace App\Entity;

use App\Repository\DishRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DishRepository::class)
 */
class Dish
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dish_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dish_description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDishName(): ?string
    {
        return $this->dish_name;
    }

    public function setDishName(string $dish_name): self
    {
        $this->dish_name = $dish_name;

        return $this;
    }

    public function getDishDescription(): ?string
    {
        return $this->dish_description;
    }

    public function setDishDescription(?string $dish_description): self
    {
        $this->dish_description = $dish_description;

        return $this;
    }
}
