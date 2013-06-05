<?php
namespace HalSoft\DcmPh\Entity;

/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */

class StudiesContainer implements DicomObjectContainerInterface
{
    protected $studies;
    
    public function __construct()
    {
        $this->studies = array();
    }

    public function addDicomObject(DicomObjectInterface $element)
    {
        $this->studies[] = $element;
    }
    
    public function newDicomObject()
    {
        return new Study();
    }
    
    public function getStudies()
    {
        return $this->studies;
    }
}

