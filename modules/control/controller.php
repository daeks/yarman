<?php

require_once(dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR.'config.php');

if (network::get('action') != '') {
  switch (network::get('action')) {
    case 'restart':
      es::restart();
      network::success('Successfully Restarted Emulationstation', 'true');
      break;
    case 'reboot':
      system::reboot();
      network::success('Successfully Initiated Reboot', 'true');
      break;
    default:
      network::error('invalid action - '.network::get('action'));
      break;
  }
}

?>