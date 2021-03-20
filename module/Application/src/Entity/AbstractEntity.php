<?php

namespace Application\Entity;

use Zend\Hydrator;
use Zend\Hydrator\ClassMethods;

/*
 * Class AbstractEntity
 * 
 * @package Base\Entity
 */
abstract class AbstractEntity{
    
    /**
     * @param array $options
     */
          public function __construct($options = array()) {
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    }
    
    /**
     * @return array
     */
    public function toArray() {
        $hydrator = new ClassMethods(false);
        return $hydrator->extract($this);
    }

}
