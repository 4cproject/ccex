function changeOrganizationTpe(){
  var org_type_name = $("#profileForm #organization_type option:selected").text();
  if(org_type_name == "Other"){
  	$("#profileForm #organisation_type_other_container").show();
  }else{
  	$("#profileForm #organisation_type_other_container").hide();
  }
}


function updateProfile(){
	var profileInfo = {};

	$("#profileForm #_message_container").hide();

	$("#profileForm :input").each(function(idx,ele){
		profileInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
	});

	if($('input[name="organization[linked_cost_data]"]').is(':checked')){
		profileInfo['organization[linked_cost_data]'] = 1;
	}else{
		profileInfo['organization[linked_cost_data]'] = 0;
	}

	if($('input[name="organization[linked_data_provider]"]').is(':checked')){
		profileInfo['organization[linked_data_provider]'] = 1;
	}else{
		profileInfo['organization[linked_data_provider]'] = 0;
	}

	profileInfo['organization[share_information]'] = $('input[name="organization[share_information]"]:checked').val();
	profileInfo['organization[share_data]'] = $('input[name="organization[share_data]"]:checked').val();

	$.ajax({
		url:'index.php?option=com_ccex&controller=edit&format=raw&tmpl=component',
		type:'POST',
		data:profileInfo,
		dataType:'JSON',
		success:function(data){
			$("#profileForm #_message_container").removeClass("alert-success");
			$("#profileForm #_message_container").removeClass("alert-danger");
			if ( data.success ){
				$("#profileForm #_message_container").addClass("alert-success");
			}else{
				$("#profileForm #_message_container").addClass("alert-danger");
			}
			$("#profileForm #_message_container #_message").text(data.message);
			$("#profileForm #_message_container").show();
		}
	});
}
