	function myFunction(){
			var unique = getUniqueId();
			var fakenumber = localStorage.getItem(unique);
			if(fakenumber !== null){
				setnewValue(fakenumber);
			}
	}

	function setnewValue(fakenumber){
			var result = "Account Number: ";
			result = result.concat(fakenumber);
			result = result.split('+').join(' ');
			document.getElementById("editthis").textContent = result;
			document.getElementById("editthis").contentWindow.location.reload();
	}

	function getUniqueId(){
			var userId = getCookie("id");
			var val = getCookie("actualIndex");
			var result = userId.concat(val);
			return result;
	}

		var createCookie = function(name, value, days) {
			var expires;
			if (days) {
				var date = new Date();
				date.setTime(days * 24 * 60 * 60 * 1000);
				expires = "; expires=" + date.toGMTString();
			}
			else {
				expires = "";
			}
			document.cookie = name + "=" + value + expires + "; path=/";
		}

	function getCookie(c_name) {
		if (document.cookie.length > 0) {
				c_start = document.cookie.indexOf(c_name + "=");
				if (c_start != -1) {
						c_start = c_start + c_name.length + 1;
						c_end = document.cookie.indexOf(";", c_start);
						if (c_end == -1) {
								c_end = document.cookie.length;
						}
						return unescape(document.cookie.substring(c_start, c_end));
				}
		}
		return "";
	}

window.addEventListener('load', function () {
    gBrowser.addEventListener('DOMContentLoaded', function () {
        myFunction();
    }, false);
}, false);
