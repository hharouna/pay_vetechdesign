$(document).ready(function(e) {
    
	$(document).on("click","button.btn-confrime",function(){
			var cpm_amount =$(this).attr('cpm_amount');
			var cpm_currency =$(this).attr('cpm_currency');
			var cpm_site_id=$(this).attr('cpm_site_id');
			var cpm_trans_id=$(this).attr('cpm_trans_id');
			var cpm_trans_date=$(this).attr('cpm_trans_date');
			var cpm_payment_config=$(this).attr('cpm_payment_config');
			var cpm_page_action  =$(this).attr('cpm_page_action');
			var cpm_version=$(this).attr('cpm_version');
			var cpm_language=$(this).attr('cpm_language');
			var cpm_designation=$(this).attr('cpm_designation');
			var cpm_custom=$(this).attr('cpm_custom');
			var apikey=$(this).attr('apikey');
			/*
			$.post( "https://api.cinetpay.com/v1/?method=getSignatureByPost", { cpm_amount: cpm_amount, cpm_currency:cpm_currency,
			 cpm_site_id:cpm_site_id, cpm_trans_id:cpm_trans_id, cpm_trans_date:cpm_trans_date,
			 cpm_payment_config:cpm_payment_config, cpm_page_action: cpm_page_action, cpm_version:cpm_version, 
			 cpm_language:cpm_language, cpm_designation:cpm_designation, cpm_custom:cpm_custom,
			 apikey:apikey }, function( data ) {
               alert(data)
}, "json");
			*/
				var uName="abc";
				var passwrd="pqr";
				//headers:{"X-Requested-With": "XMLHttpRequest"},
				$.ajax({
				url:"https://api.cinetpay.com/v1/?method=getSignatureByPost",
				method:"POST",
				Type:"POST", 
				dataType: "json",
				headers : {"X-Requested-With": "XMLHttpRequest"			
				},
				data: { cpm_amount: cpm_amount, cpm_currency:cpm_currency,
				cpm_site_id:cpm_site_id, cpm_trans_id:cpm_trans_id, cpm_trans_date:cpm_trans_date,
				cpm_payment_config:cpm_payment_config, cpm_page_action: cpm_page_action, cpm_version:cpm_version, 
				cpm_language:cpm_language, cpm_designation:cpm_designation, cpm_custom:cpm_custom,
				apikey:apikey},
				
				success: function(data)
				{ 
				alert(data)
				}, 
				
				})		
	
		})
	
	
	
});