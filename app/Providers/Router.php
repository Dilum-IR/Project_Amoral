<?php
$GLOBALS['router'] = array();
function route($url, $classData){
   $classDataArray = explode('@', $classData);
   $class = $classDataArray[0];
   $function = isset($classDataArray[1])?$classDataArray[1]:'index';
   $GLOBALS['router'][$url] = array('class'=>$class, 'function'=> $function);
}