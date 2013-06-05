<?php
namespace HalSoft\DcmPh\Entity;

/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */
class DicomResponse
{
    protected $elements;
    
    public function __construct()
    {
        $this->elements = array();
    }
    
    public function addElement($attributes, $value)
    {
        $this->elements[] = new DicomObjectElement($attributes, $value);
    }
    
    public function getElements()
    {
        return $this->elements;
    }
}
