<?php
namespace HalSoft\DcmPh\Entity;

use HalSoft\DcmPh\Dcmtk\DicomDictionary;
/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */

class Study extends DicomResponse implements DicomObjectInterface
{
    protected $study_instance_uid;
    protected $study_id;
    protected $study_date;
    protected $study_time;
    protected $study_description;
    protected $study_modality;

    public function addElement($attributes, $value)
    {
        parent::addElement($attributes, $value);
        if (isset($attributes['tag'])) {
            $this->dicom_tags[$attributes['tag']] = $value;
        }
    }
    
    public function getInstanceUID()
    {
        if(isset($this->dicom_tags[DicomDictionary::STUDY_INSTANCE_UID])) {
            return $this->dicom_tags[DicomDictionary::STUDY_INSTANCE_UID];
        }
        return false;
    }
    
    public function getId()
    {
        if(isset($this->dicom_tags[DicomDictionary::STUDY_ID])) {
            return $this->dicom_tags[DicomDictionary::STUDY_ID];
        }
        return false;
    }
    
    public function getDateTime($format = null)
    {
        if(!isset($this->dicom_tags[DicomDictionary::STUDY_DATE]) || !isset($this->dicom_tags[DicomDictionary::STUDY_TIME])) {
            return false;
        }
        $res = \DateTime::createFromFormat('YmdHis', $this->dicom_tags[DicomDictionary::STUDY_DATE].$this->dicom_tags[DicomDictionary::STUDY_TIME]);

        if($format == null) {
            return $res;
        } else {
            return $res->format($format);
        }
    }
    
    public function getDescription()
    {
        if(isset($this->dicom_tags[DicomDictionary::STUDY_DESCRIPTION])) {
            return $this->dicom_tags[DicomDictionary::STUDY_DESCRIPTION];
        }
        return false;
    }
}
