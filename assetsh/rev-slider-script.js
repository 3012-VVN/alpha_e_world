
var tpj=jQuery;

var revapi1078;
tpj(document).ready(function() {
    if(tpj("#rev_slider_1078_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_1078_1");
    }else{
        revapi1078 = tpj("#rev_slider_1078_1").show().revolution({
            sliderType:"standard",
            jsFileLocation:"revolution/js/",
            sliderLayout:"fullwidth",
            dottedOverlay:"on",
            delay: 5000,
            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                mouseScrollReverse:"default",
                onHoverStop:"off",
                touch:{
                    touchenabled:"on",
                    touchOnDesktop:"off",
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: "horizontal"
                }
                ,
                arrows: {
                    style:"fontello",
                    enable:true,
                    hide_onmobile:true,
                    hide_onleave:false,
                    left: {
                        h_align:"right",
                        v_align:"bottom",
                        // h_offset:60,
                        // v_offset:118
                    },
                    right: {
                        h_align:"right",
                        v_align:"bottom",
                        // h_offset:60,
                        // v_offset:60
                    }
                }
            },
            viewPort: {
                enable:true,
                outof:"pause",
                visible_area:"80%",
                presize:false
            },
            responsiveLevels:[1920,1440,767,480],
            visibilityLevels:[1920,1440,767,480],
            gridwidth:[1170,1170,670,450],
            gridheight:[1040,1040,900,720],
            lazyType:"none",
            parallax: {
                type:"mouse",
                origo:"slidercenter",
                speed:1000,
                levels:[2,3,4,5,6,7,12,16,10,50,47,48,49,50,51,55],
            },
            shadow:0,
            stopLoop:"off",
            spinner: "off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
    }
});	/*ready*/