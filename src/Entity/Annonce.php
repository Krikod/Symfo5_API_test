<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]

/**
 * Class Annonce
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 * @ORM\Table(name="annonce", indexes={@ORM\Index(name="search_idx", columns={"modele"}, flags={"fulltext"})})
 *
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
     * @Groups({"get", "search"})
     */
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Le titre est obligatoire")
     * @Groups({"get"})
     *
     */
    private $titre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    /**
     * @ORM\Column(type="string")
     * @Groups({"get", "search"})
     *
     */
    private $marque;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    /**
     * @ORM\Column(type="string")
     * @Groups({"get", "search"})
     */
    private $modele;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'annonces', cascade:['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    /**
     * @ORM\JoinColumn(nullable=false)
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="annonces", cascade={"persist"})
     * @Assert\NotBlank(message="La catégorie est obligatoire")
     * @Groups({"get"})
     */
    private $categorie;

    #[ORM\Column(type: 'text')]
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Le contenu est obligatoire")
     * @Groups({"get"})
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
