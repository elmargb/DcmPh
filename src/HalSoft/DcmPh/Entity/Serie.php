<?php
namespace HalSoft\DcmPh\Entity;

use HalSoft\DcmPh\Dcmtk\DicomDictionary;
/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */

class Serie extends DicomResponse implements DicomObjectInterface
{
    public function getInstanceUID()
    {
        if(isset($this->dicom_tags[DicomDictionary::SERIES_INSTANCE_UID])) {
            return $this->dicom_tags[DicomDictionary::SERIES_INSTANCE_UID];
        }
        return false;
    }
    
    public function getNumber()
    {
        if(isset($this->dicom_tags[DicomDictionary::SERIES_NUMBER])) {
            return $this->dicom_tags[DicomDictionary::SERIES_NUMBER];
        }
        return false;
    }
    
    public function getDateTime($format = null)
    {
        if(!isset($this->dicom_tags[DicomDictionary::SERIES_DATE]) || !isset($this->dicom_tags[DicomDictionary::SERIES_TIME])) {
            return false;
        }
        $res = \DateTime::createFromFormat('YmdHis', $this->dicom_tags[DicomDictionary::SERIES_DATE].$this->dicom_tags[DicomDictionary::SERIES_TIME]);

        if($format == null) {
            return $res;
        } else {
            return $res->format($format);
        }
    }
    
    public function getDescription()
    {
        if(isset($this->dicom_tags[DicomDictionary::SERIES_DESCRIPTION])) {
            return $this->dicom_tags[DicomDictionary::SERIES_DESCRIPTION];
        }
        return false;
    }
}
