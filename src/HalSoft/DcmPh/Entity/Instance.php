<?php
namespace HalSoft\DcmPh\Entity;

use HalSoft\DcmPh\Dcmtk\DicomDictionary;
/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */

class Instance extends DicomResponse implements DicomObjectInterface
{
    protected $dicom_tags = array();
    
    public function addElement($attributes, $value)
    {
        parent::addElement($attributes, $value);
        if (isset($attributes['tag'])) {
            $this->dicom_tags[$attributes['tag']] = $value;
        }
    }
    
    public function getAcquisitionDateTime($format = null)
    {
        if(!isset($this->dicom_tags[DicomDictionary::ACQUISITION_DATE]) || !isset($this->dicom_tags[DicomDictionary::ACQUISITION_TIME])) {
            return false;
        }
        $res = \DateTime::createFromFormat('YmdHis', $this->dicom_tags[DicomDictionary::ACQUISITION_DATE].$this->dicom_tags[DicomDictionary::ACQUISITION_TIME]);

        if($format == null) {
            return $res;
        } else {
            return $res->format($format);
        }
    }
    
    public function getSopClassUID()
    {
        if(isset($this->dicom_tags[DicomDictionary::SOP_CLASS_UID])) {
            return $this->dicom_tags[DicomDictionary::SOP_CLASS_UID];
        }
        return false;
    }
    
    public function getSopInstanceUID()
    {
        if(isset($this->dicom_tags[DicomDictionary::SOP_INSTANCE_UID])) {
            return $this->dicom_tags[DicomDictionary::SOP_INSTANCE_UID];
        }
        return false;
    }

    public function getImageType()
    {
        if(isset($this->dicom_tags[DicomDictionary::IMAGE_TYPE])) {
            return $this->dicom_tags[DicomDictionary::IMAGE_TYPE];
        }
        return false;
    }
    
    public function getInstanceNumber()
    {
        if(isset($this->dicom_tags[DicomDictionary::INSTANCE_NUMBER])) {
            return $this->dicom_tags[DicomDictionary::INSTANCE_NUMBER];
        }
        return false;
    }
}
