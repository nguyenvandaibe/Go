var user = JSON.parse($('#user_data').text());

if (user.gender === 'male') {
	
    $('#gender-male').prop('checked', true);

} else {

    $('#gender-female').prop('checked', true);
}