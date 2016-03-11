<?php

      $index_admin = new ModuleAdmin();
      
      $index_admin->addInfoBox('id');
      $index_admin->addInfoBoxLine('id', sprintf("%1\$s : %2\$s", _AM_FAQ_ID_MODULE, $xoopsModule->getVar('mid')));
      $index_admin->addInfoBoxLine('id', sprintf("%1\$s : %2\$s", _AM_FAQ_FOLDER, $xoopsModule->getVar('dirname')));
      $index_admin->addInfoBoxLine('id', sprintf("%1\$s : %2\$01.2f %3\$s du %4\$s", _AM_FAQ_VERSION, ($xoopsModule->getVar('version')/100), $xoopsModule->modinfo['module_status'], date_format(date_create($xoopsModule->modinfo['release_date']),"d/m/Y")));
//       $index_admin->addInfoBoxLine('id', sprintf("%1\$s PHP: %2\$s", _AM_FAQ_MIN_VERSION, $xoopsModule->modinfo['min_php'])) ;    
//       $index_admin->addInfoBoxLine('id', sprintf("%1\$s XOOPS: %2\$s", _AM_FAQ_MIN_VERSION, $xoopsModule->modinfo['min_xoops'])) ;    
      
      $index_admin->addInfoBoxLine('id', sprintf("%1\$s : %2\$s", _AM_FAQ_AUTHORS, $xoopsModule->modinfo['author'])) ;    
      $index_admin->addInfoBoxLine('id', sprintf("%1\$s : <a href='%2\$s' target='blank'>%3\$s</a>", _AM_FAQ_WEB_SITE, $xoopsModule->modinfo['website_url'], $xoopsModule->modinfo['module_website_name'])) ;    


      //$index_admin->addInfoBox('tellafriend', '200px');
      $index_admin->addConfigBoxLine("----- Extra -----");
      $line = "<span style='color : %1\$s; font-weight : %2\$s;'>";
      $line .= "<img src='" . _FAQ_FW_ICONS_16 . "%3\$s.png' >%4\$s</span>\n";
      if (nsXfaq\isTellafriend()){
        $tellafriend = sprintf($line,'green','normal','1',_AM_TELLAFRIEND_OK);
      }else{
        $tellafriend = sprintf($line,'red','bold','0',_AM_TELLAFRIEND_NOT_OK);
      }
      $index_admin->addConfigBoxLine($tellafriend);

  //echoArray($xoopsModule);
//       $index_admin->addInfoBox('Changelog', '200px');
//       
//       
//       $changelog = file_get_contents(_FAQ_PATH . "/docs/changelog.txt");
//       $changelog = str_replace(array("\r\n","\n"),'<br />',$changelog);
//       $index_admin->addInfoBoxLine('Changelog', $changelog, '', '', 'information');    
//       
      
      
      echo $index_admin->addNavigation('index.php');
      
  
      echo  $index_admin->renderButton('right', '');
      
      echo $index_admin->renderIndex();

?>