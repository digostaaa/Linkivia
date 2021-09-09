<?php

namespace App\DataPersister;

use App\Entity\Reply;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class ReplyDataPersister implements ContextAwareDataPersisterInterface
{
    private $entityManager;
    
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Reply;
    }

    public function persist($data, array $context = [])
    {
        $data->setCreatedAt(new \DateTimeImmutable());
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}