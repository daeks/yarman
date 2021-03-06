<?php

require_once(dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR.'config.php');

if (network::get('action') != '') {
  switch (network::get('action')) {
    case 'config':
      switch (network::get('id')) {
        case 'db':
          cache::setClientVariable('admin_id', network::get('id'));
          $output = '';
          $output .= '<label>Datebase Statistics</label><br><ul>';
          foreach (array_slice(scandir(DATA), 2) as $item) {
            if (pathinfo($item, PATHINFO_EXTENSION) == 'sdb') {
              $output .= '<li>'.$item.' (Size: '.round(filesize(DATA.DIRECTORY_SEPARATOR.$item)/1024/1024, 2).'MB)<ul>';
              foreach (db::instance(pathinfo($item, PATHINFO_FILENAME))->read('schema') as $item) {
                $output .= '<li>Table '.$item['id'].' (v'.$item['version'].')</li>';
              }
              $output .= '</ul></li>';
            }
          }
          $output .= '</ul>';
          $output .= '<label>Datebase Backup</label>';
          $output .= '<br><button class="btn btn-success" type="submit" data-toggle="modal" data-target="#modal" href="/modules/control/dialog.php?action=backup">Backup YARMan DB</button>';
          $output .= ' <button class="btn btn-warning" type="submit" data-toggle="modal" data-target="#modal" href="/modules/control/dialog.php?action=restore">Restore YARMan DB</button>';
          $output .= '<br><hr><label>Reset '.NAME.'</label>';
          $output .= '<br><button class="btn btn-danger btn-xs" type="submit" data-toggle="modal" data-target="#modal" href="/modules/control/dialog.php?action=reset">Reset</button>';
          network::success($output);
          break;
        default:
          network::error('invalid id - '.network::get('id'));
          break;
      }
      break;
    case 'backup':
      modal::start('Backup '.NAME.' Database', CONTROLLER.'?action=backup');
      echo 'Do you really want to backup the database?';
      modal::end('Yes, please', 'success');
      break;
    case 'restore':
      modal::start('Restore '.NAME.' Database', CONTROLLER.'?action=restore', 'POST');
      echo '<label for="id">Select DB to restore</label>';
      echo '<select name="id" id="id" class="form-control">';
      echo '<option value="" selected>-- Select Backup --</option>';
      foreach (array_slice(scandir(DATA), 2) as $item) {
        if (pathinfo($item, PATHINFO_EXTENSION) == 'bak') {
          $parts = explode('.', pathinfo($item, PATHINFO_FILENAME));
          echo '<option value="'.$item.'">'.$item.' ('.date('Y/m/d H:i:s', $parts[2]).')</option>';
        }
      }
      echo '</select>';
      modal::end('Restore', 'warning');
      break;
    case 'reset':
      modal::start('Reset '.NAME.' to Default', CONTROLLER.'?action=reset');
      echo '<div class="alert alert-danger" role="alert"><b>Warning</b> This will delete all your own changes for '.NAME.'.</div>';
      modal::end('Reset '.NAME, 'danger');
      break;
    case 'restart':
      modal::start('Restart Emulationstation', CONTROLLER.'?action=restart');
      echo 'Do you really want to restart emulationstation?';
      modal::end('Restart', 'warning');
      break;
    case 'reboot':
      modal::start('Reboot System', CONTROLLER.'?action=reboot');
      echo 'Do you really want to restart the system?';
      modal::end('Reboot', 'danger');
      break;
    default:
      network::error('invalid action - '.network::get('action'));
      break;
  }
}

?>