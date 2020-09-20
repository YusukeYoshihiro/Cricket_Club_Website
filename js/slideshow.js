/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * Repository: https://github.com/shaack/jquery-background-slideshow/
 * License: MIT, see file 'LICENSE'
 */

;
(function($) {
    "use strict"
    $.fn.backgroundSlideshow = function(options) {

        this.each(function() {

            var $container = $(this)
            var $currentLayer = null
            var $nextLayer = null
            var currentImageIndex = 0
            var nextImageIndex = 0
            var preloadedImages = []
            var config = {
                delay: 4000,
                transitionDuration: 2000,
                onBeforeTransition: null,
                onAfterTransition: null,
                fixed: false,
                images: []
            }
            for (var option in options) {
                config[option] = options[option]
            }
            var transition = "opacity " + config.transitionDuration + "ms ease-in-out"
            var layerStyles = {
                backgroundSize: "cover",
                backgroundRepeat: "no-repeat",
                backgroundPosition: "center center",
                position: "absolute",
                left: 0,
                right: 0,
                bottom: 0,
                top: 0,
                zIndex: -1
            }
            var layerStylesTransition = {
                transition: transition,
                "-webkit-transition": transition,
                "-moz-transition": transition,
                "-o-transition": transition
            }

            function preLoadImage(index) {
                if (!preloadedImages[index]) {
                    preloadedImages[index] = new Image()
                    preloadedImages[index].src = config.images[index]
                }
            }

            function addLayer(imageSrc, withTransition) {
                var $newLayer = $("<div class='backgroundSlideshowLayer'/>")
                var thisLayerStyles = layerStyles
                thisLayerStyles.backgroundImage = "url(" + imageSrc + ")"
                $newLayer.css("opacity", "0")
                $newLayer.css(thisLayerStyles)
                if (withTransition) {
                    $newLayer.css(layerStylesTransition)
                }
                var $lastLayer = $container.find("> .backgroundSlideshowLayer").last()
                if ($lastLayer[0]) {
                    $lastLayer.after($newLayer)
                } else {
                    $container.prepend($newLayer)
                }
                return $newLayer
            }

            function nextImage(withTransition) {
                currentImageIndex = nextImageIndex
                nextImageIndex++
                if (nextImageIndex >= config.images.length) {
                    nextImageIndex = 0
                }
                if ($nextLayer) {
                    $currentLayer = $nextLayer
                } else {
                    $currentLayer = addLayer(config.images[currentImageIndex], withTransition)
                }
                if (config.onBeforeTransition) {
                    config.onBeforeTransition(currentImageIndex)
                }

                $currentLayer.css("opacity", "1")
                setTimeout(function() {
                    if (config.onAfterTransition) {
                        config.onAfterTransition(currentImageIndex)
                    }
                    preLoadImage(nextImageIndex)
                }, withTransition ? config.transitionDuration : 0)
                setTimeout(function() {
                    $nextLayer = addLayer(config.images[nextImageIndex], true)
                    cleanUp()
                }, config.transitionDuration)
            }

            function cleanUp() {
                var $layers = $container.find("> .backgroundSlideshowLayer")
                if ($layers.length > 2) {
                    $layers.first().remove()
                }
            }

            $container.css("position", "relative")
            nextImage(false)
            setTimeout(function() {
                nextImage(true)
                setInterval(function() {
                    nextImage(true)
                }, config.delay + config.transitionDuration)
            }, config.delay)

        })
    }
}(jQuery))




/* Slideshow */
$(document).ready(function() {
    //    change here #section_slideshow
    $(".slide_img").backgroundSlideshow({
        transitionDuration: 2750,
        fixed: true,
        images: [
            "./yusuke.img/cricket_bottom_img.jpg",
            "./yusuke.img/slider_part.jpg",
            "./yusuke.img/woman00.jpg",
            "./yusuke.img/cricket_kids1.jpg",
            "./img/cricket_fb_6.jpg",
            "./yusuke.img/league_main.jpg",
            "./yusuke.img/woman03.jpg",
            "./yusuke.img/cricket-0017.jpg"

        ]
    })


    try {
        fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", {
            method: 'HEAD',
            mode: 'no-cors'
        })).then(function(response) {
            return true;
        }).catch(function(e) {
            var carbonScript = document.createElement("script");
            carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
            carbonScript.id = "_carbonads_js";
            //    document.getElementById("carbon-block").appendChild(carbonScript);
            document.getElementsByClassName("slide_img").appendChild(carbonScript);
        });
    } catch (error) {
        console.log(error);
    }

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

});