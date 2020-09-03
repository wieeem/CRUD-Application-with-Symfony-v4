<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlimentRepository")
 * @Vich\Uploadable
 */
class Aliment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3,max=15,minMessage="Le nom doit faire 3 caracteres minumun",maxMessage="Le nom doit faire moins de 15 caracteres")
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(min=0.1,max=100,minMessage = "Le prix doit etre superieure a 0.1",maxMessage = "Le prix doit etre inférieure a 100")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;
    /**
     * @Vich\UploadableField(mapping="aliment_image", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="integer")
     */
    private $calorie;

    /**
     * @ORM\Column(type="float")
     */
    private $proteine;

    /**
     * @ORM\Column(type="float")
     */
    private $glucide;

    /**
     * @ORM\Column(type="float")
     */
    private $lipide;

  

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="aliments")
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $uploaded_at;



    public function setImageFile(?File $imageFile = null) : self
    {
        $this->imageFile = $imageFile;
        
        if ($this->imageFile instanceof UploadedFile) {
             $this->uploaded_at =new \DateTime('now');
        }
        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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

    public function getCalorie(): ?int
    {
        return $this->calorie;
    }

    public function setCalorie(int $calorie): self
    {
        $this->calorie = $calorie;

        return $this;
    }

    public function getProteine(): ?float
    {
        return $this->proteine;
    }

    public function setProteine(float $proteine): self
    {
        $this->proteine = $proteine;

        return $this;
    }

    public function getGlucide(): ?float
    {
        return $this->glucide;
    }

    public function setGlucide(float $glucide): self
    {
        $this->glucide = $glucide;

        return $this;
    }

    public function getLipide(): ?float
    {
        return $this->lipide;
    }

    public function setLipide(float $lipide): self
    {
        $this->lipide = $lipide;

        return $this;
    }

   

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUploadedAt(): ?\DateTimeInterface
    {
        return $this->uploaded_at;
    }

    public function setUploadedAt(\DateTimeInterface $uploaded_at): self
    {
        $this->uploaded_at = $uploaded_at;

        return $this;
    }

   
   


  
}
