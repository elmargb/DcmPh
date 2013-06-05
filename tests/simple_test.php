<?php
require '../vendor/autoload.php';

use HalSoft\DcmPh\Query\PatientQuery;
use HalSoft\DcmPh\Query\StudyQuery;
use HalSoft\DcmPh\Query\SerieQuery;
use HalSoft\DcmPh\Query\InstanceQuery;

$called_aet = "TESTSERVER";
$pacs_ip = "www.dicomserver.co.uk";
$pacs_port = 104;
$calling_aet = "LOCALAET";

$pq = new PatientQuery($called_aet, $pacs_ip, $pacs_port, $calling_aet);

//Search patients by name
$patients = $pq->findPatientById('*');

foreach ($patients->getPatients() as $patient) {
    echo "Patient ID: ".$patient->getId()."-";
    echo "Patient's name: ".$patient->getName()."-";
    echo "Patient's date of birth: ".$patient->getBirthdate('d/m/Y')."-";
    echo "Patient's sex: ".$patient->getSex()."\n";
    echo "Studies regarding this patient:\n";
    
    $stq = new StudyQuery($called_aet, $pacs_ip, $pacs_port, $calling_aet);
    $studies = $stq->findStudiesByPatientId($patient->getId());
    
    foreach ($studies->getStudies() as $study) {
        /* @var $study \HalSoft\DcmPh\Entity\Study */
        echo "Study Id: ".$study->getId()."\n";
        echo "Study instance UID: ".$study->getInstanceUID()."\n";
        echo "Study description: ".$study->getDescription()."\n";
        echo "Study date: ".$study->getDateTime('d/m/Y H:i')."\n";
        echo "Series regarding this study:\n";
        $seq = new SerieQuery($called_aet, $pacs_ip, $pacs_port, $calling_aet);
        $series = $seq->findSeriesInStudy($study->getInstanceUID());
        
        foreach ($series->getSeries() as $serie) {
            /* @var $serie \HalSoft\DcmPh\Entity\Serie */
            echo "Serie's instance UID: ".$serie->getInstanceUID()."\n";
            echo "Serie's description: ".$serie->getDescription()."\n";
            echo "Instances for the serie:\n";
            $iq = new InstanceQuery($called_aet, $pacs_ip, $pacs_port, $calling_aet);
            $instances = $iq->findInstance($study->getInstanceUID(), $serie->getInstanceUID());
            
            foreach ($instances->getInstances() as $instance) {
                /* @var $instance \HalSoft\DcmPh\Entity\Instance */
                echo "Image type: ".$instance->getImageType()."\n";
                echo "Acquisition date: ".$instance->getAcquisitionDateTime('d/m/Y H:i')."\n";
            }
        }
    }
}

?>
