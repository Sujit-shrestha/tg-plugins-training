
jQuery(document).on("click", '#wordpress_ajax_form_btn',
	function (event) {
		event.preventDefault();

		var form = jQuery('#wordpress_ajax_form').serialize();

		jQuery.ajax({
			url: my_ajax_obj.ajax_url,
			data: {
				'data': form,
				'action': 'custom_action',
				'author': my_ajax_obj.current_user_id,
				'nonce': my_ajax_obj.rua_nonce

			},
			type: 'post',
			success: function (result) {

				if (!result.success) {

					window.location.replace(result.data.redirect_url);

				} else {

					//Providing success message to the user
					jQuery("#wordpress_ajax_form").html("<h3>Role Added successfully. </h3>");

				}

			}
		});
	});

	