$(document).ready(function(){
	$('#selection_day').css('visibility', 'hidden');
	$('#selection_week').css('visibility', 'hidden');
	$('#selection_month').css('visibility', 'hidden');
	$('#selection_year').css('visibility', 'hidden');
	$('#selection2_day').css('visibility', 'hidden');
	$('#selection2_week').css('visibility', 'hidden');
	$('#selection2_month').css('visibility', 'hidden');
	$('#selection2_year').css('visibility', 'hidden');
	$('#selection3_day').css('visibility', 'hidden');
	$('#selection3_week').css('visibility', 'hidden');
	$('#selection3_month').css('visibility', 'hidden');
	$('#selection3_year').css('visibility', 'hidden');
	$('#selection2').css('visibility', 'hidden');
	$('#selection3').css('visibility', 'hidden');
});
const ok1 = document.querySelector('#ok1');
	const selector1 = document.querySelector('#selection1')
	ok1.onclick = (event) => {
		event.preventDefault();
		//alert(selector1.value);
		$('#selection1').prop( "disabled", true );
		$('#ok1').css('visibility', 'hidden');
		$('#selection2').css('visibility', 'visible');
		$('#selection2_' + selector1.value).css('visibility', 'visible');
	};
const okday = document.querySelector('#okday');
	const selector1_2 = document.querySelector('#selection1')
	okday.onclick = (event) => {
		event.preventDefault();
		//alert(selector1_2.value);
		$('#selection2_' + selector1.value).prop( "disabled", true );
		$('#okday').css('visibility', 'hidden');
		$('#selection3').css('visibility', 'visible');
		$('#selection3_' + selector1_2.value).css('visibility', 'visible');
	};
