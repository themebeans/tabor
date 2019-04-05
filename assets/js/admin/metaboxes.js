jQuery( document ).ready( function( $ ) {

	var
	$videoSettings = $('#video_metabox').hide(),
	$linkSettings  = $('#link_metabox').hide(),
	$postFormat    = $('#post-formats-select input[name="post_format"]');

	$postFormat.each(function() {
		var $this = $(this);
		if( $this.is(':checked') ) {
			changePostFormat( $this.val() );
		}
	});

	$postFormat.change(function() {
		changePostFormat( $(this).val() );
	});

	function changePostFormat( val ) {
		$linkSettings.hide();
		$videoSettings.hide();

		if( val === 'video' ) {
			$linkSettings.hide();
			$videoSettings.show();
		}

		if( val === 'link' ) {
			$linkSettings.show();
			$videoSettings.hide();
		}
	}
});
