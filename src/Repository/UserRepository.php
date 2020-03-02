<?php

namespace App\Repository;

use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $authorizedUserId
     *
     * @return User[]
     */
    public function findAllWithMessages(string $authorizedUserId): array
    {
        return $this->createQueryBuilder('u')
            ->leftJoin(
                Message::class,
                'm',
                Join::WITH,
                'u.id = m.fromUser'
            )
            ->andWhere('m.toUser = :user')
            ->setParameter('user', $authorizedUserId)
            ->getQuery()
            ->getResult();
    }
}
