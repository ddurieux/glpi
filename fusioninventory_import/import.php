<?php

include ('../inc/includes.php');

$files = ['portdavid.xml'];

foreach ($files as $file) {
   $xml = file_get_contents($file);
   $pxml = @simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
   $datainventory = json_decode(json_encode((array)$pxml), TRUE);

   $input = array(
       'name'    => $datainventory['CONTENT']['HARDWARE']['CHASSIS_TYPE'],
       'comment' => '');
   $computerType = new ComputerType();
   $computertype_id = $computerType->add($input);

   $input = array();
   $input['name'] = $datainventory['CONTENT']['HARDWARE']['NAME'];
   $input['uuid'] = $datainventory['CONTENT']['HARDWARE']['UUID'];
   $input['computertype_id'] = $computertype_id;
   $input['comment'] = '';
   $input['entity_id'] = 1;
   $computer = new Computer();
   $computer_id = $computer->add($input);


   // add software
   $software = new Software();
   $softwareVersion = new SoftwareVersion();
   $computer_SoftwareVersion = new Computer_SoftwareVersion();

   foreach ($datainventory['CONTENT']['SOFTWARES'] as $data_software) {
      $rows = $DB->dbh->table(Software::getTable());
      $rows = $rows->where('name', $data_software['NAME']);
      if ($rows->count()) {
         $row = $rows->fetch();
         $row_data = $row->getData();
         $software_id = $row_data['id'];
      } else {
         $input = array(
             'name'      => $data_software['NAME'],
             'comment'   => '',
             'entity_id' => 1
         );
         $software_id = $software->add($input);
      }


      $rows = $DB->dbh->table(SoftwareVersion::getTable());
      $rows = $rows->where('name', $data_software['VERSION']);
      $rows = $rows->where('software_id', $software_id);
      if ($rows->count()) {
         $row = $rows->fetch();
         $row_data = $row->getData();
         $softwareversion_id = $row_data['id'];
      } else {
         $input = array(
             'name'        => $data_software['VERSION'],
             'software_id' => $software_id,
             'comment'     => '',
             'entity_id'   => 1
         );
         $softwareversion_id = $softwareVersion->add($input);
      }



      $rows = $DB->dbh->table(Computer_SoftwareVersion::getTable());
      $rows = $rows->where('softwareversion_id', $softwareversion_id);
      if ($rows->count() == 0) {
         $input = array(
             'computer_id' => $computer_id,
             'softwareversion_id' => $softwareversion_id,
             'entity_id'   => 1
         );
         $computer_SoftwareVersion->add($input);
      }

   }
}


?>