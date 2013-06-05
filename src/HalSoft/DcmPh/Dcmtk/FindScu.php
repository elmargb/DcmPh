<?php
namespace HalSoft\DcmPh\Dcmtk;

use HalSoft\DcmPh\Entity\DicomObjectContainerInterface;

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


    public function __construct($called_aet, $pacs_ip, $pacs_port, $calling_aet = null)
    {
        $this->called_aet = $called_aet;
        $this->pacs_ip = $pacs_ip;
        $this->pacs_port = $pacs_port;
        $this->calling_aet = $calling_aet?$calling_aet:"HALSOFTDCMPH";
        $this->parameters = array();
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
        $command = "findscu -X ".$this->query_information_model;
        foreach ($this->parameters as $key => $val) {
            $command .= " -k $key";
            if($val != null) {
                $command .= "=\"$val\"";
            }
        }
        $command .= " -aec $this->called_aet -aet $this->calling_aet $this->pacs_ip $this->pacs_port  2> /dev/null";
        
        exec($command);
        
        $dir = opendir("./");
        $answers = 0;

        while (($file = readdir($dir)) !== false) {
            if (preg_match("/^rsp[0-9]{4}\.dcm$/", $file)) {
                exec("dcm2xml $file out.xml 2> /dev/null", $output);
                unlink($file);
                $answer = $container->newDicomObject();
                $sxml = simplexml_load_file("out.xml");
                $elements = $sxml->xpath("/file-format/data-set/element");
                
                foreach ($elements as $element) {
                    $element_attributes = array();
                    foreach($element->attributes() as $attribute => $value) {
                        $element_attributes[$attribute] = (string) $value;
                    }
                    $answer->addElement($element_attributes, (string) $element);
                }
                $container->addDicomObject($answer);
                unlink("out.xml");
                $answers++;
            }
        }
        closedir($dir);
        return true;
    }
}
