var showCheckbox = true;

function showCheckboxes() {
    var checkboxes =
        document.getElementById("checkBoxes");

    if (showCheckbox) {
        checkboxes.style.display = "block";
        showCheckbox = false;
    } else {
        checkboxes.style.display = "none";
        showCheckbox = true;
    }
}


function showFlatCheckboxes() {

    var checkboxes =
        document.getElementById("flatCheckBoxes");

    if (showCheckbox) {
        checkboxes.style.display = "block";
        showCheckbox = false;
    } else {
        checkboxes.style.display = "none";
        showCheckbox = true;
    }
}


$(document).ready(function() {

    // Upload Multiple Images Section
    $(".btn-success").click(function() {
        var html = $(".clone").html();
        $(".increment").after(html);
    });
    $("body").on("click", ".btn-danger", function() {
        $(this).parents(".upload_image_clone").remove();
    });
    // Upload Multiple Images Section



    var sid = $("#state").val();
    if (sid) {
        $.ajax({
            type: "get",
            url: "city/" + sid,
            success: function(res) {
                $("#city").empty();
                $("#address_city").append('<option value="">Select City</option>');
                $.each(res, function(key, value) {
                    $("#city").append('<option value="' + value.id + '">' + value.city_name + '</option>');
                });
            }
        })
    }
    $("#state").change(function() {
        var sid = $(this).val();
        if (sid) {
            $.ajax({
                type: "get",
                url: "city/" + sid,
                success: function(res) {
                    $("#city").empty();
                    $("#city").append('<option value="">Select City</option>');
                    $.each(res, function(key, value) {
                        $("#city").append('<option value="' + value.id + '">' + value.city_name + '</option>');
                    });
                }
            })
        }
    })
    if ($('.property-list-data').length > 0) {
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "property_list_data",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'property_id', name: 'property_id' },
                    { data: 'property_name', name: 'property_name' },
                    { data: 'owner_name', name: 'owner_name' },
                    { data: 'complete_address', name: 'complete_address' },
                    { data: 'property_type_view', name: 'property_type_view' },
                    { data: 'total_bedrooms', name: 'total_bedrooms' },
                    { data: 'owner_name', name: 'owner_name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    }

    if ($('#add_property_page').length > 0) {
        var business_model = $("input[name='business_model']:checked").val();
        var water_connection = $("input[name='water_connection']:checked").val();
        var parking_area = $("input[name='parking_area']:checked").val();
        var common_area = $("input[name='common_area']:checked").val();
        var dining_area = $("input[name='dining_area']:checked").val();
        var washing_area = $("input[name='washing_area']:checked").val();
        if (business_model == 1) {
            $("#revenue_sharing_section").css("display", "block");
        } else if (business_model == 2) {
            $("#leased_section").css("display", "block");
        }
        if (water_connection == 1) {
            $("#water_tank_capacity").attr("disabled", false);
            $("#water_tank_quantity").attr("disabled", false);
        } else if (water_connection == 2) {
            $("#water_tank_capacity").attr("disabled", true);
            $("#water_tank_quantity").attr("disabled", true);
        }
        if (parking_area == 1) {
            $("#parking_area_value").attr("disabled", false);
        } else if (parking_area == 2) {
            $("#parking_area_value").attr("disabled", true);
        }
        if (common_area == 1) {
            $("#common_area_value").attr("disabled", false);
        } else if (common_area == 2) {
            $("#common_area_value").attr("disabled", true);
        }
        if (dining_area == 1) {
            $("#dining_area_value").attr("disabled", false);
        } else if (dining_area == 2) {
            $("#dining_area_value").attr("disabled", true);
        }
        if (washing_area == 1) {
            $("#washing_area_value").attr("disabled", false);
        } else if (washing_area == 2) {
            $("#washing_area_value").attr("disabled", true);
        }

        $('input[type=radio][name=business_model]').change(function() {
            if (this.value == 1) {
                $("#revenue_sharing_section").css("display", "block");
                $("#leased_section").css("display", "none");
            } else if (this.value == 2) {
                $("#revenue_sharing_section").css("display", "none");
                $("#leased_section").css("display", "block");
            }
        });
        $('input[type=radio][name=water_connection]').change(function() {
            if (this.value == 1) {
                $("#water_tank_capacity").attr("disabled", false);
                $("#water_tank_quantity").attr("disabled", false);
            } else if (this.value == 2) {
                $("#water_tank_capacity").attr("disabled", true);
                $("#water_tank_quantity").attr("disabled", true);
            }
        });
        $('input[type=radio][name=parking_area]').change(function() {
            if (this.value == 1) {
                $("#parking_area_value").attr("disabled", false);
            } else if (this.value == 2) {
                $("#parking_area_value").attr("disabled", true);
            }
        });
        $('input[type=radio][name=common_area]').change(function() {
            if (this.value == 1) {
                $("#common_area_value").attr("disabled", false);
            } else if (this.value == 2) {
                $("#common_area_value").attr("disabled", true);
            }
        });
        $('input[type=radio][name=dining_area]').change(function() {
            if (this.value == 1) {
                $("#dining_area_value").attr("disabled", false);
            } else if (this.value == 2) {
                $("#dining_area_value").attr("disabled", true);
            }
        });
        $('input[type=radio][name=washing_area]').change(function() {
            if (this.value == 1) {
                $("#washing_area_value").attr("disabled", false);
            } else if (this.value == 2) {
                $("#washing_area_value").attr("disabled", true);
            }
        });
    }

    function getAreaManagerInfo(area_manager_id) {

        $.ajax({
            type: "get",
            url: "getAreaManagerInfo/" + area_manager_id,
            success: function(res) {
                $("#area_manager_phone").val(res.phone);
            }
        })
    }
    $("#area_manager_id").change(function() {
        var area_manager_id = $("#area_manager_id").val();
        if (area_manager_id == "") {
            $("#area_manager_phone").val("");
        } else {
            getAreaManagerInfo(area_manager_id);

        }
    });
    var area_manager_id = $("#area_manager_id").val();
    if (area_manager_id == "") {
        $("#area_manager_phone").val("");
    } else {
        getAreaManagerInfo(area_manager_id);

    }



    $("input[name='identity_proof_with_same_address']").click(function() {

        var is_same_address_proof = $("input[name='identity_proof_with_same_address']:checked").val();
        if (is_same_address_proof == 2) {
            $("#owner_id_proof_different_address").prop('disabled', false);
        } else {
            $("#owner_id_proof_different_address").prop('disabled', true);
        }
    });

    var is_same_address_proof = $("input[name='identity_proof_with_same_address']:checked").val();
    if (is_same_address_proof == 2) {
        $("#owner_id_proof_different_address").prop('disabled', false);
    } else {
        $("#owner_id_proof_different_address").prop('disabled', true);
    }

    var additional_information_count = 1;
    $("#add_more_additional").click(function() {

        if (additional_information_count < 5) {
            additional_information_count++;

            var html = '<div class="form-group row"><div class="col-md-10"><input class="form-control"  type="text" name="additional_information[]" placeholder="Enter additional Information" value=""></div><div><button class="btn btn-primary-custom remove_button" id="remove_button" type="button">Remove</button></div></div>';

            $(".add_info").append(html);
        }

    });
    $("body").on("click", ".remove_button", function() {
        additional_information_count--;
        $(this).parents(".form-group").remove();
    });

	var max_fields      = 5; //maximum input boxes allowed
		var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID
		
		var x = $('#count_add').val(); //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div><input class="form-control" style="margin-bottom:10px;margin-top:10px;width:600px" type="text" name="additional_information[]" placeholder="Enter additional Information" value=""/><a href="#" class="remove_field btn btn-primary-custom remove_button">Remove</a></div>'); //add input box
			}
		});
	
		$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
		})
});

 $("#owner_Id").change(function() {
        var sid = $(this).val();
        $('#ownerId').val(sid);
		//$('#ownerFormMsg').show();
		$('#required_owner_contact').html('');
		$("#area_manager_id").prop("disabled",false);
    })

