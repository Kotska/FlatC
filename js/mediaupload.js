jQuery(document).ready(function($) {

	var mediaUploader;

	$('#upload-button-svg').on('click', function(e){
		e.preventDefault();
		if(mediaUploader){
			mediaUploader.open();
			return;
		}

		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose a logo',
			button: {
				text: 'Choose Logo',
			},
			multiple: false
		});

		mediaUploader.on('select', function(){
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#logo-svg').val(attachment.url);
		});

		mediaUploader.open();
	});

	var mediaUploader2;

	$('#upload-button-loading').on('click', function(e){
		e.preventDefault();
		if(mediaUploader2){
			mediaUploader2.open();
			return;
		}

		mediaUploader2 = wp.media.frames.file_frame = wp.media({
			title: 'Choose a logo',
			button: {
				text: 'Choose Logo',
			},
			multiple: false
		});

		mediaUploader2.on('select', function(){
			attachment = mediaUploader2.state().get('selection').first().toJSON();
			$('#loading-svg').val(attachment.url);
		});

		mediaUploader2.open();
	});

	// Uploading files
	var file_frame;

    // Mobile image
	jQuery.fn.upload_mobile_image = function( button ) {
		var button_id = button.attr('id');
		var field_id = button_id.replace( '_button', '' );

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: jQuery( this ).data( 'uploader_title' ),
		  button: {
		    text: jQuery( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  var attachment = file_frame.state().get('selection').first().toJSON();
		  jQuery("#"+field_id).val(attachment.id);
		  jQuery("#mobileimagediv img").attr('src',attachment.url);
		  jQuery( '#mobileimagediv img' ).show();
		  jQuery( '#' + button_id ).attr( 'id', 'remove_mobile_image_button' );
		  jQuery( '#remove_mobile_image_button' ).text( 'Remove mobile image' );
		});

		// Finally, open the modal
		file_frame.open();
	};

	jQuery('#mobileimagediv').on( 'click', '#upload_mobile_image_button', function( event ) {
		event.preventDefault();
		jQuery.fn.upload_mobile_image( jQuery(this) );
	});

	jQuery('#mobileimagediv').on( 'click', '#remove_mobile_image_button', function( event ) {
		event.preventDefault();
		jQuery( '#upload_mobile_image' ).val( '' );
		jQuery( '#mobileimagediv img' ).attr( 'src', '' );
		jQuery( '#mobileimagediv img' ).hide();
		jQuery( this ).attr( 'id', 'upload_mobile_image_button' );
		jQuery( '#upload_mobile_image_button' ).text( 'Set mobile image' );
    });
    

    // Desktop image
    jQuery.fn.upload_desktop_image = function( button ) {
		var button_id = button.attr('id');
		var field_id = button_id.replace( '_button', '' );

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: jQuery( this ).data( 'uploader_title' ),
		  button: {
		    text: jQuery( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  var attachment = file_frame.state().get('selection').first().toJSON();
		  jQuery("#"+field_id).val(attachment.id);
		  jQuery("#desktopimagediv img").attr('src',attachment.url);
		  jQuery( '#desktopimagediv img' ).show();
		  jQuery( '#' + button_id ).attr( 'id', 'remove_desktop_image_button' );
		  jQuery( '#remove_desktop_image_button' ).text( 'Remove desktop image' );
		});

		// Finally, open the modal
		file_frame.open();
	};

	jQuery('#desktopimagediv').on( 'click', '#upload_desktop_image_button', function( event ) {
		event.preventDefault();
		jQuery.fn.upload_desktop_image( jQuery(this) );
	});

	jQuery('#desktopimagediv').on( 'click', '#remove_desktop_image_button', function( event ) {
		event.preventDefault();
		jQuery( '#upload_desktop_image' ).val( '' );
		jQuery( '#desktopimagediv img' ).attr( 'src', '' );
		jQuery( '#desktopimagediv img' ).hide();
		jQuery( this ).attr( 'id', 'upload_desktop_image_button' );
		jQuery( '#upload_desktop_image_button' ).text( 'Set desktop image' );
    });
    
    // Tablet image
    jQuery.fn.upload_tablet_image = function( button ) {
		var button_id = button.attr('id');
		var field_id = button_id.replace( '_button', '' );

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: jQuery( this ).data( 'uploader_title' ),
		  button: {
		    text: jQuery( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  var attachment = file_frame.state().get('selection').first().toJSON();
		  jQuery("#"+field_id).val(attachment.id);
		  jQuery("#tabletimagediv img").attr('src',attachment.url);
		  jQuery( '#tabletimagediv img' ).show();
		  jQuery( '#' + button_id ).attr( 'id', 'remove_tablet_image_button' );
		  jQuery( '#remove_tablet_image_button' ).text( 'Remove tablet image' );
		});

		// Finally, open the modal
		file_frame.open();
	};

	jQuery('#tabletimagediv').on( 'click', '#upload_tablet_image_button', function( event ) {
		event.preventDefault();
		jQuery.fn.upload_tablet_image( jQuery(this) );
	});

	jQuery('#tabletimagediv').on( 'click', '#remove_tablet_image_button', function( event ) {
		event.preventDefault();
		jQuery( '#upload_tablet_image' ).val( '' );
		jQuery( '#tabletimagediv img' ).attr( 'src', '' );
		jQuery( '#tabletimagediv img' ).hide();
		jQuery( this ).attr( 'id', 'upload_tablet_image_button' );
		jQuery( '#upload_tablet_image_button' ).text( 'Set tablet image' );
    });
    
    

});