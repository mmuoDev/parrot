 
 // use Google Maps API to reverse geocode our location
function getAddress (location) 
{
    // set up the Geocoder object
    var geocoder = new google.maps.Geocoder();
    // find out info about d location
    var results, ans;
    geocoder.geocode( { 'latLng': location }, function (results, status) 
    {
		var ans =  results[0].formatted_address;	    
	});
	return JSON.stringify(ans);
}



