var url = $("#url").val();

$(document).ready(function($){
	load_expenses();
})

$(document).on('click','#delete_expense',function(e){
	e.preventDefault();
	var c = confirm("do you want to delete this expense");
	if (c == true) {
		$.get(url+"maintenance/delete_expense?expense_id="+$(this).attr('expense_id'),function(data){
			if (data == '1') {
				alert("success deleted");
				location.reload();
			}else{
				alert(data);
			}
		})
	}
})
$("#add_expense").click(function(event) {
    $.ajax({
        url: url + "operations/add_expense",
        method: "POST",
        success: function(data) {
            $('#modal-id').html(data);
        }
    })
});


$(document).on('submit','#add_expense_form',function(e){
	e.preventDefault();
	$.ajax({
		url: url+'maintenance/add_expense',
		type: 'POST',
		data: new FormData(this),
		contentType:false,
		cache:false,
		processData:false,
		success: function(data){
			if (data == '1') {
				alert("success");
				location.reload();
			}else{
				alert(data);
			}
		}
	})
})

function load_expenses(){
	$.get(url+"maintenance/get_expenses",function(data){
		$("#expense_data").html(data);
	})
}