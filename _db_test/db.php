<?php 
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	} else {
		$id = 118;
	}

	include('../site/wp-load.php');
	//include('../site/wp-content/themes/bones/library/inc/generic/m_super_dump.php');
	//$db = @mysql_connect("myocracy.org", "smolinksi", "rTnEhPG6H28rpYnQ") or trigger_error(mysql_error(),E_USER_ERROR);
	
	global $wpdb;

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

	//d($wpdb);
	d(count($users));
	d($users[$id]);

	$user = $users[700];
	//d($user);
	foreach($users as $old_id => $user) {
	//prep
			if($user['Profiletype'] == '1') {
				$user['Profiletype'] == 'politician';
			} else {				
				$user['Profiletype'] == 'voter';
			}
		  $name_p = explode(' ', $user['name']);
		  $fname = $name_p[0];
		  $lname = $name_p[count($name_p)-1];

	
		$user_id = email_exists( $user['email'] );
		//d($user_id);
		//d(null == $user_id);
		if( null == $user_id ) {
			d('no id');

		  // Generate the password and create the user
		  $password = wp_generate_password( 12, false );
		  $user_id = wp_create_user( $user['email'], $password, $user['email'] );
		  $u =get_userdata($user_id);
		  //d($u);
		  

		  // Set the nickname
		  wp_update_user(
		    array(
		      'ID'          			=>    $user_id,
		      'user_login'    			=>    $user['username'],
		      //'user_url'    			=>    $user['email'],
		      'user_email'    			=>    $user['email'],
		      'display_name'    		=>    $user['name'],
		      //'nickname'    			=>    $user['email'],
		      'first_name'    			=>    $fname,
		      'last_name'    			=>    $lname,
		      'description'    			=>    $user['Biography'],
		      //'user_registered'    		=>    $user['email'],
		      'role'    				=>    $user['Profiletype'],
		      'show_admin_bar_front'    =>    false
		    )
		  );
			
			add_user_meta( $user_id, 'template', $user['Template']);
			add_user_meta( $user_id, 'political_party', $user['Political Party']);
			add_user_meta( $user_id, 'office_sought', $user['Office Sought']);
			add_user_meta( $user_id, 'state', $user['State']);
			add_user_meta( $user_id, 'incumbent', $user['Incumbent']);
			add_user_meta( $user_id, 'newsfeed_type', $user['Newsfeed Type']);
			add_user_meta( $user_id, 'news_feed', $user['News Feed']);
			add_user_meta( $user_id, 'issues_i_support', $user['Issues I Support']);
			add_user_meta( $user_id, 'paypal_email_address', $user['PayPal Email Address']);
			add_user_meta( $user_id, 'profile_owner', $user['Profile Owner']);
			add_user_meta( $user_id, 'candidate_information', $user['Candidate Information']);

		  // Set the role
		  $user = new WP_User( $user_id );
		  $user->set_role( 'contributor' );

		  // Email the user
		  //wp_mail( $user['email'], 'Welcome!', 'Your Password: ' . $password );

		} else {
			d('update');
		  //$f =get_userdata($user_id);
		  //d($f);
		  wp_update_user(
		    array(
		      'ID'          			=>    $user_id,
		      'user_login'    			=>    $user['username'],
		      //'user_url'    			=>    $user['email'],
		      'user_email'    			=>    $user['email'],
		      'display_name'    		=>    $user['name'],
		      'user_nicename'    		=>    $user['name'],
		      //'nickname'    			=>    $user['email'],
		      'first_name'    			=>    $fname,
		      'last_name'    			=>    $lname,
		      'description'    			=>    $user['Biography'],
		      //'user_registered'    		=>    $user['email'],
		      'role'    				=>    $user['Profiletype']
		    )
		  );
			add_user_meta( $user_id, 'template', $user['Template']);
			add_user_meta( $user_id, 'political_party', $user['Political Party']);
			add_user_meta( $user_id, 'office_sought', $user['Office Sought']);
			add_user_meta( $user_id, 'state', $user['State']);
			add_user_meta( $user_id, 'incumbent', $user['Incumbent']);
			add_user_meta( $user_id, 'newsfeed_type', $user['Newsfeed Type']);
			add_user_meta( $user_id, 'news_feed', $user['News Feed']);
			add_user_meta( $user_id, 'issues_i_support', $user['Issues I Support']);
			add_user_meta( $user_id, 'paypal_email_address', $user['PayPal Email Address']);
			add_user_meta( $user_id, 'profile_owner', $user['Profile Owner']);
			add_user_meta( $user_id, 'candidate_information', $user['Candidate Information']);
		}
		//d($user_id);
	}