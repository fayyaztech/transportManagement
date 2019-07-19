var url;
jQuery(document).ready(function($) {
	url = $("#url").val();
	console.log(url);
});

$("#submit_btn").click(function(event) {
	var consignor_id = $("#consignor").val();
	var file_option = $("#file_option").val();

	console.log(url+"freight/download_excel_sample?consignor_id="+consignor_id+"&file_option="+file_option);

	$("#download_link").attr("href",url+"freight/download_excel_sample?consignor_id="+consignor_id+"&file_option="+file_option);
	$("#download_link").trigger('click');

});

