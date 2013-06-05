<?php
namespace HalSoft\DcmPh\Entity;

/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */

interface DicomObjectContainerInterface {
    
    /**
     * Return a new object implementing DicomObjectInterface
     * 
     * @return \HalSoft\DcmPh\Entity\DicomObjectInterface $object
     */
    public function newDicomObject();
    
    /**
     * Add a DicomObject to the container
     * 
     * @param \HalSoft\DcmPh\Entity\DicomObjectInterface $element
     */
    public function addDicomObject(DicomObjectInterface $element);
    
}

?>
