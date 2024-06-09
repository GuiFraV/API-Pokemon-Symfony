<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PokemonRepository;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Groups(["list", "detail"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(["list", "detail"])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Groups(["list", "detail"])]
    private ?string $type1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Serializer\Groups(["list", "detail"])]
    private ?string $type2 = null;

    #[ORM\Column]
    #[Serializer\Groups(["list", "detail"])]
    private ?int $total = null;

    #[ORM\Column]
    #[Serializer\Groups(["list", "detail"])]
    private ?int $hp = null;

    #[ORM\Column]
    #[Serializer\Groups(["list", "detail"])]
    private ?int $attack = null;

    #[ORM\Column]
    #[Serializer\Groups(["list", "detail"])]
    private ?int $defense = null;

    #[ORM\Column]
    #[Serializer\Groups(["list", "detail"])]
    private ?int $sp_atk = null;

    #[ORM\Column]
    #[Serializer\Groups(["list", "detail"])]
    private ?int $sp_def = null;

    #[ORM\Column]
    #[Serializer\Groups(["list", "detail"])]
    private ?int $speed = null;

    #[ORM\Column]
    #[Serializer\Groups(["list", "detail"])]
    private ?int $generation = null;

    #[ORM\Column]
    #[Serializer\Groups(["list", "detail"])]
    private ?bool $legendary = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Serializer\Groups(["list", "detail"])]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Serializer\Groups(["list", "detail"])]
    private ?\DateTimeInterface $updated_at = null;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType1(): ?string
    {
        return $this->type1;
    }

    public function setType1(string $type1): static
    {
        $this->type1 = $type1;

        return $this;
    }

    public function getType2(): ?string
    {
        return $this->type2;
    }

    public function setType2(?string $type2): static
    {
        $this->type2 = $type2;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): static
    {
        $this->hp = $hp;

        return $this;
    }

    public function getAttack(): ?int
    {
        return $this->attack;
    }

    public function setAttack(int $attack): static
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): static
    {
        $this->defense = $defense;

        return $this;
    }

    public function getSpAtk(): ?int
    {
        return $this->sp_atk;
    }

    public function setSpAtk(int $sp_atk): static
    {
        $this->sp_atk = $sp_atk;

        return $this;
    }

    public function getSpDef(): ?int
    {
        return $this->sp_def;
    }

    public function setSpDef(int $sp_def): static
    {
        $this->sp_def = $sp_def;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): static
    {
        $this->speed = $speed;

        return $this;
    }

    public function getGeneration(): ?int
    {
        return $this->generation;
    }

    public function setGeneration(int $generation): static
    {
        $this->generation = $generation;

        return $this;
    }

    public function isLegendary(): ?bool
    {
        return $this->legendary;
    }

    public function setLegendary(bool $legendary): static
    {
        $this->legendary = $legendary;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
