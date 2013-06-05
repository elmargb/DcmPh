<?php
namespace HalSoft\DcmPh\Query;

use HalSoft\DcmPh\Dcmtk\DicomDictionary;
use HalSoft\DcmPh\Entity\PatientsContainer;

/**
 * This is an interface to the findscu program
 * from http://dicom.offis.de/
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */
class PatientQuery extends \HalSoft\DcmPh\Dcmtk\FindScu
{
    public function findPatientById($id)
    {
        $this->prepareParameters();
        $patients = new PatientsContainer();
        $this->parameters[DicomDictionary::PATIENT_ID] = $id;
        $this->executeFindscu($patients);
        return $patients;
    }
    
    /**
     * Returns a container with the patient whose name
     * mathch the passed parameter
     * 
     * @param type $name
     * @return \HalSoft\DcmPh\Entity\PatientsContainer
     */
    public function findPatientsByName($name)
    {
        $this->prepareParameters();
        $patients = new PatientsContainer();
        $this->parameters[DicomDictionary::PATIENT_NAME] = "$name";
        $this->executeFindscu($patients);
        return $patients;
    }
    
    public function getPatientStudies()
    {
        
    }

    protected function prepareParameters()
    {
        $this->parameters = array(
            DicomDictionary::PATIENT_ID => "*",
            DicomDictionary::PATIENT_NAME => "*",
            DicomDictionary::PATIENT_BIRTH_DATE => "*",
            DicomDictionary::PATIENT_SEX => "*",
            DicomDictionary::QUERY_RETRIEVE_LEVEL => "PATIENT"
        );
        $this->query_information_model = '-P';
    }
}
