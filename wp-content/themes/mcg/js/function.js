$(document).ready(function(){
	//[thien.nguyen] convert main menu text to upper case
	// $('#main-menu-wrapper a').each(function(){
	// 	$(this).text($(this).text().toUpperCase());
	// });
	$(".contact-form span:contains('required')").text('*');
	$(".contact-form input[type='submit']").val('Gửi yêu cầu');
});