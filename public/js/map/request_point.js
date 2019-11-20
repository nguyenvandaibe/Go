function requestAddPoint(map, points, point)
{
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        url: '/plans/points/create/' + planId,
        data: {
            "order": point.order,
            "place": point.place,
            "place_lat": point.place_lat,
            "place_lng": point.place_lng,
            "arrive_time": point.arrive_time,
            "depature_time": point.depature_time,
            "vehicle": point.vehicle,
            "activity": "Hoạt động"
        },
        success: function() {

            points.push(point);

            refreshMap(map);

            refreshTable(points);    
        }
    });
}

function refreshDisPlay()
{
    $.ajax({
        type: 'GET',
        url: '/get/points/' + planId,
        dataType: 'json',
        success: function(response) {
            points = response;
            refreshMap(map);
            refreshTable(points);
        }
    });
}

function requestEditPoint()
{
    $('#button-edit').click(function(){
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: '/plans/points/edit/' + planId,
            data: {
                "old_order": $('#old_order').val(),
                "new_order": $('#new_order').val(),
                "place": $('#place').val(),
                "place_lat": $('#place_lat').val(),
                "place_lng": $('#place_lng').val(),
                "arrive_time": $('#arrive_time').val(),
                "depature_time": $('#depature_time').val(),
                "vehicle": $('#vehicle').val(),
                "activity": $('#activity').val()
            }
        });

        refreshDisPlay();
    });
}

$('#button-delete').click(function() {
    console.log(1);
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        url: '/plans/points/delete/' + planId,
        data: {
            "order": $('#deleting-order').val(),
        },

        success: function() {
            
            refreshDisPlay();
        }
    });

});


function requestAddPointManually(map, points)
{
    var point = {
        order: $('#adding-order').val(),
        place: $('#adding-place').val(),
        place_lat: $('#adding-place-lat').val(),
        place_lng: $('#adding-place-lng').val(),
        arrive_time: $('#adding-arrive-time').val(),
        depature_time: $('#adding-depature-time').val(),
        vehicle: $('#adding-vehicle').val(),
        activity: $('#adding-activity').val()
    }

    requestAddPoint(map, points, point);
}