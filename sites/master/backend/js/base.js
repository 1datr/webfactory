function addscript(scripturl)
{
	
	var s = document.createElement("script");
	s.type = "text/javascript";
	s.src = scripturl;
	$("head").append(s);
	/*
	var head = document.getElementsByTagName('head')[0],
    script = document.createElement('script');

	script.src = scripturl;
	head.appendChild(script);*/
}

function addcss(cssurl)
{
	$("head").append("<link rel=\"stylesheet\" type=\"text/css\" href=\""+cssurl+"\" \/>");

}