<?php

declare(strict_types = 1);

namespace App\Entity;

use App\Repository\AuthorTranslationRepository;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

/**
 * Class AuthorTranslation
 * @package App\Entity
 * @ORM\Entity(repositoryClass=AuthorTranslationRepository::class)
 */
class AuthorTranslation implements TranslationInterface
{
    use TranslationTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return AuthorTranslation
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
