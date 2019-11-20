var points = JSON.parse($('#my_data').text()).points;

function displayMarker(map, behavior) {
	var newMarkers = [],
		group = new H.map.Group();
	for(i = 0; i < points.length; i++) {
		newMarkers[i] = new H.map.Marker({lat:points[i].place_lat, lng:points[i].place_lng}, {
    		volatility: true
  		});

  		newMarkers[i].draggable = true;

    	map.addEventListener('dragstart', function(ev) {
		    var target = ev.target,
		        pointer = ev.currentPointer;
		    if (target instanceof H.map.Marker) {
		      	var targetPosition = map.geoToScreen(target.getGeometry());
		      	target['offset'] = new H.math.Point(pointer.viewportX - targetPosition.x, pointer.viewportY - targetPosition.y);
		      	behavior.disable();
		    }
		}, false);

		map.addEventListener('dragend', function(ev) {
		    var target = ev.target;
		    if (target instanceof H.map.Marker) {
		      	behavior.enable();
		    }
		}, false);

		map.addEventListener('drag', function(ev) {
		    var target = ev.target,
		        pointer = ev.currentPointer;
		    if (target instanceof H.map.Marker) {
		      	target.setGeometry(map.screenToGeo(pointer.viewportX - target['offset'].x, pointer.viewportY - target['offset'].y));
		    }
		}, false);

		newMarkers[i].setData(points[i].place + '\n' + 'Thời điểm đến: ' + points[i].arrive_time + '\n ' + 'Thời điểm đi: ' + points[i].depature_time);


	}
	group.addObjects(newMarkers);

	group.addEventListener('tap', function (evt) {
	    var bubble =  new H.ui.InfoBubble(evt.target.getGeometry(), {
	      	content: evt.target.getData()
    	});

    	ui.addBubble(bubble);
	});

	map.addObject(group);

	map.getViewModel().setLookAtData({
		bounds: group.getBoundingBox()
	});
}
