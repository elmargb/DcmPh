<?php
namespace HalSoft\DcmPh\Entity;

use Psr\Log\LoggerInterface;

/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */
class DicomResponse
{
    protected $elements;
    protected $dicom_tags;
    protected $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        $this->elements = array();
        $this->dicom_tags = array();
        $this->logger = $logger;
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
