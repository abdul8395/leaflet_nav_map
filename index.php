<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

    <!-- Leaflet Plugin start -->
    <link rel="stylesheet" href="assets/lib/draw/leaflet.draw.css" />
  <script src="assets/lib/draw/leaflet.draw-custom.js"></script>
  <!-- End Leaflet Plugin -->

  <link rel="stylesheet" href="assets/lib/full_screen/leaflet.fullscreen.css">
  <script src="assets/lib/full_screen/Leaflet.fullscreen.min.js"></script>


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
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">page 1</a></li>
      <li><a href="#">Page 2</a></li>

    </ul>
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

var street   = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'),
    dark  = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png'),
    googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
                    maxZoom: 20,
                    subdomains:['mt0','mt1','mt2','mt3']
                });


 map = L.map('map', {
    center: [41.8719, 12.5674],
    layers: [street],
    zoom: 6
});
map.zoomControl.setPosition('bottomright');


var baseLayers = {
    "Street": street,
    "Satellite": googleSat,
    "Dark": dark,
};

L.control.layers(baseLayers,null,{collapsed:false}).addTo(map);




// var Points = $.getJSON("/AWIS/services/load_data.php", function(data) {  
//     console.log(data)          
//      for (var i = 0; i < data.length; i++) {
//       if(data[i].lat || data[i].long != null){
//        var location = new L.LatLng(data[i].lat, data[i].long);
//        var type = data[i].type;
//        var marker = new L.Marker(location, {
//          title: type
//        });
//        var message = 'Name: ' +data[i].Business_Name_or_Professional_Name+'<br>Comment: ' +data[i].Comments+'<br> Type:' +data[i].type;
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
        cityaddress:$('#Location_Name').val(),
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
</script>
