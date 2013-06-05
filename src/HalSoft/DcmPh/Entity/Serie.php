<?php
namespace HalSoft\DcmPh\Entity;

use HalSoft\DcmPh\Dcmtk\DicomDictionary;
/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */

class Serie extends DicomResponse implements DicomObjectInterface
{
    protected $serie_instance_uid;
    protected $serie_id;
    protected $serie_date;
    protected $serie_time;
    protected $serie_description;
    protected $serie_number;

    public function addElement($attributes, $value)
    {
        parent::addElement($attributes, $value);
        if (isset($attributes['tag'])) {
            switch ($attributes['tag']) {
                case DicomDictionary::SERIES_INSTANCE_UID:
                    $this->serie_instance_uid = $value;
                    break;
                case DicomDictionary::SERIES_NUMBER:
                    $this->serie_number = $value;
                    break;
                case DicomDictionary::SERIES_DATE:
                    $this->serie_date = $value;
                    break;
                case DicomDictionary::SERIES_TIME:
                    $this->serie_time = $value;
                    break;
                case DicomDictionary::SERIES_NUMBER:
                    $this->serie_number = $value;
                    break;
                case DicomDictionary::SERIES_DESCRIPTION:
                    $this->serie_description = $value;
                    break;
            }
        }
    }
    
    public function getInstanceUID()
    {
        return $this->serie_instance_uid?$this->serie_instance_uid:false;
    }
    
    public function getNumber()
    {
        return $this->serie_number?$this->serie_number:false;
    }
    
    public function getDateTime($format = null)
    {
        if($this->serie_date == null || $this->serie_time == null) {
            return false;
        }
        $res = \DateTime::createFromFormat('YmdHis', $this->study_date.$this->study_time);
        
        if($format == null) {
            return $res;
        } else {
            return $res->format($format);
        }
    }
    
    public function getDescription()
    {
        return $this->serie_description?$this->serie_description:false;
    }
}
