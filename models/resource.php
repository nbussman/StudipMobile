<?

namespace Studip\Mobile;

require_once $GLOBALS['RELATIVE_PATH_RESOURCES'] . "/lib/ResourceObject.class.php";


class Resource
{
	static function getResources( $course )
	{	
		$resources =array();
    	//for cycleDates
	    foreach ($course->metadate->cycles AS $cycle_date)
	    {
		    $metadate_id = $cycle_date->metadate_id;
		    $termine = \CycleDataDB::getTermine($metadate_id);
		    
		    //filtern aller Ressourcen für den Termin
		    $resourcesForTermin = array();
		    foreach ($termine AS $termin)
		    {
			    if (($termin["resource_id"]!="") && (!in_array($termin["resource_id"], $resourcesForTermin)))
			    {
				    //wenn resource_id gefunden in array packen
				    array_push($resourcesForTermin, $termin["resource_id"]);
			    }
		    }
		    // alle rescourcen für das aktuelle cycle sind in $resourcesForTermin
		    
		    //durchlaufen aller Ressourcen für den Termin
		    foreach ($resourcesForTermin AS $resourceID)
		    {
			    $location = Resource::getLocationForResource($resourceID);
				 	$resources[$metadate_id]["id"]   = $resourceID;
				 	$resources[$metadate_id]["name"] = Resource::getResourceName($resourceID);
				 	$resources[$metadate_id]["longitude"] = $location["longitude"];
				 	$resources[$metadate_id]["latitude"]  = $location["latitude"];   
		    }
		    
	    }
	    return $resources;
	}
	
	function getLocationForResource($resourceID)
	{
		// checken ob ressource eine loaction hat
		//wenn nicht wird beim Parent bis level 1 gesucht 
		$location = array();
		$level = 1;
		$long = Resource::getResourceLongitude($resourceID);
		$lat  = Resource::getResourcelatitude($resourceID);
		while ( (empty($location)) && ($level > 0))
		{
			if ((!empty($long)) && (!empty($lat)))
			{
				//location gefunden. in array schreiben
				$location["longitude"] = $long;
		 		$location["latitude"]  = $lat;
				break;
			}
			else
			{
				//gucken ob parrent resource eine location hat 
				$parent     = Resource::getResourceParent($resourceID);
				$resourceID = $parent["parent_id"];
				$long 		= Resource::getResourceLongitude($resourceID);
				$lat  		= Resource::getResourcelatitude($resourceID);
				$level 		= $parent["level"];			
			}
		}
		return $location;
	}


    function getResourceName($resourceID)
    {
	    	// nachschlagen des namens
	    	$query = "SELECT name, parent_id, resource_id FROM resources_objects WHERE resource_id = '$resourceID'";
			$stmt = \DBManager::get()->query($query);
		    $result = $stmt->fetchAll();
		    
		    
		    //nachschlagen des namens des parents
		    $parent_id = $result[0]["parent_id"];
		    $query2 = "SELECT name, resource_id FROM resources_objects WHERE resource_id = '$parent_id'";
			$stmt = \DBManager::get()->query($query2);
		    $result2 = $stmt->fetchAll();
		    
		    if (($result == true) && ($result2 == true)) 	return $result[0]["name"]." / ".$result2[0]["name"];
		    return false;
    }
    function getResourceLongitude($resourceID)
    {
	    	$query = "SELECT * FROM locations WHERE resource_id = '$resourceID'";
			$stmt = \DBManager::get()->query($query);
		    $result = $stmt->fetchAll();
		    if ($result == true) 	return $result[0]["longitude"];
		    return false;
    }
    function getResourcelatitude($resourceID)
    {
	    	$query = "SELECT * FROM locations WHERE resource_id = '$resourceID'";
			$stmt = \DBManager::get()->query($query);
		    $result = $stmt->fetchAll();
		    return $result[0]["latitude"];    
	}
	
	function getResourceParent($resourceID)
    {
	    	$query = "SELECT parent_id, level, resource_id FROM resources_objects WHERE resource_id = '$resourceID'";
			$stmt = \DBManager::get()->query($query);
		    $result = $stmt->fetchAll();
		    if ($result == true) 	return $result[0];
		    return false;   
	}

}

?>