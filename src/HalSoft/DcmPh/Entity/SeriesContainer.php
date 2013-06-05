<?php
namespace HalSoft\DcmPh\Entity;

/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */

class SeriesContainer implements DicomObjectContainerInterface
{
    protected $series;
    
    public function __construct()
    {
        $this->series = array();
    }

    public function addDicomObject(DicomObjectInterface $element)
    {
        $this->series[] = $element;
    }
    
    public function newDicomObject()
    {
        return new Serie();
    }
    
    public function getSeries()
    {
        return $this->series;
    }
}

