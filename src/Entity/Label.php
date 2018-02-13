<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="label")
 * @ORM\Entity
 *
 * @author Marko Kunic <kunicmarko20@gmail.com>
 */
class Label
{
    /**
     * @var int
     *
     * @Serializer\Expose
     * @Serializer\Groups(groups={"labelComplete"})
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Serializer\Expose
     * @Serializer\Groups(groups={"labelComplete"})
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotNull()
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @Serializer\Expose
     * @Serializer\Groups(groups={"labelComplete"})
     *
     * @Assert\NotNull()
     * @ORM\Column(name="value", type="text")
     */
    private $value;

    public function getId() : ?int
    {
        return $this->id;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function getValue() : ?string
    {
        return $this->value;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name ?? 'Label';
    }
}
