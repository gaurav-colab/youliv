$(document).ready(function(){
	

	$("[data-action]").click(function(e) {
	  e.preventDefault();
	  var action = $(this).data('action');
	  var type = $(this).data('type');
	  var url = $(this).data('url');
	  var id = $(this).data('id');
	  // var token = '';
	  // console.log(action);
	  var typeinmessage = (type == 'property_detail') ? 'Property Detail' : (type == 'property_status') ? 'Property' : type;
	  if(action == 'delete' ){
			swal({
			  title: "Are you sure you want to "+ action + " this " + typeinmessage + "?",
			  text: "",
			  type: "warning",
			  buttons: {
			cancel: {
			  text: "Cancel",
			  value: null,
			  visible: true,
			  className: "btn btn-info",
			  closeModal: true,
			},
			confirm: {
			  text: "OK",
			  value: true,
			  visible: true,
			  className: "btn btn-info",
			  closeModal: true
			}
		  },
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
					$.get(url + "/"+ type +"/"+id + "/"+  action,function(result){
						// Here
						// table.ajax.reload();
						
			  if(result.status == 'success'){
				  swal({
				  title: "Deleted",
				  text: typeinmessage+" deleted successfully.",
				  type: "success",
				  timer: 3000,	
				   showConfirmButton: false,
			   });
			   
				 setTimeout(function(){
				   window.location.reload(1);
				}, 3000);
			  }else if (result.status == 'error') {
				swal({
				  title: "Something went wrong",
				  text: "",
				  type: "warning",
				  showConfirmButton: false,
			   });
			  }
			   });
			  } else {
				// swal("Delete Cancelled!", "", "error");
			swal("Delete Canceled", {
				  icon: "error",
			  buttons: false,
			  timer: 500,
			    showConfirmButton: false,
				});
			  }
		});
	  }
	  else if(action == 'Publish' || action == 'Unpublish'){
			swal({
			  title: "Are you sure you want to "+ action + " this " + typeinmessage + "?",
			  text: "",
			  type: "warning",
			  buttons: {
			cancel: {
			  text: "Cancel",
			  value: null,
			  visible: true,
			  className: "btn btn-info",
			  closeModal: true,
			},
			confirm: {
			  text: "OK",
			  value: true,
			  visible: true,
			  className: "btn btn-info",
			  closeModal: true
			}
		  },
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
					$.get(url + "/"+ type +"/"+id + "/"+  action,function(result){
						// Here
						// table.ajax.reload();
						
			  if(result.status == 'success'){
				  swal({
				  title: action,
				  text: "Property " +action+"ed  successfully.",
				  type: "success",
				  timer: 3000,	
				   showConfirmButton: false,
			   });
			   
				 setTimeout(function(){
				   window.location.reload(1);
				}, 3000);
			  }else if (result.status == 'error') {
				swal({
				  title: "Something went wrong",
				  text: "",
				  type: "warning",
				  showConfirmButton: false,
			   });
			  }
			   });
			  } else {
				// swal("Delete Cancelled!", "", "error");
			swal("Cancelled", {
				  icon: "error",
			  buttons: false,
			  timer: 500,
			    showConfirmButton: false,
				});
			  }
		});
	  }
	  else if (action == 'edit') {
		window.location.href = url + "/"+  type +"/"+id + "/"+  action;
	  }
	  // console.log($(this).data('id'));
	});
	
	 setTimeout(function(){
				  $(".alert").fadeOut("slow");
				}, 3000);
	
});