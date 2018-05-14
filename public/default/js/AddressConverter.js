


function codeAddress(address) {

   var geocoder = new google.maps.Geocoder();
    var loc=[];

    // next line creates asynchronous request
    geocoder.geocode( { 'address': address}, function(results, status) {
      // and this is function which processes response
      if (status == google.maps.GeocoderStatus.OK) {
        loc[0]=results[0].geometry.location.lat();
        loc[1]=results[0].geometry.location.lng();

       alert(""); // the place where loc contains geocoded coordinates

      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });

    // pretty meaningless, because it always will be []
    // this line is executed right after creating AJAX request, but not after its response comes
    return loc;
  }

