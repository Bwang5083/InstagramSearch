<?php
if(!empty($_GET['location'])){
	//test location: disneyland.ca, disneyland.cn, disneyland.au
	//get a location's geographical information via google map api
	$maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$_GET['location'];
	//the response data type is JSON
	$maps_json = file_get_contents($maps_url);
	$maps_array = json_decode($maps_json, true);
	//get the location's latitude and longitude via google map api
	$lat = $maps_array['results'][0]['geometry']['location']['lat'];
	$lng = $maps_array['results'][0]['geometry']['location']['lng'];
	//search images on instagram website via latitude, longitude and client id
	$instagram_url = 'https://api.instagram.com/v1/media/search?lat='.$lat.'&lng='.$lng.'&client_id=b324e3217e9447b9800d8d99a7777773';
	$instagram_json = file_get_contents($instagram_url);
	$instagram_array = json_decode($instagram_json, true);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>geogram</title>
</head>
<body>
<form action="">
	<input type="text" name="location" placeholder="Input a domain name. For example: disneyland.ca" style="width:350px" />
	<button type="submit">submit</button>
	<br />
	<?php
	if(!empty($instagram_array)){
		foreach($instagram_array['data'] as $image){
			echo '<img src="'.
				$image['images']['low_resolution']['url'].'" alt=""/>';
		}
	}
	?>


</form>
</body>
</html>
