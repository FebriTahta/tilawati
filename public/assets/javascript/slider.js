$(document).ready(function() {
    $('.tp-banner').show().revolution({
        dottedOverlay:"none",
        delay:6000,
        startwidth:1170,
        startheight:789,
        hideThumbs:200,

        thumbWidth:100,
        thumbHeight:50,
        thumbAmount:5,

        navigationType:"bullet",
        navigationArrows:"solo",
        navigationStyle:"square",

        touchenabled:"on",
        onHoverStop:"on",

        swipe_velocity: 0.7,
        swipe_min_touches: 1,
        swipe_max_touches: 1,
        drag_block_vertical: false,

        parallax:"mouse",
        parallaxBgFreeze:"on",
        parallaxLevels:[7,4,3,2,5,4,3,2,1,0],

        keyboardNavigation:"off",

        navigationHAlign:"left",
        navigationVAlign:"bottom",
        navigationHOffset:30,
        navigationVOffset:20,

        soloArrowLeftHalign:"right",
        soloArrowLeftValign:"center",
        soloArrowLeftHOffset:80,
        soloArrowLeftVOffset:376,

        soloArrowRightHalign:"right",
        soloArrowRightValign:"center",
        soloArrowRightHOffset:0,
        soloArrowRightVOffset:376,

        shadow:0,
        fullWidth:"on",
        fullScreen:"off",

        spinner:"spinner4",

        stopLoop:"off",
        stopAfterLoops:-1,
        stopAtSlide:-1,

        shuffle:"off",

        autoHeight:"off",                       
        forceFullWidth:"off",                       

        hideThumbsOnMobile:"off",
        hideNavDelayOnMobile:1500,                      
        hideBulletsOnMobile:"off",
        hideArrowsOnMobile:"off",
        hideThumbsUnderResolution:0,

        hideSliderAtLimit:0,
        hideCaptionAtLimit:0,
        hideAllCaptionAtLilmit:0,
        startWithSlide:0,
        fullScreenOffsetContainer: ""
    });
});