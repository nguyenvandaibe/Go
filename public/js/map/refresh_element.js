function reMoveAllMarkers(map)
{
    map.removeObjects(map.getObjects());
}

function refreshMap(map)
{
    reMoveAllMarkers(map);

    map.setZoom(12);

    displayPoint(map, points);
    
    calculateRoute(platform);
}

function refreshTable(points)
{
    $('#table2 tbody tr').remove();

    $.each(points, function(key, point) {

        $('#table2 tbody').append(
            $('<tr>').append(
                $('<td>').text(point.order),
                $('<td>').text(point.place),
                $('<td>').text(point.place_lat),
                $('<td>').text(point.place_lng),
                $('<td>').text(point.arrive_time),
                $('<td>').text(point.depature_time),
                $('<td>').text(point.vehicle),
                $('<td>').text(point.activity),
            )
        )
    });
 
    fillDataToForm();
}

