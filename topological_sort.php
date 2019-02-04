<?php 
function _process_toposort($pointer, &$dependency, &$order, &$pre_processing, &$reportError){
    if(in_array($pointer, $pre_processing)) return false;
    else $pre_processing[] = $pointer;

    if(isset($dependency[$pointer])){
		if(is_array($dependency[$pointer])){
			foreach($dependency[$pointer] as $master){
				if(isset($dependency[$master])){
					if(!_process_toposort($master, $dependency, $order, $pre_processing, $reportError)) {
						$reportError = array($pointer, $master);
						return false;
						}
					}
				if(!in_array($master,$order)) $order[] = $master;
				$preProcessingKey = array_search($master, $pre_processing);
				if($preProcessingKey !== false) unset($pre_processing[$preProcessingKey]);
				}	
			}
		else{
			$master = $dependency[$pointer];
			if(isset($dependency[$master])){
				if(!_process_toposort($master, $dependency, $order, $pre_processing, $reportError)) {
					$reportError = array($pointer, $master);
					return false;
					}
				}
			if(!in_array($master,$order)) $order[] = $master;
			$preProcessingKey = array_search($master, $pre_processing);
			if($preProcessingKey !== false) unset($pre_processing[$preProcessingKey]);
			}
        }

    if(!in_array($pointer,$order)) $order[] = $pointer;
    $preProcessingKey = array_search($pointer, $pre_processing);
    if($preProcessingKey !== false) unset($pre_processing[$preProcessingKey]);
    return true;
    }
function _topological_sort($data, $dependency, &$reportError = null){
    $order = array();
    $pre_processing = array();
    foreach($data as $item){
        if(!_process_toposort($item,$dependency,$order, $pre_processing, $reportError)) return false;
        }
    return $order;
    }
