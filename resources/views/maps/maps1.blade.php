<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Add a default marker</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<script src="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css" rel="stylesheet" />
<style>
	body { margin: 0; padding: 0; }
	#map { position: absolute; top: 0; bottom: 0; width: 100%; }
    .logo{
        position: absolute;
        z-index: 9999999;
        top: 0;
        width: 20px;
        height: 20px;
        
    }
</style>
</head>
<body>
<div id="map"></div>
<div id="logo" class="logo"><img src="{{asset('img/logoS.png')}}" width="280px" height="100px" ></div>
 
<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiY2xtYXJ0dCIsImEiOiJja2d1dHhsbmMweGJrMnhvMGxkZ3JyMHhkIn0.eOiEDUkc73p8lvq-k1Nexg';
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11',
center: [-57.2, -12.3],
zoom: 3
});
map.addControl(new mapboxgl.NavigationControl());


var SelectPanamericana = new mapboxgl.Marker()
.setLngLat([-46.710032,-23.553219])
.addTo(map);

var SelectPinheiros = new mapboxgl.Marker()
.setLngLat([-46.6923076,-23.5649318])
.addTo(map);

var VanG = new mapboxgl.Marker()
.setLngLat([-46.6996233,-23.5712419])
.addTo(map);

var FariaLima = new mapboxgl.Marker()
.setLngLat([-46.6880026,-23.5783464])
.addTo(map);


var SelectJK = new mapboxgl.Marker()
.setLngLat([-46.689546,-23.591202])
.addTo(map);



//--------------------------------------------
var Campinas = new mapboxgl.Marker()
.setLngLat([-47.0300128,-22.8939266])
.addTo(map);

var PortoAlegre = new mapboxgl.Marker()
.setLngLat([-51.1316935,-29.9937352])
.addTo(map);

var Ceara = new mapboxgl.Marker()
.setLngLat([-38.529808,-3.7266695])
.addTo(map);


//------------------------------------------







var popupVG = new mapboxgl.Popup({ offset: 25 }).setText(
'R. Butantã, 550 - Pinheiros, São Paulo - SP, 05424-000'
);
VanG.setPopup(popupVG)



var popupFariaLima = new mapboxgl.Popup({ offset: 25 }).setText(
'Av. Brg. Faria Lima, 2491 - Jardim Paulistano, São Paulo - SP, 01452-000 Horário: '
);

FariaLima.setPopup(popupFariaLima)



var popupSelectJK = new mapboxgl.Popup({ offset: 25 }).setText(
'Av. Pres. Juscelino Kubitschek, 2041 - Itaim Bibi'
);
SelectJK.setPopup(popupSelectJK)






var popupCampinas = new mapboxgl.Popup({ offset: 25 }).setText(
'Campinas'
);

Campinas.setPopup(popupCampinas)


var popupPortoAlegre = new mapboxgl.Popup({ offset: 25 }).setText(
'Porto Alegre'
);
PortoAlegre.setPopup(popupPortoAlegre)





var popupCeara = new mapboxgl.Popup({ offset: 25 }).setText(
'Rua Major Facundo, 414 - Centro, Fortaleza - CE, 60025-100'
);
Ceara.setPopup(popupCeara)
Ceara.style.backgroundColor= '#bd0026'


var popupPinheiro = new mapboxgl.Popup({ offset: 25 }).setText(
'R. Teodoro Sampaio, 2258 - Pinheiros, São Paulo - SP, 05406-150'
);
SelectPinheiros.setPopup(popupPinheiro)

var popupPanamericana = new mapboxgl.Popup({ offset: 25 }).setText(
'Praça Panamericana, 301 - Alto de Pinheiros, São Paulo - SP, 05461-000'
);
SelectPanamericana.setPopup(popupPanamericana)


</script>
 
</body>
</html>
