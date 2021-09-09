<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"ticket:read"}, {"ticket:write"}},
 *  collectionOperations={"get", "post"},
 *      
 * )
 */
 
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"reply:read"}, {"reply:write"}, {"ticket:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("ticket:read")
     * @Assert\NotBlank
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("ticket:read")
     * @Assert\NotBlank
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("ticket:read")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Reply::class, mappedBy="ticket", orphanRemoval=true)
     * @Groups("ticket:read")
     */
    private $replies;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("ticket:read")
     * @Assert\NotBlank
     */
    private $category;

    public function __construct()
    {
        $this->replies = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Reply[]
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(Reply $reply): self
    {
        if (!$this->replies->contains($reply)) {
            $this->replies[] = $reply;
            $reply->setTicket($this);
        }

        return $this;
    }

    public function removeReply(Reply $reply): self
    {
        if ($this->replies->removeElement($reply)) {
            // set the owning side to null (unless already changed)
            if ($reply->getTicket() === $this) {
                $reply->setTicket(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }
    

}
