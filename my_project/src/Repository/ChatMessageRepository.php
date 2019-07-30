<?php

namespace App\Repository;

use App\Entity\ChatMessage;
use App\Entity\ShopUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ChatMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChatMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChatMessage[]    findAll()
 * @method ChatMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChatMessageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ChatMessage::class);
    }

    // /**
    //  * @return ChatMessage[] Returns an array of ChatMessage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChatMessage
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findLastMessages($lastMessageId, ShopUser $user){

        return $this->createQueryBuilder('c')
            ->andWhere('c.id > :lastMessageId')
            ->andWhere('c.destination = :user')
            ->setParameter('lastMessageId', $lastMessageId)
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findLastMessagesWithUser($lastMessageId, ShopUser $user, ShopUser $currentUser){

        return $this->createQueryBuilder('c')
            ->andWhere('c.id > :lastMessageId')
            ->andWhere('c.destination = :currentUser')
            ->andWhere('c.author = :user')
            ->setParameter('lastMessageId', $lastMessageId)
            ->setParameter('user', $user)
            ->setParameter('currentUser', $currentUser)
            ->getQuery()
            ->getResult()
            ;
    }


}
