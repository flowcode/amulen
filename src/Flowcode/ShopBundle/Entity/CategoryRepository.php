<?php

namespace Flowcode\ShopBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository {
    
    public function findAll() {
        return parent::findAll();
    }
    
}
