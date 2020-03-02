<?php

namespace App\Repository;

use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    /**
     * @param string $fromUserId
     * @param string $toUserId
     *
     * @return mixed
     */
    public function findAllFromUserToUser(string $fromUserId, string $toUserId)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.fromUser IN (:users)')
            ->andWhere('m.toUser IN (:users)')
            ->setParameters([
                'users' => [
                    $fromUserId,
                    $toUserId,
                ],
            ])
            ->getQuery()
            ->getResult();
    }
}
