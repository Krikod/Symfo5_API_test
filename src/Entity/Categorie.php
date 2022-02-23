<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]

/**
 * @ORM\Entity
 * @ORM\Table(name="categorie")
 */
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"get"})
     */
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    /**
     * @ORM\Column(type="string")
     * @Groups({"get"})
     */
    private $nom;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Annonce::class)]
	/**
	 * @var ArrayCollection
	 *
	 * @ORM\Column(type="string")
	 * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="categorie")
	 *
	 */
    private $annonces;

	/**
	 * Categorie constructor.
	 */
    public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Annonce[]
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

	/**
	 * @param Annonce $annonce
	 *
	 * @return Categorie
	 */
    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->setCategorie($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getCategorie() === $this) {
                $annonce->setCategorie(null);
            }
        }

        return $this;
    }
}
