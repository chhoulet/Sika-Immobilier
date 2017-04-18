<?php

namespace FrontOfficeBundle\Repository;

/**
 * ApartmentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ApartmentRepository extends \Doctrine\ORM\EntityRepository
{
	public function getApartmentsByProjectId($id)
	{
		$queryB=$this->createQueryBuilder('a');
		$queryB      ->select('p')
		             ->from('FrontOfficeBundle:Apartment', 'p')
		             ->where('p.project = :id')
		             ->setParameter('id', $id);
		return $queryB;
	}
}