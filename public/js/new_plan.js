function moveMapToHanoi(map) {
  	map.setCenter({lat:21.028971, lng:105.853803});
  	map.setZoom(12);
}

function setUpClickListener(map) {
	map.addEventListener('tap', function (evt) {
	    var coord = map.screenToGeo(evt.currentPointer.viewportX, evt.currentPointer.viewportY);
	    logEvent('Clicked at ' + Math.abs(coord.lat.toFixed(4)) + ((coord.lat > 0) ? 'N' : 'S') + ' ' + Math.abs(coord.lng.toFixed(4)) + ((coord.lng > 0) ? 'E' : 'W'));
	});
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

// Step 4: create custom logging facilities
var logContainer = document.createElement('ul');
logContainer.className ='log';
logContainer.innerHTML = '<li class="log-entry">Nhấp chuột vào vị trí bất kì trên bản đồ.</li>';
map.getElement().appendChild(logContainer);

// Helper for logging events
function logEvent(str) {
  	var entry = document.createElement('li');
  	entry.className = 'log-entry';
  	entry.textContent = str;
  	logContainer.insertBefore(entry, logContainer.firstChild);
}


window.onload = function () {
  	moveMapToHanoi(map);
}
setUpClickListener(map);