<?php
namespace HalSoft\DcmPh\Query;

use HalSoft\DcmPh\Dcmtk\DicomDictionary;
use HalSoft\DcmPh\Entity\StudiesContainer;

/**
 * This is an interface to the findscu program
 * from http://dicom.offis.de/
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */
class StudyQuery extends \HalSoft\DcmPh\Dcmtk\FindScu
{
    public function findStudyById($id)
    {
        $this->prepareParameters();
        $studies = new StudiesContainer();
        $this->parameters[DicomDictionary::STUDY_ID] = $id;
        $this->executeFindscu($studies);
        return $studies;
    }
    
    public function findStudyByInstanceUID($uid)
    {
        $this->prepareParameters();
        $studies = new StudiesContainer();
        $this->parameters[DicomDictionary::STUDY_INSTANCE_UID] = $uid;
        $this->executeFindscu($studies);
        return $studies;
    }
    
    public function findStudiesByPatientId($patient_id)
    {
        $this->prepareParameters();
        $studies = new StudiesContainer();
        $this->parameters[DicomDictionary::PATIENT_ID] = $patient_id;
        $this->executeFindscu($studies);
        return $studies;
    }

    protected function prepareParameters()
    {
        $this->parameters = array(
            DicomDictionary::PATIENT_ID => "*",
            DicomDictionary::STUDY_INSTANCE_UID => "*",
            DicomDictionary::STUDY_ID => "*",
            DicomDictionary::STUDY_DESCRIPTION => "*",
            DicomDictionary::STUDY_DATE => "*",
            DicomDictionary::STUDY_TIME => "*",
            DicomDictionary::QUERY_RETRIEVE_LEVEL => "STUDY"
        );
        $this->query_information_model = '-S';
    }
}
