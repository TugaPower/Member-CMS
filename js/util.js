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

/**
 * Used on the the #sidebar & #content to make no vertical bar appear (because their height doesn't compensate for the navbar)
 */
function applyConsistentHeight() {
	var newHeight = $(window).height() - ($("#nav").height() + 1);
	$("#sidebar").height(newHeight);
	$("#content").height(newHeight);
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

function loadContent(url, container) {
	var target = $(container);
	target.html("<i class=\"fa fa-spinner fa-5x fa-spin loading\"></i>");
	target.load(url, function(response, status, xhr) {
		if(status === "error") target.html("<h3 style=\"text-align: center\"><i class=\"fa fa-exclamation-triangle\"></i> There was an error <span style=\"font-weight: bold\">" + xhr.status + " " + xhr.statusText + "</span> loading the page.</h3>");
	});
}

function changePage(newPage, url) {
	if(getCookie("current_page" == newPage)) return; // If already in the target page, exit function
	setCookie("current_page", newPage);
	setCookie("current_page_url", url);
	loadContent(url, "#content");
	loadSidebar(newPage); // Rebuilds the sidebar with the new content
}

if(getCookie("current_page") == "") setCookie("current_page", "Home"); // Defines a default page, if none exists
if(getCookie("current_page_url") == "") setCookie("current_page_url", "home.php"); // Defines a default page, if none exists

$(function() { // Store every element after the page is loaded for later use
	var page = getCookie("current_page");
	var url = getCookie("current_page_url");
	console.log("Loading page " + page + " (" + url + ")");

	loadContent(url, '#content'); // Loads the first player on the array list
	loadSidebar(page);

	applyConsistentHeight();
});

window.onresize = function(event) {
	applyConsistentHeight();
};