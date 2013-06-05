<?php
namespace HalSoft\DcmPh\Entity;

/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */
class DicomObjectElement 
{
    protected $attributes;
    protected $value;

    public function __construct($attributes, $value)
    {
        $this->attributes = $attributes;
        $this->value = $value;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function getName()
    {
        if(isset($this->attributes['name'])) {
            return $this->attributes['name'];
        } else {
            return null;
        }
    }
    
    public function __toString()
    {
        return $this->getName().': '.$this->getValue();
    }
}
