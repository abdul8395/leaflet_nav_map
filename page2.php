<!DOCTYPE html>
<html lang="en">
<head>
  <title>Italy Map</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

    <!-- Leaflet Plugin start -->
    <link rel="stylesheet" href="lib/draw/leaflet.draw.css" />
  <script src="lib/draw/leaflet.draw-custom.js"></script>
  <!-- End Leaflet Plugin -->

  <link rel="stylesheet" href="lib/full_screen/leaflet.fullscreen.css">
  <script src="lib/full_screen/Leaflet.fullscreen.min.js"></script>

  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>



  <style>
    #map{
        width:100%;
        height: calc(100vh - 52px);
        margin-top: -20px !important;
    }
  </style>
</head>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
    <li class="active"><a href="index.php">Home</a></li>
      <li><a href="page1.php">page 1</a></li>
      <li><a href="page2.php.">Page 2</a></li>

    </ul>
    <div class="navbar-form navbar-left">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="cityinput" id="cityinput">
        <div class="input-group-btn">
          <button class="btn btn-default" onclick="inputcity_to_latlng()" >
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
  </div>
  </div>
</nav>
  
<div id="map">

  <div class="modal fade" id="insert_modal" role="dialog">
        <div class="modal-dialog vertical-align-center">
          <div class="modal-content">
            <form id="insert_modal_form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Insert Data Details</h4>
              </div>
              <div class="modal-body"> 
                <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="Location_Name" id="Location_Name" placeholder="Location Name">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" id="savebtn" onclick="savedata()">Save</button>
                <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
</div>


</body>
</html>

<script>
    var map
var drawlat
var drawlng

var googlestreet   = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
      maxZoom: 20,
      subdomains:['mt0','mt1','mt2','mt3']
      })


 map = L.map('map', {
    center: [41.8719, 12.5674],
    layers: [googlestreet],
    zoom: 6,
    attributionControl: false,
});
map.zoomControl.setPosition('bottomright');


// var baseLayers = {
//     "Street": street,
//     "Satellite": googleSat,
//     "Dark": dark,
// };


// var lgeocoder=L.Control.geocoder().addTo(map);





// var Points = $.getJSON("/italy_map_order/services/load_data.php", function(data) {  
//   // var Points = $.getJSON("services/json_from_db.json", function(data) {  
//     console.log(data)          
//      for (var i = 0; i < data.length; i++) {
//       if(data[i].lat || data[i].lng != null){
//        var location = new L.LatLng(data[i].lat, data[i].lng);
//        var type = data[i].type;
//        var marker = new L.Marker(location, {
//          title: type
//        });
//        var message = 'Location Name: ' +data[i].location_name;
//        marker.bindPopup(message);
//        map.addLayer(marker);
      
//       }  
//      }
// });



// Initialise the FeatureGroup to store editable layers
  var drawnItems = L.featureGroup().addTo(map);
  var drawControl = new L.Control.Draw({
      position: 'topright',
      draw: {
          circle: false,
          rectangle: false,
          polyline: false,
          polygon: false,  
          marker: true,
          circlemarker: false,
          

      },
      edit: {featureGroup: drawnItems, edit: false, remove: false}
  }).addTo(map);

  map.on('draw:created', function (e) {
    layer = e.layer;
     drawlat = '';
     drawlng = '';
     drawlat = layer.getLatLng().lat;
     drawlng = layer.getLatLng().lng;
    $('#insert_modal').modal('show');

  });

  map.addControl(new L.Control.Fullscreen({
    title: {
    'false': 'View Fullscreen',
    'true': 'Exit Fullscreen'
    },
    position: 'topright'
  }));


  
  function savedata() {
    var reqdata={
        drawlat: drawlat,
        drawlng:drawlng,
        Location_Name:$('#Location_Name').val(),
    };
    $.ajax({
        type: "post",
        url: "services/savedata.php",
        // dataType : "json",
        data:{data:reqdata},
        success: function (res) {
          $('#insert_modal').modal('hide');
          $('#insert_modal_form').trigger("reset");
          console.log(res)
          if(res='true'){
            alert('Data Saved Successfully.....')
          }
            // var r=JSON.parse(res)
           
        }
    });
}




function inputcity_to_latlng(){
  var inputcity=$("#cityinput").val()
  getcitylatlng(inputcity);

}
function getcitylatlng(cityname){
  $.get(location.protocol + '//nominatim.openstreetmap.org/search?format=json&q='+cityname, function(getdata){
    if(getdata.length>0){
      // alert("lat:"+ getdata[0].lat+",lng:"+getdata[0].lon);
      var reqdata={
        lat: getdata[0].lat,
        lng:getdata[0].lon,
      };
      $.ajax({
        type: "post",
        url: "services/get_inputcity_latlng.php",
        // dataType : "json",
        data:{data:reqdata},
        success: function (res) {
          console.log(res)
        }
      });
    }
  });
}
// getcitylatlng('london');

// L.control.layers(baseLayers,null,{collapsed:false}).addTo(map);
</script>
