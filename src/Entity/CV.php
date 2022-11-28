<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;

#[Entity]
#[HasLifecycleCallbacks]
class CV
{
    #[Id]
    #[GeneratedValue(strategy: 'AUTO')]
    #[Column(type: 'integer')]
    private int $id;

    #[Column(type: 'string')]
    private string $position;

    #[ManyToOne(targetEntity: Candidate::class, inversedBy: 'cv')]
    private Candidate $candidate;

    #[OneToMany(targetEntity: Reaction::class, mappedBy: 'cv')]
    private Collection $reactions;

    #[ManyToMany(targetEntity: Company::class, mappedBy: 'cvs')]
    private Collection $companies;

    #[Column(type: 'text')]
    private string $text;

    #[Column(type: 'string')]
    private string $file;

    #[Column(type: 'datetime')]
    private \DateTime $createdAt;

    #[Column(type: 'datetime')]
    private \DateTime $updatedAt;

    #[Column(type: 'boolean', options:  ['{default:1}'])]
    private bool $isActive;

    public function __construct()
    {
        $this->reactions = new ArrayCollection();
        $this->companies = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     * @return self
     */
    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return Candidate
     */
    public function getCandidate(): Candidate
    {
        return $this->candidate;
    }

    /**
     * @param Candidate $candidate
     * @return self
     */
    public function setCandidate(Candidate $candidate): self
    {
        $this->candidate = $candidate;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getReactions(): ArrayCollection
    {
        return $this->reactions;
    }

    public function addReaction(Reaction $reaction) {
        if (!$this->reactions->contains($reaction)) {
            $this->reactions[] = $reaction;
            $reaction->setCv($this);
        }

        return $this;
    }

    public function removeReaction(Reaction $reaction) {
        if ($this->reactions->contains($reaction)) {
            $this->reactions->removeElement($reaction);
            if ($reaction->getCv() === $this) {
                $reaction->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return self
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @param string $file
     * @return self
     */
    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return self
     */
    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return self
     */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    #[PrePersist]
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    #[PreUpdate]
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return Collection
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    /**
     * @param Company $company
     */
    public function addCompany(Company $company): self
    {
        $this->companies->add($company);

        return $this;
    }


}
