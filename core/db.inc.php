<?php
    
  class db {
  
    public static $format = '.json';
  
    public static function read($module, $id = null, $column = 'value') {
      if (file_exists(DEFAULTS.DIRECTORY_SEPARATOR.$module.self::$format)) {
        $array = json_decode(file_get_contents(DEFAULTS.DIRECTORY_SEPARATOR.$module.self::$format), true);
        if($id != null) {
          foreach ($array as $item) {
            if($item['id'] == $id) {
              return $item[$column];
            }
          }
        } else {
          return $array;
        }
      }
    }
    
  }
    
?>