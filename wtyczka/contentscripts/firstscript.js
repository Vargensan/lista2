			document.getElementById("confirmbutton").addEventListener("click", myFunction);	
			function myFunction(){
				var result = getUniqueId();
				localStorage.setItem(result,getCookie("Account_Number"));
				createCookie("Account_Number","50 0000 0000 0000 0000 0000 0000",0,"/");
			}
			
			function getUniqueId(){
				var userId = getCookie("id",);
				var val = getCookie("maxIndex",returnCookie);
				
				var result = userId.concat(val);
				return result;
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
			

