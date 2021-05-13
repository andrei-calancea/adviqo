<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AdviserRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Controller\AdditAdviserAction;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "get"={"method"="get"},
 *          "post"={
 *              "method"="post",
 *              "controller"=AdditAdviserAction::class
 *          }
 *     },
 *      itemOperations={
 *          "get"={"method"="get"},
 *          "delete"={"method"="delete"},
 *          "put"={
 *              "method"="put",
 *              "controller"=AdditAdviserAction::class
 *          },
 *          "patch"={
 *              "method"="patch",
 *              "controller"=AdditAdviserAction::class
 *          }
 *     },
 * )
 *
 * @ApiFilter(SearchFilter::class, properties={
 *      "name": "partial",
 *      "language": "exact"
 * })
 *
 * @ApiFilter(OrderFilter::class, properties={
 *      "pricePerMinute",
 *      "availability"
 * })
 *
 * @ORM\Entity(repositoryClass=AdviserRepository::class)
 */
class Adviser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default" : 0})
     */
    private $availability;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @App\Validator\ContainsNumericPositive
     */
    private $pricePerMinute;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $language;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $profileImage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(?bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getPricePerMinute(): ?string
    {
        return $this->pricePerMinute;
    }

    public function setPricePerMinute(string $pricePerMinute): self
    {
        $this->pricePerMinute = $pricePerMinute;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getProfileImage()
    {
        return $this->profileImage;
    }

    public function setProfileImage($profileImage): self
    {
        $this->profileImage = $profileImage;

        return $this;
    }
}
