DcmPh
=====

A library/wrapper for findscu.

What can I use it for ?
-----------------------

It is possible to use these libraries to retrieve information from a PACS.
You can read tests/simple_test.php to see how easy it is accessing your data
from your PACS.
Just an example:

```php
use HalSoft\DcmPh\Query\PatientQuery;
use HalSoft\DcmPh\Query\StudyQuery;

$called_aet = "TESTSERVER";
$pacs_ip = "www.dicomserver.co.uk";
$pacs_port = 104;
$calling_aet = "LOCALAET";

//Create a new patient query
$pq = new PatientQuery($called_aet, $pacs_ip, $pacs_port, $calling_aet);
//Find all patients who's name's like JOHN^
$patients = $pq->findPatientsByName('JOHN^');

//Create a new study query
$stq = new StudyQuery($called_aet, $pacs_ip, $pacs_port, $calling_aet);
//Find all studies for the patient whose id is 2222.2222
$studies = $stq->findStudiesByPatientId('2222.2222');
```

In this way it is easy to retrieve the information needed to retrieve wado 
objects:

- studyUID  (StudyInstanceUID)
- seriesUID (SeriesInstanceUID)
- objectUID (SOPInstanceUID)

Disclaimer
----------

This library is really at its early stage. HANDLE WITH CARE!

If you want to use it, you must have findscu and dcm2xml from 
http://dicom.offis.de/ and available in your path.

The library must have write permission (to save dcm files).

Todo's
------

The library use dcm2xml and simple-xml to read dicom files.

I think that I the near future it'll use (nanodicom)[https://github.com/nanodocumet/Nanodicom]
to read dicom files. But I'm not sure for two reasons:
- the last commit is aged 1 year
- nanodicom is quite complete, it uses a huge and complete Dicom dictionary
while I'd prefere to keep DcmPh....lighter
