<?php

namespace App\Libraries\Repositories\Core\Doctrine;

use App\Libraries\Repositories\Core\Contracts\InterfaceMedicalCaseRepository;
use App\Libraries\Common\ValueObjects\SearchCriteria;
use App\Libraries\Entities\Core\MedicalCase;
use Doctrine\ORM\EntityManagerInterface;
use Carbon\Carbon;

class MedicalCaseRepository implements InterfaceMedicalCaseRepository {

    protected $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function count() {
        return $this->em->createQueryBuilder()
                        ->select('COUNT(t0.id)')
                        ->from(MedicalCase::class, 't0')
                        ->getQuery()
                        ->getSingleScalarResult();
    }

    public function delete($id, $defer = false) {
        $entity = $this->em
                ->getRepository(MedicalCase::class)
                ->find($id);

        $this->em->transactional(function($em) use ($entity) {
            $entity->setDeletedAt(Carbon::now());
        });

        if ($defer == false) {
            $this->em->flush();
        }
    }

    public function findAll(SearchCriteria $search) {
        $builder = $this->em->createQueryBuilder();

        $builder->select('t0')
                ->from(MedicalCase::class, 't0');

        foreach ($search->getColumns() as $col) {
            $builder->orWhere("t0.{$col} LIKE :{$col}")
                    ->setParameter($col, "%" . $search->getKeyword() . "%");
        }

        $builder->orderBy("t0.{$search->getSortBy()}", $search->getOrder());

        $builder->setFirstResult($search->getOffset());
        $builder->setMaxResults($search->getLimit());

        $result = $builder->getQuery()->getResult();

        return collect($result);
    }

    public function findById($id) {
        $builder = $this->em->createQueryBuilder();

        $builder->select('t0')
                ->from(MedicalCase::class, 't0')
                ->andWhere("t0.id = :id")
                ->andWhere("t0.deletedAt is null")
                ->setParameter("id", $id);

        return $builder->getQuery()->getOneOrNullResult();
    }

    public function save(MedicalCase $patient) {
        $this->em->transactional(function($em) use($patient) {
            $em->persist($patient);
            $em->flush();
        });
    }

}