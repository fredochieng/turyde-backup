(function($){$.fn.viewportChecker=function(useroptions){var options={classToAdd:'visible',classToRemove:'invisible',offset:100,repeat:false,invertBottomOffset:true,callbackFunction:function(elem,action){},scrollHorizontal:false};$.extend(options,useroptions);var $elem=this,windowSize={height:$(window).height(),width:$(window).width()},scrollElem=((navigator.userAgent.toLowerCase().indexOf('webkit')!=-1||navigator.userAgent.toLowerCase().indexOf('windows phone')!=-1)?'body':'html');this.checkElements=function(){var viewportStart,viewportEnd;if(!options.scrollHorizontal){viewportStart=$(scrollElem).scrollTop();viewportEnd=(viewportStart+windowSize.height);}
else{viewportStart=$(scrollElem).scrollLeft();viewportEnd=(viewportStart+windowSize.width);}
$elem.each(function(){var $obj=$(this),objOptions={},attrOptions={};if($obj.data('vp-add-class'))
attrOptions.classToAdd=$obj.data('vp-add-class');if($obj.data('vp-remove-class'))
attrOptions.classToRemove=$obj.data('vp-remove-class');if($obj.data('vp-offset'))
attrOptions.offset=$obj.data('vp-offset');if($obj.data('vp-repeat'))
attrOptions.repeat=$obj.data('vp-repeat');if($obj.data('vp-scrollHorizontal'))
attrOptions.scrollHorizontal=$obj.data('vp-scrollHorizontal');if($obj.data('vp-invertBottomOffset'))
attrOptions.scrollHorizontal=$obj.data('vp-invertBottomOffset');$.extend(objOptions,options);$.extend(objOptions,attrOptions);if($obj.hasClass(objOptions.classToAdd)&&!objOptions.repeat){return;}
if(String(objOptions.offset).indexOf("%")>0)
objOptions.offset=(parseInt(objOptions.offset)/ 100)*windowSize.height;var elemStart=(!objOptions.scrollHorizontal)?Math.round($obj.offset().top)+objOptions.offset:Math.round($obj.offset().left)+objOptions.offset,elemEnd=(!objOptions.scrollHorizontal)?elemStart+$obj.height():elemStart+$obj.width();if(objOptions.invertBottomOffset)
elemEnd-=(objOptions.offset*2);if((elemStart<viewportEnd)&&(elemEnd>viewportStart)){$obj.removeClass(objOptions.classToRemove);$obj.addClass(objOptions.classToAdd);objOptions.callbackFunction($obj,"add");}else if($obj.hasClass(objOptions.classToAdd)&&(objOptions.repeat)){$obj.removeClass(objOptions.classToAdd);objOptions.callbackFunction($obj,"remove");}});};if(!!('ontouchstart'in window)){$(document).bind("touchmove MSPointerMove pointermove",this.checkElements);}
else{$(window).bind("scroll",this.checkElements);}
$(window).bind("load",this.checkElements);$(window).resize(function(e){windowSize={height:$(window).height(),width:$(window).width()};$elem.checkElements();});this.checkElements();return this;};})(jQuery);