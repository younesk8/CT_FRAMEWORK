<?php

namespace App\Repository;

use App\Entity\Annonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
/**
 * @method Annonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonce[]    findAll()
 * @method Annonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager )
    {
        parent::__construct($registry, Annonce::class);
        $this->manager = $manager;
    }

    //save the annonce
    public function saveAnnonce($name, $description, $price, $category)
    {
        $categoryObject = $this->getEntityManager()
            ->getRepository("App:Category")
            ->find($category);
            
        $auteur = $this->getEntityManager()
            ->getRepository("App:User")
            ->find(1);

        $newAnnonce= new Annonce();

        $newAnnonce
            ->setName($name)
            ->setDescription($description)
            ->setPrice($price)
            ->setCategory($categoryObject)
            ->setUser($auteur);


        $this->manager->persist($newAnnonce);
        $this->manager->flush();
    }

    public function updateAnnonce(Annonce $annonce, $data)
    {
        empty($data['name']) ? true : $annonce->setName($data['name']);
        empty($data['description']) ? true : $annonce->setDescription($data['description']);
        empty($data['price']) ? true : $annonce->setPrice($data['price']);
        if(!empty($data['category'])){
            $categoryObject = $this->getEntityManager()
            ->getRepository("App:Category")
            ->find($data['category']);
            $annonce->setCategory($categoryObject);
        }

        $this->manager->flush();
    }

    public function removeAnnonce(Annonce $annonce)
    {
        $this->manager->remove($annonce);
        $this->manager->flush();
    }

    // /**
    //  * @return Annonce[] Returns an array of Annonce objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Annonce
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
