<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    #[Assert\Length(min:2, max:50)]
    private ?string $fullname = null;

     /**
     * @ORM\Column(type="integer")
     */
    private ?int $telephone = null;

     /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    #[Assert\Length(min:2, max:50)]
    private ?string $ville = null;

    /**
     * @ORM\Column(type="string", length=200)
     */
    #[Assert\Email()]
    #[Assert\Length(min:2, max:200)]
    private string $email;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    #[Assert\Length(min:2, max:150)]
    private ?string $subject = null;

    /**
     * @ORM\Column(type="text")
     */
    #[Assert\NotBlank()]
    private string $message;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $entreprise;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(?string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(?string $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
