var points = JSON.parse($('#my_data').text()).points;

function calculateRoute (platform) {

	for (i = 0; i < points.length - 1; i++) {

		var router = platform.getRoutingService(),
		    routeRequestParams = {
		      	mode: 'fastest;car',
		      	representation: 'display',
		      	routeattributes : 'waypoints,summary,shape,legs',
		      	maneuverattributes: 'direction,action',
		      	waypoint0: points[i].place_lat + ',' + points[i].place_lng,
		      	waypoint1: points[i + 1].place_lat + ',' + points[i + 1].place_lng
		    };

		router.calculateRoute(
		    routeRequestParams,
		    onSuccess,
		    onError
		);
	}
}

function onSuccess(result) {

  	var route = result.response.route[0];
  	addRouteShapeToMap(route);
}

function onError(error) {
	alert('Can\'t reach the remote server');
}

function addRouteShapeToMap(route){
	var lineString = new H.geo.LineString(),
	    routeShape = route.shape,
	    polyline;

	routeShape.forEach(function(point) {
	    var parts = point.split(',');
	    lineString.pushLatLngAlt(parts[0], parts[1]);
	});

	polyline = new H.map.Polyline(lineString, {
	    style: {
	      	lineWidth: 4,
	      	strokeColor: 'rgba(0, 128, 255, 0.7)'
	    }
	});

  	map.addObject(polyline);

  	map.getViewModel().setLookAtData({
    	bounds: polyline.getBoundingBox()
  	});
}

calculateRoute(platform);