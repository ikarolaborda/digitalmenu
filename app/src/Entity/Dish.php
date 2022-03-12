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
    public $dish_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $dish_description;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="dish")
     */
    private $category;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImagePath()
    {
        return '/public/images/'.$this->getImage();
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }
}
