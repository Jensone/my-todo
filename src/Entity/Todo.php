<?php

namespace App\Entity;

use App\Repository\TodoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TodoRepository::class)]
class Todo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    private ?string $task = null;

    #[ORM\Column(length: 10)]
    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['low', 'medium', 'high'])]
    private ?string $priority = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank]
    #[Assert\Date]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Type(type: 'bool')]
    private ?bool $completion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTask(): ?string
    {
        return $this->task;
    }

    public function setTask(string $task): self
    {
        $this->task = $task;

        return $this;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function isCompletion(): ?bool
    {
        return $this->completion;
    }

    public function setCompletion(bool $completion): self
    {
        $this->completion = $completion;

        return $this;
    }
}
