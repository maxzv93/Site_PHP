<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeviceRepository")
 */
class Device
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="integer")
     */
    private $memorySize;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    private $brand;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $display;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDelete;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getMemorySize(): ?int
    {
        return $this->memorySize;
    }

    public function setMemorySize(int $memorySize): self
    {
        $this->memorySize = $memorySize;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getBrand(): ?ShopUser
    {
        return $this->brand;
    }

    public function setBrand(?ShopUser $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getDisplay(): ?string
    {
        return $this->display;
    }

    public function setDisplay(?string $display): self
    {
        $this->display = $display;

        return $this;
    }

    public function getIsDelete(): ?bool
    {
        return $this->isDelete;
    }

    public function setIsDelete(?bool $isDelete): self
    {
        $this->isDelete = $isDelete;

        return $this;
    }
}
