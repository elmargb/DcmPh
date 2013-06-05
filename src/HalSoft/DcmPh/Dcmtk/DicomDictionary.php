<?php

namespace HalSoft\DcmPh\Dcmtk;

class DicomDictionary
{
    const QUERY_RETRIEVE_LEVEL         = '0008,0052';
    
    const PATIENT_NAME                 = '0010,0010';
    const PATIENT_ID                   = '0010,0020';
    const PATIENT_BIRTH_DATE           = '0010,0030';
    const PATIENT_SEX                  = '0010,0040';
    
    const STUDY_DATE                   = '0008,0020';
    const STUDY_TIME                   = '0008,0030';
    const STUDY_DESCRIPTION            = '0008,1030';
    const STUDY_INSTANCE_UID           = '0020,000d';
    const STUDY_ID                     = '0020,0010';
    
    const SERIES_DATE                  = '0008,0021';
    const SERIES_TIME                  = '0008,0031';
    const SERIES_DESCRIPTION           = '0008,103e';
    const SERIES_INSTANCE_UID          = '0020,000e';
    const SERIES_NUMBER                = '0020,0011';
    
    const IMAGE_TYPE                   = '0008,0008';
    const SOP_CLASS_UID                = '0008,0016';
    const SOP_INSTANCE_UID             = '0008,0018';
    const ACQUISITION_DATE             = '0008,0022';
    const ACQUISITION_TIME             = '0008,0032';
    const INSTANCE_NUMBER              = '0020,0013';
    const ROWS                         = '0028,0010';
    const COLUMNS                      = '0028,0011';
    const BITS_ALLOCATED               = '0028,0100';
}
