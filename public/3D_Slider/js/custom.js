//var $ = jQuery;

/*soundManager.setup({
    url: 'js/audioplayer/swf',
});
threeSixtyPlayer.config.scaleFont = (navigator.userAgent.match(/msie/i)?false:true);
threeSixtyPlayer.config.showHMSTime = true;

// enable some spectrum stuffs

threeSixtyPlayer.config.useWaveformData = true;
threeSixtyPlayer.config.useEQData = true;

// enable this in SM2 as well, as needed

if (threeSixtyPlayer.config.useWaveformData) {
    soundManager.flash9Options.useWaveformData = true;
}
if (threeSixtyPlayer.config.useEQData) {
    soundManager.flash9Options.useEQData = true;
}
if (threeSixtyPlayer.config.usePeakData) {
    soundManager.flash9Options.usePeakData = true;
}

if (threeSixtyPlayer.config.useWaveformData || threeSixtyPlayer.flash9Options.useEQData || threeSixtyPlayer.flash9Options.usePeakData) {
    // even if HTML5 supports MP3, prefer flash so the visualization features can be used.
    soundManager.preferFlash = true;
}

// favicon is expensive CPU-wise, but can be used.
if (window.location.href.match(/hifi/i)) {
    threeSixtyPlayer.config.useFavIcon = true;
}

if (window.location.href.match(/html5/i)) {
    // for testing IE 9, etc.
    soundManager.useHTML5Audio = true;
}*/
jQuery(document).ready(function ($) {
    /* LEGEND
        scrollinit(); - default with no additional pages.

        scrollinit('carousel', 1, 0, true, true, true, true, true); - custom settings

        1. Scroll effect: 'classic', 'cube', 'carousel', 'concave', 'coverflow', 'spiraltop', 'spiralbottom', 'classictilt'.
         2. Number of scroll pages. '1' means no additional pages.
        3. Select which slide to be on focus when slider is loaded. '0' means first slide.
        4. Enable / disable keys navigation: true, false.
        5. Enable / disable buttons navigation: true, false.
        6. Enable / disable slide gestures navigation on touch devices: true, false.
        7. Enable / disable click navigation: true, false.
        8. Enable / disable mouse wheel navigation: true, false.
    */
    //alert(111);
    scrollinit("carousel", 1, 1, true, true, true, true, true);
    //scrollinit();
});