<?php
namespace HalSoft\DcmPh\Entity;

/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */
class DicomResponse
{
    protected $elements;
    protected $dicom_tags = array();
    
    public function __construct()
    {
        $this->elements = array();
    }
    
    public function addElement($attributes, $value)
    {
        $this->elements[] = new DicomObjectElement($attributes, $value);
        if (isset($attributes['tag'])) {
            $this->dicom_tags[$attributes['tag']] = $value;
        }
    }
    
    public function getElements()
    {
        return $this->elements;
    }
}
