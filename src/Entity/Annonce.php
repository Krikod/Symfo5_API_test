<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]

/**
 * @ORM\Entity
 * @ORM\Table(name="annonce")
 */
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 * @Groups("annonce:read")
	 */
	private $id;

    #[ORM\Column(type: 'string', length: 255)]
	/**
	 * @ORM\Column(type="string")
	 * @Groups("annonce:read")
	 */
	private $titre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
	/**
	 * @ORM\Column(type="string")
	 * @Groups("annonce:read")
	 */
	private $marque;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
	/**
	 * @ORM\Column(type="string")
	 * @Groups("annonce:read")
	 */
	private $modele;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'annonces')]
    #[ORM\JoinColumn(nullable: false)]
	/**
	 * @ORM\Column(type="string")
	 * @Groups("annonce:read")
	 */
	private $categorie;

    #[ORM\Column(type: 'text')]
	/**
	 * @ORM\Column(type="string")
	 * @Groups("annonce:read")
	 */
	private $contenu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(?string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }
}
