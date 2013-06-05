<?php
namespace HalSoft\DcmPh\Query;

use HalSoft\DcmPh\Dcmtk\DicomDictionary;
use HalSoft\DcmPh\Entity\InstancesContainer;

/**
 * This is an interface to the findscu program
 * from http://dicom.offis.de/
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */
class InstanceQuery extends \HalSoft\DcmPh\Dcmtk\FindScu
{
    public function findInstance($study_instance_uid, $serie_instance_uid)
    {
        $this->prepareParameters();
        $instances = new InstancesContainer();
        $this->parameters[DicomDictionary::STUDY_INSTANCE_UID] = $study_instance_uid;
        $this->parameters[DicomDictionary::SERIES_INSTANCE_UID] = $serie_instance_uid;
        $this->executeFindscu($instances);
        return $instances;
    }
    
    protected function prepareParameters()
    {
        $this->parameters = array(
            DicomDictionary::IMAGE_TYPE => "*",
            DicomDictionary::STUDY_INSTANCE_UID => "*",
            DicomDictionary::SERIES_INSTANCE_UID => "*",
            DicomDictionary::SOP_CLASS_UID => "*",
            DicomDictionary::SOP_INSTANCE_UID => "*",
            DicomDictionary::ACQUISITION_DATE => "*",
            DicomDictionary::ACQUISITION_TIME => "*",
            DicomDictionary::INSTANCE_NUMBER => "*",
            DicomDictionary::QUERY_RETRIEVE_LEVEL => "IMAGE"
        );
        $this->query_information_model = '-S';
    }
}
