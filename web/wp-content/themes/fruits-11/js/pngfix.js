/*
 
Correctly handle PNG transparency in Win IE 5.5 & 6.
http://homepage.ntlworld.com/bobosola. Updated 18-Jan-2006.

Use in <HEAD> with DEFER keyword wrapped in conditional comments:
<!--[if lt IE 7]>
<script defer type="text/javascript" src="pngfix.js"></script>
<![endif]-->

*/


if (navigator.platform == "Win32" && navigator.appName == "Microsoft Internet Explorer" && window.attachEvent) {
	window.attachEvent("onload", fnLoadPngs);
}

function fnLoadPngs() {
	var rslt = navigator.appVersion.match(/MSIE (\d+\.\d+)/, '');
	var itsAllGood = (rslt != null && Number(rslt[1]) >= 5.5);
	for (var i = document.all.length - 1, obj = null; (obj = document.all[i]); i--) {
		if (itsAllGood && obj.currentStyle.backgroundImage.match(/\.png/i) != null) {
			this.fnFixPng(obj);
			obj.attachEvent("onpropertychange", this.fnPropertyChanged);
		}
	}
}
	
function fnPropertyChanged() {
	if (window.event.propertyName == "style.backgroundImage") {
		var el = window.event.srcElement;
		if (!el.currentStyle.backgroundImage.match(/x\.gif/i)) {
			var bg	= el.currentStyle.backgroundImage;
			var src = bg.substring(5,bg.length-2);
			el.filters.item(0).src = src;
			el.style.backgroundImage = "url(/i/x.gif)";
		}
	}
}
	
function fnFixPng(obj) {
	var bg	= obj.currentStyle.backgroundImage;
	var src = bg.substring(5,bg.length-2);
	obj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "', sizingMethod='scale')";
	obj.style.backgroundImage = "url(/i/x.gif)";
}

var arVersion = navigator.appVersion.split("MSIE")
var version = parseFloat(arVersion[1])

if ((version >= 5.5) && (document.body.filters)) 
{
   for(var i=0; i<document.images.length; i++)
   {
      var img = document.images[i]
      var imgName = img.src.toUpperCase()
      if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
      {
         var imgID = (img.id) ? "id='" + img.id + "' " : ""
         var imgClass = (img.className) ? "class='" + img.className + "' " : ""
         var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' "
         var imgStyle = "display:inline-block;" + img.style.cssText 
         if (img.align == "left") imgStyle = "float:left;" + imgStyle
         if (img.align == "right") imgStyle = "float:right;" + imgStyle
         if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle
         var strNewHTML = "<span " + imgID + imgClass + imgTitle
         + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
         + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
         + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>" 
         img.outerHTML = strNewHTML
         i = i-1
      }
   }
}