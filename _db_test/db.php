<?php 
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	} else {
		$id = 118;
	}

	include('../wp-load.php');
	//include('../site/wp-content/themes/bones/library/inc/generic/m_super_dump.php');
	//$db = @mysql_connect("myocracy.org", "smolinksi", "rTnEhPG6H28rpYnQ") or trigger_error(mysql_error(),E_USER_ERROR);
	
	global $wpdb;

	$issueTable = array (
  13 => 50,
  14 => 51,
  15 => 52,
  16 => 53,
  17 => 54,
  18 => 55,
  19 => 56,
  20 => 57,
  118 => 58,
  119 => 59,
  129 => 60,
  134 => 61,
  77 => 62,
  78 => 63,
  79 => 64,
  80 => 65,
  81 => 66,
  82 => 67,
  83 => 68,
  84 => 69,
  86 => 70,
  87 => 71,
  37 => 72,
  38 => 73,
  40 => 74,
  41 => 75,
  42 => 76,
  43 => 77,
  44 => 78,
  85 => 79,
  113 => 80,
  114 => 81,
  120 => 82,
  124 => 83,
  132 => 84,
  133 => 85,
  45 => 86,
  46 => 87,
  47 => 88,
  48 => 89,
  49 => 90,
  50 => 91,
  51 => 92,
  52 => 93,
  88 => 94,
  89 => 95,
  126 => 96,
  127 => 97,
  130 => 98,
  131 => 99,
  97 => 100,
  98 => 101,
  99 => 102,
  102 => 103,
  103 => 104,
  104 => 105,
  105 => 106,
  106 => 107,
  107 => 108,
  108 => 109,
  109 => 110,
  110 => 111,
  111 => 112,
  112 => 113,
  116 => 114,
  117 => 115,
  121 => 116,
  61 => 117,
  62 => 118,
  63 => 119,
  64 => 120,
  65 => 121,
  66 => 122,
  67 => 123,
  68 => 124,
  122 => 125,
  123 => 126,
  128 => 127,
);

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
	$count = 0;
	foreach($users as $old_id => $user) {
		if($count >10000){
			break;
		} else {
			//$count++;
		}
	//prep
			if($user['Profiletype'] == '1') {
				$user['Profiletype'] = 'politician';
			} else {				
				$user['Profiletype'] = 'voter';
			}
		  $name_p = explode(' ', $user['name']);
		  $fname = $name_p[0];
		  $lname = $name_p[count($name_p)-1];

	
		$user_id = email_exists( $user['email'] );
		d($user_id);
		d($user['email']);
		if(( null == $user_id )&&("sjmolinski@gmail.com" != $user['email'])&&("samuel@cabanacriacao.com" != $user['email'])) {
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
			
			
	 		if($user['Template'])
				update_user_meta( $user_id, 'template', $user['Template']);
	 		if($user['Political Party'])
				update_user_meta( $user_id, 'political_party', $user['Political Party']);
			if($user['Office Sought'])
				update_user_meta( $user_id, 'office_sought', $user['Office Sought']);
			if($user['State'])
				update_user_meta( $user_id, 'state', $user['State']);
			if($user['Incumbent'])
				update_user_meta( $user_id, 'incumbent', $user['Incumbent']);
			if($user['Newsfeed Type'])
				update_user_meta( $user_id, 'newsfeed_type', $user['Newsfeed Type']);
			if($user['News Feed'])
				update_user_meta( $user_id, 'news_feed', $user['News Feed']);
			if($user['PayPal Email Address'])
				update_user_meta( $user_id, 'paypal_email_address', $user['PayPal Email Address']);
			if($user['Profile Owner'])
				update_user_meta( $user_id, 'profile_owner', $user['Profile Owner']);
			if($user['Candidate Information'])
				update_user_meta( $user_id, 'candidate_information', $user['Candidate Information']);
			//update_user_meta( $user_id, 'wp_capabilities', 'a:1:{s:10:"politician";b:1;}');
			//update_user_meta( $user_id, 'user_image', '/2013/08/537875_505473366168213_621401172_n.png');

			if($user['Issues I Support']) {
				$string = explode('-', $user['Issues I Support']);
				$issue = array();
				foreach ($string as $key => $value) {
					d($value);
					d($issueTable[$value]);
					$issue[] = (string)$issueTable[$value];
				}
				d($issue);
				//$ser = serialize($issue);
				d($ser);

				update_user_meta( $user_id, 'issues_i_support', $issue);
			}
		  // Set the role
		  //$user = new WP_User( $user_id );
			/*if($user['Profiletype'] == 'politician') {
		  		$user->set_role( 'politician' );
		  	}*/

		  // Email the user
		  //wp_mail( $user['email'], 'Welcome!', 'Your Password: ' . $password );

		} else {
			d('update');
			d($user);
		  //$f =get_userdata($user_id);
		  //d($f);
		  if(("sjmolinski@gmail.com" != $user['email'])&&("samuel@cabanacriacao.com" != $user['email'])) {
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
		 		if($user['Template'])
					update_user_meta( $user_id, 'template', $user['Template']);
		 		if($user['Political Party'])
					update_user_meta( $user_id, 'political_party', $user['Political Party']);
				if($user['Office Sought'])
					update_user_meta( $user_id, 'office_sought', $user['Office Sought']);
				if($user['State'])
					update_user_meta( $user_id, 'state', $user['State']);
				if($user['Incumbent'])
					update_user_meta( $user_id, 'incumbent', $user['Incumbent']);
				if($user['Newsfeed Type'])
					update_user_meta( $user_id, 'newsfeed_type', $user['Newsfeed Type']);
				if($user['News Feed'])
					update_user_meta( $user_id, 'news_feed', $user['News Feed']);
				if($user['PayPal Email Address'])
					update_user_meta( $user_id, 'paypal_email_address', $user['PayPal Email Address']);
				if($user['Profile Owner'])
					update_user_meta( $user_id, 'profile_owner', $user['Profile Owner']);
				if($user['Candidate Information'])
					update_user_meta( $user_id, 'candidate_information', $user['Candidate Information']);
				//update_user_meta( $user_id, 'wp_capabilities', 'a:1:{s:10:"politician";b:1;}');
				//update_user_meta( $user_id, 'user_image', '/2013/08/537875_505473366168213_621401172_n.png');


				if($user['Issues I Support']) {
					$string = explode('-', $user['Issues I Support']);
					$issue = array();
					foreach ($string as $key => $value) {
						d($value);
						d($issueTable[$value]);
						if($value){
							$issue[] = (string)$issueTable[$value];
						}
					}
					d($issue);
					//$ser = serialize($issue);
					d($ser);

					update_user_meta( $user_id, 'issues_i_support', $issue);
				}
			}
		}
		//d($user_id);
	}