if(!String.prototype.format) {
	String.prototype.format = function() {
		var args = arguments;
		return this.replace(/{(\d+)}/g, function(match, number) { return typeof args[number] != 'undefined' ? args[number] : match; });
	};
}

function getCookie(key) {
	var name = key + "=";
	var cookieArr = document.cookie.split(';');
	for(var i=0; i < cookieArr.length; i++) {
		var c = cookieArr[i];
		while(c.charAt(0) == ' ') c = c.substring(1); // Remove whitespaces
		if(c.indexOf(name) != -1) // If the string starts with the key, retrieve the value
			return c.substring(name.length, c.length);
	}
	return "";
}

function setCookie(key, value) {
	var d = new Date();
	d.setTime(d.getTime() + 25992000000); // 30 days
	document.cookie = key + "=" + value + "; expires=" + d.toGMTString();
}

function deleteCookie(key) {
	document.cookie = key + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
}

function loadSidebar(current) {
	var tabs = [
		{ name:"Home", url:"home.php" },
		{ name:"Profile", url:"profile.php" },
		{ name:"Messages", url:"messages.php" },
		{ name:"Stats", url:"stats.php" }
	];

	sidebar = document.getElementById("sidebar");
	sidebar.innerHTML = ""; // Clear the sidebar
	for(var i=0; i < tabs.length; i++) {
		var element = "<li ";
		if(current == tabs[i]["name"]) element += " class='active'";
		element += "><a onClick='" + "changePage(\"{0}\",\"{1}\")".format(tabs[i]["name"],tabs[i]["url"]) + "'>" + tabs[i]["name"] + "</a></li>";
		sidebar.innerHTML += element;
	}
}

function loadPage(page, target) {
	var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() /* for IE7+, Firefox, Chrome, Opera, Safari */ : new ActiveXObject("Microsoft.XMLHTTP") /* for IE6, IE5 */;

	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4) {
			if(xmlhttp.status == 200) // The page was loaded successfully
				document.getElementById(target).innerHTML = xmlhttp.responseText;
			else // There was some error during the page load
				loadPage('error.php', target);
		}
	}
	xmlhttp.open("GET", page, true);
	xmlhttp.send();
}

function changePage(newPage, url) {
	if(getCookie("current_page" == newPage)) return; // If already in the target page, exit function
	setCookie("current_page", newPage);
	setCookie("current_page_url", url);
	loadPage(url, 'content');
	loadSidebar(newPage); // Rebuilds the sidebar with the new content
}

if(getCookie("current_page") == "") setCookie("current_page", "Home"); // Defines a default page, if none exists
if(getCookie("current_page_url") == "") setCookie("current_page_url", "home.php"); // Defines a default page, if none exists

$(function() { // Store every element after the page is loaded for later use
	var page = getCookie("current_page");
	var url = getCookie("current_page_url");
	console.log("Loading page " + page + " (" + url + ")");

	loadPage(url, 'content'); // Loads the first player on the array list
	loadSidebar(page);
});
