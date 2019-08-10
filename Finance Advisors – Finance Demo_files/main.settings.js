(function( $ ) {
	function updateURLParameter( url, param, paramVal )
	{
		var TheAnchor = null;
		var newAdditionalURL = "";
		var tempArray = url.split( "?" );
		var baseURL = tempArray[0];
		var additionalURL = tempArray[1];
		var temp = "";

		if (additionalURL) 
		{
			var tmpAnchor = additionalURL.split( "#" );
			var TheParams = tmpAnchor[0];
				TheAnchor = tmpAnchor[1];
			if( TheAnchor )
				additionalURL = TheParams;

			tempArray = additionalURL.split( "&" );

			for ( i=0; i<tempArray.length; i++ )
			{
				if( tempArray[i].split('=')[0] != param )
				{
					newAdditionalURL += temp + tempArray[i];
					temp = "&";
				}
			}        
		}
		else
		{
			var tmpAnchor = baseURL.split( "#" );
			var TheParams = tmpAnchor[0];
				TheAnchor  = tmpAnchor[1];

			if( TheParams )
				baseURL = TheParams;
		}

		if( TheAnchor )
			paramVal += "#" + TheAnchor;

		var rows_txt = "";
		if( paramVal != "" ) rows_txt = temp + "" + param + "=" + paramVal;
		return baseURL + "?" + newAdditionalURL + rows_txt;
	}
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + "; " + expires;
	}

	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	jQuery( document ).ready(function() {
		
		var params = {};

		if (location.search) {
			var parts = location.search.substring(1).split('&');

			for (var i = 0; i < parts.length; i++) {
				var nv = parts[i].split('=');
				if (!nv[0]) continue;
				params[nv[0]] = nv[1] || true;
			}
		}	
		
		var $settings_wrap = "<div id='btSettingsPanel' class='btDarkSkin'><h4>Customize page</h4><div id='btSettingsPanelContent'></div></div>";
		jQuery( "body" ).prepend( $settings_wrap );
		
		jQuery( "#btSettingsPanel" ).append( "<div id='btSettingsPanelToggler'></div>" );
		
		jQuery( "#btSettingsPanelToggler" ).click( function() {
			jQuery( "#btSettingsPanel" ).toggleClass( "btSettingsPanelOpen" );
			if ( jQuery( "#btSettingsPanel" ).hasClass( "btSettingsPanelOpen" ) ) {
				setCookie( "btSettingsPanel", "open", 1 );	
			} else {
				setCookie( "btSettingsPanel", "closed", 1 );
			}
		});
		
		if( getCookie( "btSettingsPanel" ) == "open" ) {
			jQuery( "#btSettingsPanelToggler" ).trigger( "click" );
		}
		
		/* Page width */
		
		jQuery( "#btSettingsPanelContent" ).append( "<div class='btSettingsPanelRow btSettingsPageWidth'><h6>Page width</h6><select id='page_width'><option value='btWidePage'>Wide</option><option value='btBoxedPage'>Boxed</option></select></div>" );
		var bt_show_menu_width = true;
		if ( jQuery( "body" ).hasClass( "btBoxedPage" ) ) {
			jQuery( "#page_width" ).val( "btBoxedPage" );
			bt_show_menu_width = false;			
		} else {
			jQuery( "#page_width" ).val( "btWidePage" );	
		}
		jQuery( "#page_width" ).change(function() {
			val = jQuery( this ).val();
			if( val ) {
				newURL = updateURLParameter( window.location.href, 'page_width', val );
				if( jQuery( this ).val() == 'btBoxedPage' ) {
					newURL = updateURLParameter( newURL, 'page_background', 1687 );	
				} else {
					newURL = updateURLParameter( newURL, 'page_background', 0 );
				}
				window.open( newURL, '_self' );	
			}
		});
		
		/* Menu width */
		if ( bt_show_menu_width ) {
			jQuery( "#btSettingsPanelContent" ).append( "<div class='btSettingsPanelRow btSettingsMenuWidth'><h6>Menu width</h6><select id='boxed_menu'><option value='wide'>Wide</option><option value='boxed'>Boxed</option></select></div>" );
			if ( jQuery( ".mainHeader" ).hasClass( "gutter" ) ) {
				jQuery( "#boxed_menu" ).val( "boxed" );	
			} else {
				jQuery( "#boxed_menu" ).val( "wide" );	
			}
			jQuery( "#boxed_menu" ).change(function() {
				val = jQuery( this ).val();
				if( val ) {
					if( val == "boxed") {
						val = "true";
					} else {
						val = "false";
					}
					newURL = updateURLParameter( window.location.href, 'boxed_menu', val );
					
					window.open( newURL, '_self' );
				}
			});			
		}

		
		/* Header style */
		
		jQuery( "#btSettingsPanelContent" ).append( "<div class='btSettingsPanelRow'><h6>Header style</h6><select id='header_style'><option value='simple'>Simple</option><option value='btAccentDarkHeader'>Accent + Dark</option><option value='btAccentLightHeader'>Accent + Light</option></select></div>" );
		if ( jQuery( "body" ).hasClass( "btAccentDarkHeader" ) ) {
			jQuery( "#header_style" ).val( "btAccentDarkHeader" );	
		} else if ( jQuery( "body" ).hasClass( "btAccentLightHeader" ) ) {
			jQuery( "#header_style" ).val( "btAccentLightHeader" );	
		}
		jQuery( "#header_style" ).change(function() {
			val = jQuery( this ).val();
			if ( val ) {
				newURL = updateURLParameter( window.location.href, 'header_style', val );
				if ( val == "btAccentDarkHeader" || val == "btAccentLightHeader" ) {
					if ( jQuery( "body" ).hasClass( "btMenuRight" ) ) {
						newURL = updateURLParameter( newURL, 'menu_type', "hRightBelow" );
					} else if ( jQuery( "body" ).hasClass( "btMenuLeft" ) ) {
						newURL = updateURLParameter( newURL, 'menu_type', "hLeftBelow" );
					}
				} else {
					newURL = updateURLParameter( newURL, 'menu_type', "" );
				}
				// menu_type=hLeftBelow
				window.open( newURL, '_self' );	
			}

		});

		/* Accent color */
		
		jQuery( "#btSettingsPanelContent" ).append( "<div class='btSettingsPanelRow btAccentColorRow'><h6>Main color</h6><select id='accent_color'><option value='Default'>Default</option><option value='rgb(221,51,51)'>Red</option><option value='rgb(220,199,63)'>Orange</option><option value='rgb(129,215,66)'>Green</option><option value='rgb(30,115,190)'>Dark blue</option><option value='rgb(36,202,226)'>Light  blue</option></select></div>" );
		if( params.accent_color ) jQuery( "#accent_color" ).val( decodeURIComponent( params.accent_color ) );
		jQuery( "#accent_color" ).change(function() {
			val =  encodeURIComponent( jQuery( this ).val() );
			if( val ) {
				if ( val == "Default" ) {
					val = "";
				}
				newURL = updateURLParameter( window.location.href, 'accent_color', val );
				window.open( newURL, '_self' );	
			}
		});
		
		/* Alternate color */
		
		jQuery( "#btSettingsPanelContent" ).append( "<div class='btSettingsPanelRow btAlternateColorRow'><h6>Details color</h6><select id='alternate_color'><option value='Default'>Default</option><option value='rgb(255,127,0)'>Orange</option><option value='rgb(129,215,66)'>Green</option><option value='rgb(30,115,190)'>Blue</option></select></div>" );
		if( params.alternate_color ) jQuery( "#alternate_color" ).val( decodeURIComponent( params.alternate_color ) );
		jQuery( "#alternate_color" ).change(function() {
			val = encodeURIComponent( jQuery( this ).val() );
			if( val ) {
				if ( val == "Default" ) {
					val = "";
				}
				newURL = updateURLParameter( window.location.href, 'alternate_color', val );
				window.open( newURL, '_self' );	
			}
		});
		
		
		
		setTimeout(function(){ 
			$(".btAccentColorRow .options li, .btAlternateColorRow .options li").css('background', function () { 
				return $(this).data('raw-value');
			});
		}, 1000);


	});
	
	jQuery( document ).ready(function() {
	
});

})( jQuery );