<?php

namespace App\Entity;

use App\Repository\ReplyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ReplyRepository::class)
 * @ApiResource(
 *  attributes={"security"="is_granted('ROLE_USER')"}, 
 *  normalizationContext={"groups"={"reply:read"}, {"reply:write"}},
 *  collectionOperations={"get", "post"={"security"="is_granted('ROLE_USER')"}},
 *  itemOperations={
 *         "get",
 *         "put"={"security"="is_granted('ROLE_USER')"},
 *     }
 * )
 */
class Reply
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"reply:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"reply:read"})
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Ticket::class, inversedBy="replies")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"reply:read"}, {"reply:write"})
     */
    private $ticket;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"reply:read"})
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function setTicket(?Ticket $ticket): self
    {
        $this->ticket = $ticket;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
