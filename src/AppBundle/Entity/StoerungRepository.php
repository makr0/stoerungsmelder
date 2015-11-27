<?php

namespace AppBundle\Entity;

/**
 * StoerungRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StoerungRepository extends \Doctrine\ORM\EntityRepository
{
    public function count_stoerungen_ohne_behebung()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT count(distinct(s.maschine)) FROM AppBundle:Stoerung s
                 WHERE s.behoben = 0
                '
            )

            ->getSingleScalarResult();
    }
    public function count_maschinen_ok()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT count(m) FROM AppBundle:Maschine m
                 WHERE NOT EXISTS (
                 	SELECT s FROM AppBundle:Stoerung s WHERE s.maschine = m and s.behoben = 0
                 )
                '
            )
            ->getSingleScalarResult();
    }
}
