<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AdviserRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Controller\AdditAdviserAction;
use ApiPlatform\Core\Annotation\ApiProperty;

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
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "description"="The unique identified of the adviser",
     *             "type"="integer",
     *             "example"=1
     *         }
     *     }
     * )
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "description"="The name of the adviser",
     *             "type"="string",
     *             "example"="John Doe"
     *         }
     *     }
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "description"="Details about the adviser. The description block may include html too.",
     *             "type"="text",
     *             "example"="Very <b>responsable</b> and always pays attention to the datails."
     *         }
     *     }
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default" : 0})
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "description"="Shows if the adviser is available",
     *             "type"="boolean",
     *              "enum"={true, false},
     *             "example"=true
     *         }
     *     }
     * )
     */
    private $availability;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @App\Validator\ContainsNumericPositive
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "description"="The price that the adviser asks for one minute of assistence. The precision of the price is always set to two decimals.",
     *             "type"="number",
     *             "example"=12.45
     *         }
     *     }
     * )
     */
    private $pricePerMinute;

    /**
     * @ORM\Column(type="string", length=2)
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "description"="The language spoken by the advisor. Is represented by ISO 639-1 code of the language.",
     *             "type"="string",
     *             "example"="en"
     *         }
     *     }
     * )
     */
    private $language;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "description"="The base64 encoded profile image of the adviser.",
     *             "type"="string",
     *             "example"="iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII="
     *         }
     *     }
     * )
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
