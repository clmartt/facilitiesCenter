<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Santander</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<script src="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<script src="{{asset('js/jquery.js')}}"></script>

<style>
	body { margin: 0; padding: 0; }
	#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>


</head>
<body>
    <!-- Just an image -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="z-index: 99">
    <img src="{{asset('img/logoS.png')}}" width="160" height="55">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="margin-left: 30px">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link " href="#" id="br">BRASIL <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#" id="sp">SP</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#" id="spCid">SÃO PAULO</a>
            </li>
            
          </ul>
        </div>
      </nav>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
<link
rel="stylesheet"
href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"
type="text/css"
/>


<div id="map"></div>
<div id="geocoder" class="geocoder"></div>
 





<style>
    .geocoder {
    position: absolute;
    z-index: 1;
    width: 50%;
    left: 50%;
    margin-left: -25%;
    top: 10px;
    }
    .mapboxgl-ctrl-geocoder {
    min-width: 100%;
    }
    #map {
    margin-top: 0px;
    }
    #marker {
    background-image: url("{{asset('img/pont.gif')}}");
    background-size:contain;
    background-repeat: no-repeat;
    width: 20px;
    height: 20px;

    cursor: pointer;
    }

    #markerSelect{
    background-image: url("{{asset('img/select.gif')}}");
    background-size:contain;
    background-repeat: no-repeat;
    width: 20px;
    height: 20px;

    cursor: pointer;
    }
 
    .mapboxgl-popup {
    max-width: 200px;
    }


    </style>

<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiY2xtYXJ0dCIsImEiOiJja2d1dHhsbmMweGJrMnhvMGxkZ3JyMHhkIn0.eOiEDUkc73p8lvq-k1Nexg';
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11',
center: [-57.2, -12.3],
zoom: 3
});



 //  variavel com as localizações
var ceara = [-38.5298147,-3.7264566];
var  PortoAlegre = [-51.1472081,-29.9934139];
var SelectJK = [-46.689546,-23.591202];
var VanG = [-46.6996233,-23.5712419];
var SelectPinheiros = [-46.6923076,-23.5649318];
var SelectPanamericana = [-46.710032,-23.553219];
var STrioJaneiro = [-43.175403, -22.905994]

//------------------------------------------------------------------------------------------------
// controle de mapas
map.addControl(
new MapboxGeocoder({
accessToken: mapboxgl.accessToken,
mapboxgl: mapboxgl
})
);
map.addControl(new mapboxgl.NavigationControl());
//--------------------------------------------------------------------------------------------------


// create the popup
var popupCeara = new mapboxgl.Popup({ offset: 25 }).setText(
'Banco Santander - Rua Major Facundo, 414 - Centro, Fortaleza - CE, 60025-100'
);

var popupPortoAlegre = new mapboxgl.Popup({ offset: 25 }).setText(
'Banco Santander - Av. Assis Brasil, 6536 - Sarandi, Porto Alegre - RS, 91140-000'
);

var popupSelectJK = new mapboxgl.Popup({ offset: 25 }).setText(
    'Banco Santander - Sede Banco Santander Agência 2050 - Pres. Juscelino Kubitschek, 2235 - Vila  Olímpia, São Paulo - SP, 13571-410'
);

var popupVanG = new mapboxgl.Popup({ offset: 25 }).setText(
'VANG'
);

var popupSelectPinheiros = new mapboxgl.Popup({ offset: 25 }).setText(
'Banco Santander - Butantã Agência 4782 - R. Butantã, 550 - Pinheiros, São Paulo - SP, 05424-000'
);

var popupSelectPanamericana = new mapboxgl.Popup({ offset: 25 }).setText(
'Banco Santander - Select Panamericana Agência 1729  - Praça Panamericana, 301 - Alto de Pinheiros, São Paulo - SP, 05461-000'
);

var popupSTrioJaneiro= new mapboxgl.Popup({ offset: 25 }).setText(
'Banco Santader Av. Graça Aranha, 4 - Centro, Rio de Janeiro - RJ, 20030-002'
);

//------------------------------------------------------------------------------------------

// Criando as divs que aparecem no mapa
var cearael = document.createElement('div');
cearael.id = 'marker';

var PortoAlegreel = document.createElement('div');
PortoAlegreel.id = 'marker';

var SelectJKel = document.createElement('div');
SelectJKel.id = 'marker';

var VanGel = document.createElement('div');
VanGel.id = 'marker';

var SelectPinheirosel = document.createElement('div');
SelectPinheirosel.id = 'marker';

var SelectPanamericanael = document.createElement('div');
SelectPanamericanael.id = 'markerSelect';

var STrioJaneiroel = document.createElement('div');
STrioJaneiroel.id = 'marker';

//---------------------------------------------------------------------------------------------------





// create the marker
new mapboxgl.Marker(cearael)
.setLngLat(ceara)
.setPopup(popupCeara) // sets a popup on this marker
.addTo(map);




// create the marker
new mapboxgl.Marker(PortoAlegreel)
.setLngLat(PortoAlegre)
.setPopup(popupPortoAlegre) // sets a popup on this marker
.addTo(map);


// create the marker
new mapboxgl.Marker(SelectJKel)
.setLngLat(SelectJK)
.setPopup(popupSelectJK) // sets a popup on this marker
.addTo(map);

// create the marker
new mapboxgl.Marker(VanGel)
.setLngLat(VanG)
.setPopup(popupVanG) // sets a popup on this marker
.addTo(map);


// create the marker
new mapboxgl.Marker(SelectPinheirosel)
.setLngLat(SelectPinheiros)
.setPopup(popupSelectPinheiros) // sets a popup on this marker
.addTo(map);

// create the marker
new mapboxgl.Marker(SelectPanamericanael)
.setLngLat(SelectPanamericana)
.setPopup(popupSelectPanamericana) // sets a popup on this marker
.addTo(map);

// create the marker
new mapboxgl.Marker(STrioJaneiroel)
.setLngLat(STrioJaneiro)
.setPopup(popupSTrioJaneiro) // sets a popup on this marker
.addTo(map);






document.getElementById('sp').addEventListener('click', function () {
   
    map.flyTo({
        
        center: [-48.5383422,-22.1446083],
        //center: [-50.8801486,-22.5305739],
        essential: true ,// this animation is considered essential with respect to prefers-reduced-motion
        zoom:6
    });
});

    document.getElementById('br').addEventListener('click', function () {
   
        map.flyTo({
            center: [-40.2, -12.3],
            //center: [-57.2, -12.3],
            essential: true ,// this animation is considered essential with respect to prefers-reduced-motion
            zoom:3
        });

    });

    document.getElementById('spCid').addEventListener('click', function () {
   
        map.flyTo({
           
            center: [-46.6363896,-23.550305],
            //center: [-46.8754957,-23.6821604],
            essential: true ,// this animation is considered essential with respect to prefers-reduced-motion
            zoom:10
        });

    });



</script>
 




<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>