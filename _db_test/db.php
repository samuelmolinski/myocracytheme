<?php 
	include('../site/wp-content/themes/bones/library/inc/generic/m_super_dump.php');
	//$db = @mysql_connect("myocracy.org", "smolinksi", "rTnEhPG6H28rpYnQ") or trigger_error(mysql_error(),E_USER_ERROR);

	//$link = mysqli_connect("myocracy.org","smolinksi","rTnEhPG6H28rpYnQ","elewis_myocracy") or die("Error " . mysqli_error($link));
	$link = mysqli_connect("localhost","smolinksi","rTnEhPG6H28rpYnQ","elewis_myocracy") or die("Error " . mysqli_error($link));
	/*//mysql_select_db("elewis_myocracy");

	$query  = mysql_query( "SELECT jos_community_fields_values.user_id, jos_community_fields_values.field_id, jos_community_fields_values.value, jos_users.* FROM jos_users LEFT JOIN jos_community_fields_values ON jos_users.id = jos_community_fields_values.user_id ");

	print_r($query);*/
	$database_name = 'elewis_myocracy';

	function myFunction()
	{
	  global $database_name, $link;
	  $retArr = array();

	  $link->select_db($database_name);
	  $query_queryLookup = "SELECT jos_community_fields_values.value, jos_users.*, jos_community_fields.name AS fname FROM (jos_users LEFT JOIN jos_community_fields_values ON jos_users.id = jos_community_fields_values.user_id) LEFT JOIN jos_community_fields ON jos_community_fields_values.field_id = jos_community_fields.id";	  
	 // $query_queryLookup = "SELECT jos_community_fields.tips, jos_community_fields.fieldcode, jos_community_fields_values.field_id, jos_community_fields_values.value, jos_users.*, jos_community_fields.name AS fname FROM (jos_users LEFT JOIN jos_community_fields_values ON jos_users.id = jos_community_fields_values.user_id) LEFT JOIN jos_community_fields ON jos_community_fields_values.field_id = jos_community_fields.id";
	  $queryLookup = $link->query($query_queryLookup) or die(__FUNCTION__.': '.$link->error);
	  $row_queryLookup = $queryLookup->fetch_assoc();
	  $totalRows_queryLookup = $queryLookup->num_rows;
	  
	  if($totalRows_queryLookup>0)
	  {
	    do {
	      array_push($retArr,$row_queryLookup);
	    } while ($row_queryLookup = $queryLookup->fetch_assoc());
	  }

	  $queryLookup->free();

	  return $retArr;

	} // end function myFunction()

	$results = myFunction();
	//d($results);

	$users = array();

	foreach($results as $key => $entry)  {
		foreach ($entry as $propertyname => $property) {
			$users[$entry['id']][$propertyname] = $property;
		}
		$users[$entry['id']][$entry['fname']] = $entry['value'];
		unset($users[$entry['id']]['fname']);
		unset($users[$entry['id']]['value']);
	}

	d(count($users));
	d($users);