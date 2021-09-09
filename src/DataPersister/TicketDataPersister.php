<?php

namespace App\DataPersister;

use App\Entity\Ticket;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class TicketDataPersister implements ContextAwareDataPersisterInterface
{
    private $entityManager;
    
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Ticket;
    }

    public function persist($data, array $context = [])
    {
        $data->setStatus('Pending');
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}