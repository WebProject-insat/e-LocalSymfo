<?php

namespace App\Entity;

use App\Repository\AnnouncementRepository;
use Doctrine\DBAL\Types\BlobType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=AnnouncementRepository::class)
 */
class Announcement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $roomNb;

    /**
     * @ORM\Column(type="float")
     */
    private $surface;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $furnished;

    /**
     * @ORM\Column(type="date")
     */
    private $AvailabilityDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Smoker;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxRoomates;

    /**
     * @ORM\Column(type="boolean")
     */
    private $balcon;

    /**
     * @ORM\Column(type="boolean")
     */
    private $garden;

    /**
     * @ORM\Column(type="boolean")
     */
    private $garage;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="announcements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $locatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="owner")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserOwner;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="coloc", cascade={"persist", "remove"})
     */
    private $userColoc;

    /**
     * @ORM\Column(type="blob")
     */
    private $images = null;

    /**
     * @ORM\Column(type="datetime")
     */
    private $postedAt;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomNb(): ?int
    {
        return $this->roomNb;
    }

    public function setRoomNb(int $roomNb): self
    {
        $this->roomNb = $roomNb;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFurnished(): ?bool
    {
        return $this->furnished;
    }

    public function setFurnished(bool $furnished): self
    {
        $this->furnished = $furnished;

        return $this;
    }

    public function getAvailabilityDate(): ?\DateTimeInterface
    {
        return $this->AvailabilityDate;
    }

    public function setAvailabilityDate(\DateTimeInterface $AvailabilityDate): self
    {
        $this->AvailabilityDate = $AvailabilityDate;

        return $this;
    }

    public function getSmoker(): ?bool
    {
        return $this->Smoker;
    }

    public function setSmoker(bool $Smoker): self
    {
        $this->Smoker = $Smoker;

        return $this;
    }

    public function getMaxRoomates(): ?int
    {
        return $this->maxRoomates;
    }

    public function setMaxRoomates(int $maxRoomates): self
    {
        $this->maxRoomates = $maxRoomates;

        return $this;
    }

    public function getBalcon(): ?bool
    {
        return $this->balcon;
    }

    public function setBalcon(bool $balcon): self
    {
        $this->balcon = $balcon;

        return $this;
    }

    public function getGarden(): ?bool
    {
        return $this->garden;
    }

    public function setGarden(bool $garden): self
    {
        $this->garden = $garden;

        return $this;
    }

    public function getGarage(): ?bool
    {
        return $this->garage;
    }

    public function setGarage(bool $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function getLocatedAt(): ?City
    {
        return $this->locatedAt;
    }

    public function setLocatedAt(?City $locatedAt): self
    {
        $this->locatedAt = $locatedAt;

        return $this;
    }

    public function getUserOwner(): ?User
    {
        return $this->UserOwner;
    }

    public function setUserOwner(?User $UserOwner): self
    {
        $this->UserOwner = $UserOwner;

        return $this;
    }

    public function getUserColoc(): ?User
    {
        return $this->userColoc;
    }

    public function setUserColoc(?User $userColoc): self
    {
        $this->userColoc = $userColoc;

        // set (or unset) the owning side of the relation if necessary
        $newColoc = null === $userColoc ? null : $this;
        if ($userColoc->getColoc() !== $newColoc) {
            $userColoc->setColoc($newColoc);
        }

        return $this;
    }

    public function getImages(): ?File
    {
        return $this->images;
    }

    public function setImages(File $images = null): self
    {
        $this->images = $images;

        return $this;
    }

    public function getPostedAt(): ?\DateTimeInterface
    {
        return $this->postedAt;
    }

    public function setPostedAt(\DateTimeInterface $postedAt): self
    {
        $this->postedAt = $postedAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }
}
