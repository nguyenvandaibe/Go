var plan = JSON.parse($('#my_data').text()),
    planId = plan.id,
    points = plan.points,
    address = null;

function addNewPoint(map) {
  
    map.addEventListener('contextmenu', function (e) {

        if (e.target !== map) {
            return;
        }

        var coord  = map.screenToGeo(e.viewportX, e.viewportY),
            point = {};

        if (points.length > 0) {
            
            point.order = points.length + 1;
            point.arrive_time = points[points.length-1].depature_time;
            point.depature_time = points[points.length-1].depature_time;

        } else {

            point.order = 1;
            point.arrive_time = plan.created_at;
            point.depature_time = plan.created_at;
        }

        point.id = null;
        point.plan_id = planId;
        point.place_lat = Math.abs(coord.lat.toFixed(4));
        point.place_lng = Math.abs(coord.lng.toFixed(4));
        point.vehicle = 'Xe máy';
        point.activity = 'Hoạt động';

        /* Get address of target */
        $.ajax({
            url: 'https://reverse.geocoder.api.here.com/6.2/reversegeocode.json',
            type: 'GET',
            dataType: 'jsonp',
            jsonp: 'jsoncallback',
            data: {
                prox: point.place_lat + ',' + point.place_lng + ',0' ,
                mode: 'retrieveAddresses',
                maxresults: '1',
                gen: '9',
                app_id: 'e1k3B8PmHZdBmZxoxJRj',
                app_code: 'T-XQRwPXPv3gLJ_kGUnJpg'
            },
            success: function(data) {

                if (data.Response.View.length > 0) {

                    if (data.Response.View[0].Result.length > 0) {
                        point.place =  data.Response.View[0].Result[0].Location.Address.Label;
                    }
                }

            }
        });

        e.items.push(

            new H.util.ContextItem({
                label: [
                    Math.abs(coord.lat.toFixed(4)) + ((coord.lat > 0) ? 'N' : 'S'),
                    Math.abs(coord.lng.toFixed(4)) + ((coord.lng > 0) ? 'E' : 'W')
                ].join(' '),
            }),
        
            new H.util.ContextItem({
                label: 'Đặt làm trung tâm bản đồ',
                callback: function() {
                    map.setCenter(coord, true);
                }
            }),
          
            H.util.ContextItem.SEPARATOR,
            
            new H.util.ContextItem({
                label: 'Thêm điểm dừng chân',
                callback: function() {

                    requestAddPoint(map, points, point);
                }
            })
        );

    });
}

function addPoint(map, coord, point) {
    var newPoint = new H.map.Marker(coord, {
            volatility: true
        });
    
    newPoint.order = point['order'];

    newPoint.draggable = true;

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
    
    newPoint.addEventListener('contextmenu', function(e) {

        e.items.push(
            new H.util.ContextItem({
                label: [
                    e.target.b.lat.toFixed(4) + ((e.target.b.lat > 0) ? 'N' : 'S'),
                    e.target.b.lng.toFixed(4) + ((e.target.b.lng > 0) ? 'E' : 'W')
                ]
            }),

            new H.util.ContextItem({
                label: 'Đặt làm trung tâm bản đồ',
                callback: function() {
                    map.setCenter(coord, true);
                }
            }),

            H.util.ContextItem.SEPARATOR,

            new H.util.ContextItem({

                label: 'Sửa thông tin',
                callback: function() {
                    $('#old_order').val(points[newPoint.order - 1].order);
                    $('#new_order').val(points[newPoint.order - 1].order);
                    $('#place').val(points[newPoint.order - 1].place);
                    $('#place_lat').val(e.target.b.lat.toFixed(4));
                    $('#place_lng').val(e.target.b.lng.toFixed(4));
                    $('#arrive_time').val(points[newPoint.order - 1].arrive_time);
                    $('#depature_time').val(points[newPoint.order - 1].depature_time);
                    $('#vehicle').val(points[newPoint.order - 1].vehicle);
                    $('#activity').val(points[newPoint.order - 1].activity);
                    $('#deleting-order').val(points[newPoint.order - 1].order);

                    nonDisplayForm('new-point-container');
                
                    displayForm('edit-point-container');
                
                    displayForm('delete-point-container');

                    requestEditPoint();
                }
            }),

            new H.util.ContextItem({

                label: 'Xóa',
                callback: function() {
                    $('#deleting-order').val(point.order);
                    $('#button-delete').trigger('click');
                }
            }),
        );
    });
    
    return newPoint;
}

function displayPoint(map, points) {
    var group = new H.map.Group(),
        markers = [];

    for (i = 0; i < points.length; i++) {
        markers.push(addPoint(map, {lat:points[i].place_lat, lng:points[i].place_lng}, points[i]));
    }

    group.addObjects(markers);

    map.addObject(group);
    
    map.getViewModel().setLookAtData({
        bounds: group.getBoundingBox()
    });
}

function displayForm(elementId)
{
    var element = $('#' + elementId);

    if (element.css('display') == 'none') {
        element.show();
    }
}

function nonDisplayForm(elementId)
{
    var element = $('#' + elementId);

    if (element.css('display') != 'none') {
        element.hide();
    }
}


addNewPoint(map);

displayPoint(map, points);

nonDisplayForm('new-point-container');
                
nonDisplayForm('edit-point-container');

nonDisplayForm('delete-point-container');
