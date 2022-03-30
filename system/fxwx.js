$('#vehicleSelectModalButton').click(function(){
	$( "#customerNameArea" ).html( val($('#vehicle_id')) );
});

function buttOption(n) {
	$('#targetDiv').html(n);
}

$('#closeButton').click(function(){
	$('#targetDiv').html($('#closeButton').text());
});

