<?php 
  session_start();

  ini_set('display_errors', 1); 
  error_reporting(E_ALL); 

  /**
   * @param mixed $status
   * @return String
   */
  function statusToBadge($status) {
    $status = strtolower($status);
    $status = str_replace(' ','-',$status);
    return $status;
  }

  /* Updated Pre Show Code generated using Gemini AI and adapted */
  // reserved variable used to track depth in new recursive preshow  
  $PRE_SHOW_DEPTH = 0; 
  /**
   * @param mixed $item
   * @return mixed 
   */
  function preshow($item)
  {
    global $PRE_SHOW_DEPTH;
    // If it's an array, loop through its elements and call the function recursively
    if (is_array($item)) {
      if (empty($item)) {
        $item = "--Empty Array--";
      } else {
        ++$PRE_SHOW_DEPTH;
        foreach ($item as $key => $value) {
          $item[$key] = preshow($value);
        }
        --$PRE_SHOW_DEPTH;
      }
    } elseif (is_string($item)) {
      if (empty($item))
        $item = "--Empty String--";
    } elseif (is_bool($item)) {
      $item = $item ? 'true' : 'false';
    }
    // For other types (int, float, etc.), the value is returned unchanged
    
    // echo "<br>debug: $PRE_SHOW_DEPTH";
    if($PRE_SHOW_DEPTH > 0) 
      return $item;
    else
      print '<pre>'.htmlspecialchars(print_r($item,true))."</pre>\n";
  }