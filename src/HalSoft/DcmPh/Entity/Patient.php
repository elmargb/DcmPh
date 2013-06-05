<?php
namespace HalSoft\DcmPh\Entity;

use HalSoft\DcmPh\Dcmtk\DicomDictionary;
/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */

class Patient extends DicomResponse implements DicomObjectInterface
{
    protected $dicom_tags = array();


    public function addElement($attributes, $value)
    {
        parent::addElement($attributes, $value);
        if (isset($attributes['tag'])) {
            $this->dicom_tags[$attributes['tag']] = $value;
        }
    }
    
    public function getName()
    {
        if(isset($this->dicom_tags[DicomDictionary::PATIENT_NAME])) {
            return $this->dicom_tags[DicomDictionary::PATIENT_NAME];
        }
        return false;
    }
    
    public function getBirthdate($format = null)
    {
        if(isset($this->dicom_tags[DicomDictionary::PATIENT_BIRTH_DATE])) {
            $res = \DateTime::createFromFormat('Ymd', $this->dicom_tags[DicomDictionary::PATIENT_BIRTH_DATE]);
            if($format == null) {
                return $res;
            } else {
                return $res->format($format);
            }
        }
        return false;
    }
    
    public function getSex()
    {
        if(isset($this->dicom_tags[DicomDictionary::PATIENT_SEX])) {
            return $this->dicom_tags[DicomDictionary::PATIENT_SEX];
        }
        return false;
    }
    
    public function getId()
    {
        if(isset($this->dicom_tags[DicomDictionary::PATIENT_ID])) {
            return $this->dicom_tags[DicomDictionary::PATIENT_ID];
        }
        return false;
    }
}
