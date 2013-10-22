<?php

namespace Neutral\AdminBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Doctrine\ORM\EntityManager;

class CollectionToStringTransformer implements DataTransformerInterface
{
    protected $em;
    protected $delimiter;
    protected $repository;
    protected $fieldName;
    
    public function __construct(EntityManager $em, $entityName, $fieldName, $delimiter = ',')
    {
        $this->em = $em;
        $this->repository = $em->getRepository($entityName);
        $this->fieldName = $fieldName;
        $this->delimiter = $delimiter;
    }

    public function transform($collection)
    {
        if (null === $collection) {
            return null;
        }

        if (!$collection instanceof Collection) {
            throw new UnexpectedTypeException($collection, 'Doctrine\Common\Collections\Collection');
        }

        $itemValues = array();
        foreach ($collection as $item) {
            $getterName = 'get' . ucfirst($this->fieldName);
            $itemValues[] = $item->$getterName();
        }

        return implode($this->delimiter, $itemValues);
    }

    public function reverseTransform($data)
    {
        $collection = new ArrayCollection();

        if (empty($data)) {
            return $collection;
        }

        if (!is_string($data)) {
            throw new UnexpectedTypeException($data, 'string');
        }

        $itemValues = explode($this->delimiter, $data);
        array_walk($itemValues, 'trim');
        
        foreach ($itemValues as $itemValue) {
            $item = $this->repository
                    ->findOneBy([$this->fieldName => $itemValue]);
            if (null === $item) {
                $setterName = 'set' . ucfirst($this->fieldName);
                $className = $this->repository->getClassName();
                $item = new $className;
                $item->$setterName($itemValue);
                $this->em->persist($item);
            }
            $collection->add($item);
        }

        return $collection;
    }
}