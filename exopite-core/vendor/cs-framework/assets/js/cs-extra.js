jQuery( document ).ready(function() {

    jQuery('<input id="searchbox" type="text" placeholder="Search" />').insertAfter('.cs-header h1');
    jQuery('#searchbox').css('margin-left', '30px');
    jQuery.expr[':'].Contains = function(a, i, m) {
      return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
    };

    jQuery('#searchbox').on('keyup', function() {
      var w = jQuery(this).val();
      if (w) {
        jQuery('.cs-body').addClass('cs-show-all');
        jQuery('.cs-title h4').closest('.cs-element').not('.hidden').hide();
        jQuery('.cs-field-notice').hide();
        jQuery('.cs-title h4:Contains('+w+')').closest('.cs-element').not('.hidden').show();
      } else {
        jQuery('.cs-body').removeClass('cs-show-all');
        jQuery('.cs-title h4').closest('.cs-element').not('.hidden').show();
        jQuery('.cs-field-notice').show();
      }
    });

    jQuery( '.cs-section .cs-section-title h3' ).on( 'click', function() {

        // Clear search
        jQuery('#searchbox').val( '' );

        //Get clicked element
        var tabSection = jQuery( this ).closest('.cs-section').attr('id');
        tabSection = tabSection.replace( 'cs-tab-', '' );

        // Deactivate all first
        jQuery( '.cs-section-active' ).removeClass( 'cs-section-active' );
        jQuery( '.cs-tab-active' ).removeClass( 'cs-tab-active' );
        jQuery( '.cs-section' ).hide();
        jQuery( '.cs-sub ul' ).hide();

        // Then activate clicked section
        jQuery( 'a[data-section="' + tabSection + '"]' ).addClass( 'cs-section-active' );
        jQuery( '#cs-tab-' + tabSection ).show();

        // If subsection, activate the "main" tab too
        if ( tabSection.match(/sub_section/) ) {
            var $mainTab = jQuery( '.cs-section-active' ).closest( '.cs-sub' );
            $mainTab.addClass( 'cs-tab-active' );
            $mainTab.find( 'ul' ).show();
        }

        // Restore tab view
        jQuery('.cs-body').removeClass('cs-show-all');
        jQuery('.cs-title h4').closest('.cs-element').not('.hidden').show();
        jQuery( '.cs-field-notice' ).show();

        // Scroll to top
        setTimeout(function(){

            var top = jQuery( '#wpbody' ).offset().top - jQuery( '#wpadminbar' ).height();

            jQuery('html, body').animate({
                scrollTop: top
            }, 200);

        }, 200);

    });

    // Font field
    jQuery( '.cs_font_field' ).each(function() {
        var parentName = jQuery( this ).attr( 'data-id' );
        var preview = jQuery( this ).find( '#preview-' + parentName );
        var fontColor = jQuery( this ).find( '.wp-picker-input-wrap input' );
        var fontSize = jQuery( this ).find( '.font-size input' );
        var lineHeight = jQuery( this ).find( '.line-height input' );
        var fontFamily = jQuery( this ).find( '.cs-typo-family' );
        var fontWeight = jQuery( this ).find( '.chosen.cs-typo-variant' );

        // Set current values to preview
        updatePreview( preview, fontColor, fontSize, lineHeight );
        loadGoogleFont( this, parentName, fontFamily, fontWeight );

        // Update preview
        function updatePreview( preview, fontColor, fontSize, lineHeight ) {
            preview.css( 'color', fontColor.val() ).css( 'font-size', fontSize.val() + 'px' ).css( 'line-height', lineHeight.val() + 'px' );
        }

        // Load selected Google font
        function loadGoogleFont( element, parentName, fontFamily, fontWeight ) {

            var font = fontFamily.val();
            if ( ! font) return;
            var fontWeightStyle = calculateFontWeight( fontWeight.find(':selected').text() );
            // Generate font loading html
            var href= '//fonts.googleapis.com/css?family=' + font + ':' + fontWeightStyle.fontWeightValue;
            var html = '<link href="' + href + '" class="cs-font-preview-' + parentName + '" rel="stylesheet" type="text/css" />';

            if ( jQuery( '.cs-font-preview-' + parentName ).length > 0 ) {
                jQuery( '.cs-font-preview-' + parentName ).attr( 'href', href ).load();
            } else {
                jQuery('head').append( html ).load();
            }

            // Update preiew
            preview.css( 'font-family', font ).css( 'font-weight', fontWeightStyle.fontWeightValue ).css( 'font-style', fontWeightStyle.fontStyleValue );

        }

        // Calculte font weight
        function calculateFontWeight( fontWeight ) {
            var fontWeightValue = '400';
            var fontStyleValue = 'normal';

            switch( fontWeight ) {
                case '100':
                    fontWeightValue = '100';
                    break;
                case '100italic':
                    fontWeightValue = '100';
                    fontStyleValue = 'italic';
                    break;
                case '300':
                    fontWeightValue = '300';
                    break;
                case '300italic':
                    fontWeightValue = '300';
                    fontStyleValue = 'italic';
                    break;
                case '500':
                    fontWeightValue = '500';
                    break;
                case '500italic':
                    fontWeightValue = '500';
                    fontStyleValue = 'italic';
                    break;
                case '700':
                    fontWeightValue = '700';
                    break;
                case '700italic':
                    fontWeightValue = '700';
                    fontStyleValue = 'italic';
                    break;
                case '900':
                    fontWeightValue = '900';
                    break;
                case '900italic':
                    fontWeightValue = '900';
                    fontStyleValue = 'italic';
                    break;
                case 'italic':
                    fontStyleValue = 'italic';
                    break;
            }

            return { fontWeightValue, fontStyleValue };
        }

        // Font family and weight change event
        jQuery( fontFamily ).add( fontWeight ).change(function() {
            loadGoogleFont( this, parentName, fontFamily, fontWeight );
        });

        // Font size, line height and weight change event
        fontColor.add( fontSize ).add( lineHeight ).change(function() {
            updatePreview( preview, fontColor, fontSize, lineHeight );
        });
    });

    // Shadow field
    jQuery('.cs-field-shadow').each(function() {
        var $horizontal = jQuery( this ).find('.horizontal-length');
        var $vertical = jQuery( this ).find('.vertical-length');
        var $blur = jQuery( this ).find('.blur-radius');
        var $spread = jQuery( this ).find('.spread-radius');
        var $color = jQuery( this ).find('.color');
        var $preview = jQuery( this ).find('.shadow-preview-box');

        $horizontal.add( $vertical ).add( $blur ).add( $spread ).add( $color ).change(function(){
            updatePreview( $horizontal.val(), $vertical.val(), $blur.val(), $spread.val(), $color.val() );
        });

        updatePreview( $horizontal.val(), $vertical.val(), $blur.val(), $spread.val(), $color.val() );

        function updatePreview( horizontal, vertical, blur, spread, color ) {
            $preview.css( 'box-shadow', horizontal + 'px ' + vertical + 'px ' + blur + 'px ' + spread + 'px ' + color );
        }
    });

    // Border field
    jQuery('.cs-field-border').each(function() {
        var $width = jQuery( this ).find('.width');
        var $style = jQuery( this ).find('.style');
        var $color = jQuery( this ).find('.color');
        var $preview = jQuery( this ).find('.border-preview-box');

        $width.add( $style ).add( $color ).change(function(){
            updatePreview( $width.val(), $style.val(), $color.val() );
        });

        updatePreview( $width.val(), $style.val(), $color.val() );

        function updatePreview( width, style, color ) {
            $preview.css( 'border-bottom', width + 'px ' + style + ' ' + color );
        }
    });

    jQuery('.cs-field-background_preview').each(function() {
        var $inputField = jQuery(this).find('input');
        var $imagePreviewContainer = jQuery(this).find('.cs-image-preview');
        var $imagePreview = $imagePreviewContainer.find('.cs-preview');

        $inputField.change(function(){
            if ( $inputField.val().length > 0 ) {
                $imagePreview.css('background-image', "url('" + $inputField.val() + "')");
                $imagePreview.find('img').addClass('hidden');
                $imagePreviewContainer.removeClass('hidden');
            } else {
                $imagePreview.css('background-image', '');
                $imagePreviewContainer.addClass('hidden');
            }
        });

    });

});
