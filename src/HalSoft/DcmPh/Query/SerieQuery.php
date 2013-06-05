<?php
namespace HalSoft\DcmPh\Query;

use HalSoft\DcmPh\Dcmtk\DicomDictionary;
use HalSoft\DcmPh\Entity\SeriesContainer;

/**
 * This is an interface to the findscu program
 * from http://dicom.offis.de/
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */
class SerieQuery extends \HalSoft\DcmPh\Dcmtk\FindScu
{
    public function findSeriesByInstanceUID($uid)
    {
        $this->prepareParameters();
        $series = new SeriesContainer();
        $this->parameters[DicomDictionary::SERIES_INSTANCE_UID] = $uid;
        $this->executeFindscu($series);
        return $series;
    }
    
    public function findSeriesInStudy($study_instance_uid)
    {
        $this->prepareParameters();
        $series = new SeriesContainer();
        $this->parameters[DicomDictionary::STUDY_INSTANCE_UID] = $study_instance_uid;
        $this->executeFindscu($series);
        return $series;
    }

    protected function prepareParameters()
    {
        $this->parameters = array(
            DicomDictionary::STUDY_INSTANCE_UID => "*",
            DicomDictionary::SERIES_DATE => "*",
            DicomDictionary::SERIES_INSTANCE_UID => "*",
            DicomDictionary::SERIES_TIME => "*",
            DicomDictionary::SERIES_DESCRIPTION => "*",
            DicomDictionary::SERIES_NUMBER => "*",
            DicomDictionary::QUERY_RETRIEVE_LEVEL => "SERIES"
        );
        $this->query_information_model = '-S';
    }
}
