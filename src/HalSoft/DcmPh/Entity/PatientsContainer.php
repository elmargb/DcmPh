<?php
namespace HalSoft\DcmPh\Entity;

/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */

class PatientsContainer implements DicomObjectContainerInterface
{
    protected $patients;
    
    public function __construct()
    {
        $this->patients = array();
    }

    public function addDicomObject(DicomObjectInterface $element)
    {
        $this->patients[] = $element;
    }
    
    public function newDicomObject()
    {
        return new Patient();
    }
    
    public function getPatients()
    {
        return $this->patients;
    }
}
