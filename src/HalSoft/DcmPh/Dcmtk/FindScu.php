<?php
namespace HalSoft\DcmPh\Dcmtk;

use HalSoft\DcmPh\Entity\DicomObjectContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * This is an interface to the findscu program
 * from http://dicom.offis.de/
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */
abstract class FindScu 
{
    protected $calling_aet;
    protected $called_aet;
    protected $pacs_ip;
    protected $pacs_port;    
    protected $parameters;
    protected $query_information_model;
    protected $logger;

    public function __construct($called_aet, $pacs_ip, $pacs_port, $calling_aet = null, LoggerInterface $logger = null)
    {
        $this->called_aet = $called_aet;
        $this->pacs_ip = $pacs_ip;
        $this->pacs_port = $pacs_port;
        $this->calling_aet = $calling_aet?$calling_aet:"HALSOFTDCMPH";
        $this->parameters = array();
        $this->logger = $logger;
    }
    
    /**
     * Call's the findscu program, transform the DICOM response
     * to xml and extracts all attributes from the response.
     * Return an array containing all responses and, for each
     * response, all attributes found.
     * 
     * @return array
     */
    protected function executeFindscu(DicomObjectContainerInterface $container)
    {
        $this->execFindScu();
        
        $dir = opendir("./");
        $answers = 0;

        while (($filename = readdir($dir)) !== false) {
            if (preg_match("/^rsp[0-9]{4}\.dcm$/", $filename)) {
                
                $answer = $container->newDicomObject();
                $sxml = $this->getSimplXmlFromDicomFile($filename);
                $elements = $sxml->xpath("/file-format/data-set/element");
                
                foreach ($elements as $element) {
                    $element_attributes = array();
                    foreach($element->attributes() as $attribute => $value) {
                        $element_attributes[$attribute] = (string) $value;
                    }
                    $answer->addElement($element_attributes, (string) $element);
                }
                
                $container->addDicomObject($answer);
                $answers++;
            }
        }
        closedir($dir);
        return true;
    }
    
    public function execFindScu()
    {
        $command = "findscu -X ".$this->query_information_model;
        foreach ($this->parameters as $key => $val) {
            $command .= " -k $key";
            if($val != null) {
                $command .= "=\"$val\"";
            }
        }
        $command .= " -aec $this->called_aet -aet $this->calling_aet $this->pacs_ip $this->pacs_port  2> /dev/null";
        
        exec($command);
        if (null !== $this->logger) {
            $this->logger->info("Executing 'findscu' command");
            $this->logger->debug(sprintf("Command executed: %s", $command));
        }
    }
    
    public function getSimplXmlFromDicomFile($filename, $unlink = true)
    {
        if(!file_exists($filename)) {
            return false;
        }
        $random_filename = md5("xml_outfile_".rand(10000, 99999)).".xml";
        exec("dcm2xml $filename $random_filename 2> /dev/null");
        if (null !== $this->logger) {
            $this->logger->info("Converting dcm file %s to xml with the name %s", $filename, $random_filename);
        }
        $sxml = simplexml_load_file($random_filename);
        if($unlink) {
            unlink($filename);
            unlink($random_filename);
        }
        return $sxml;
    }
}
