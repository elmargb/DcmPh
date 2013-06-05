<?php
namespace HalSoft\DcmPh\Entity;

/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */

class InstancesContainer implements DicomObjectContainerInterface
{
    protected $instances;
    
    public function __construct()
    {
        $this->instances = array();
    }

    public function addDicomObject(DicomObjectInterface $element)
    {
        $this->instances[] = $element;
    }
    
    public function newDicomObject()
    {
        return new Instance();
    }
    
    public function getInstances()
    {
        return $this->instances;
    }
}

