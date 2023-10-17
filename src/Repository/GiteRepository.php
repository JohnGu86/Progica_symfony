<?php

namespace App\Repository;

use App\Entity\Gite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Gite>
 *
 * @method Gite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gite[]    findAll()
 * @method Gite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class GiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gite::class);
    }

    public function save(Gite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Gite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findGiteByCriteria(array $criteria) {

        $query = $this->createQueryBuilder('g');
        
        if(isset($criteria['ville'])) {
            $this->findByCity($query, $criteria);
        }
            
        if(isset($criteria['departement'])) {
            $query->join('g.ville', 'v2')
                   ->join('v2.departement', 'd')
                   ->orWhere('d.id = :departement_id')
                   ->setParameter('departement_id', $criteria['departement']->getId());
        }

        if(isset($criteria['region'])) {
            $query->join('g.ville', 'v3')
                   ->join('v3.departement', 'd2')
                   ->join('d2.region', 'r')
                   ->orWhere('r.id = :region_id')
                   ->setParameter('region_id', $criteria['region']->getId());
        }

        if(isset($criteria['equipementInterieur'])) {
            
            $listIdEquipementInterieur = array_map(function ($element) {
                return $element->getId();
            }, $criteria['equipementInterieur']->toArray());

            if (!empty($listIdEquipementInterieur)) {
                
                $query->join('g.equipementInterieur', 'i')
                       ->andWhere($query->expr()->in('i.id', $listIdEquipementInterieur))
                       ->groupBy('g.id')
                       ->having('COUNT(DISTINCT i.id) = :count')
                       ->setParameter('count', count($listIdEquipementInterieur));
            }
        }

        if(isset($criteria['equipementExterieur'])) {
            
            $listIdEquipementExterieur = array_map(function ($element) {
                return $element->getId();
            }, $criteria['equipementExterieur']->toArray());

            if(!empty($listIdEquipementExterieur)) {

                $query->join('g.equipementExterieur', 'e')
                ->andWhere($query->expr()->in('e.id', $listIdEquipementExterieur))
                ->groupBy('g.id')
                ->having('COUNT(DISTINCT e.id) = :count')
                ->setParameter('count', count($listIdEquipementExterieur));
            }
            }

        if(isset($criteria['service'])) {
            
            $listIdService = array_map(function ($element) {
                return $element->getId();
            }, $criteria['service']->toArray());

            if (!empty($listIdService)) {

                $query->join('g.service', 's')
                ->andWhere($query->expr()->in('s.id', $listIdService))
                ->groupBy('g.id')
                ->having('COUNT(DISTINCT s.id) = :count')
                ->setParameter('count', count($listIdService));
            }
        }
        
        return $query->getQuery()
                     ->getResult(); 
    }

    public function findByCity($query, $criteria) {

            $query->join('g.ville', 'v')
                   ->where('v.id = :ville_id')
                   ->setParameter('ville_id', $criteria['ville']->getId());

    }
}