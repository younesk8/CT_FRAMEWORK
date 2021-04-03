<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    private $manager;
    private $session;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager, SessionInterface $session)
    {
        parent::__construct($registry, User::class);
        $this->manager = $manager;
        $this->session = $session;
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function saveUser($nom, $password )
    {
        $newUser= new User();

        $newUser
            ->setNom($nom)
            ->setPassword($password);
        $this->manager->persist($newUser);
        $this->manager->flush();
    }


    
    public function loginUser($nom, $password )
    {
        $userObject = $this->getEntityManager()
            ->getRepository("App:User")
            ->find($nom);

            if ($userObject) {
                if (strcmp($userObject->getPassword(), $userObject) == 0){
                    $this->session->set('nom', $nom);
                }
                   
            }

        }

    
    

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

