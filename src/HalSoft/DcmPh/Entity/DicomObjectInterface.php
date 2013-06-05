<?php
namespace HalSoft\DcmPh\Entity;

/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */

interface DicomObjectInterface {
    
    public function addElement($attributes, $value);
    
}
