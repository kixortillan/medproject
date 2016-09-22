<?php

namespace App\Libraries\Repositories\Core\Doctrine;

use App\Libraries\Entities\Core\Department;
use App\Libraries\Repositories\Core\Contracts\InterfaceDepartmentRepository;
use Doctrine\ORM\EntityManagerInterface;

class DepartmentRepository implements InterfaceDepartmentRepository {

    protected $repo;
    protected $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function save(Department $department) {
        $this->em->transactional(function($em) use($department) {
            $em->persist($department);
            $em->flush();
        });
    }

    public function findByCode(string $code) {
        return $this->em->getRepository(Department::class)->findOneBy([
                    'code' => $code
        ]);
    }

    public function findAll(array $criteria, $limit, $offset = 0, $orderBy = 'id') {
        return $this->em->getRepository(Department::class)
                        ->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function count() {
        return $this->em->createQueryBuilder()
                        ->select('COUNT(t0.code)')
                        ->from(Department::class, 't0')
                        ->getQuery()
                        ->getSingleScalarResult();
    }

    public function delete(int $id, $defer = false) {
        $entity = $this->em->getReference(Department::class, $id);
        $this->em->remove($entity);

        if ($defer == false) {
            $this->em->flush();
        }
    }

    public function search($columns, $keyword) {
        $builder = $this->em->createQueryBuilder();

        $columns = is_array($columns) ? $columns : [$columns];

        foreach ($columns as $key => $val) {
            $builder->orWhere("$val LIKE :$key")
                    ->setParameter($key, $keyword);
        }

        $result = $builder->getQuery()->getResult();

        return $result;
    }

}
