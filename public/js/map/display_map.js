
function setZoom(map)
{
	map.setCenter({lat:21.0283, lng:105.8536});
	map.setZoom(12);
}

//Step 1: initialize communication with the platform
var platform = new H.service.Platform({
  	apikey: "BC5Q0iO1Rs5gOLYo0VxWn5zkIb_Z5802ewGEids5cks"
});
var defaultLayers = platform.createDefaultLayers();

//Step 2: initialize a map - this map is centered over Europe
var map = new H.Map(document.getElementById('map'),
	defaultLayers.vector.normal.map,{
	center: {lat:24, lng:105},
	zoom: 4,
	pixelRatio: window.devicePixelRatio || 1
});
window.addEventListener('resize', () => map.getViewPort().resize());

//Step 3: make the map interactive
var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

var ui = H.ui.UI.createDefault(map, defaultLayers);

setZoom(map);