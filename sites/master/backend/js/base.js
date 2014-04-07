function addscript(scripturl)
{
	var s = document.createElement("script");
	s.type = "text/javascript";
	s.src = scripturl;
	$("head").append(s);
}

function addcss(cssurl)
{
	$("head").append("<link rel=\"stylesheet\" type=\"text/css\" href=\""+cssurl+"\" \/>");

}