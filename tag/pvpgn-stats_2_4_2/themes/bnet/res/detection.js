	var nsBool = 	(is_nav 	&& !is_nav5up) || 
					(is_ie 		&& !is_ie5up) ||
					(is_opera 	&& !is_opera5up)
	
			
	if (nsBool) {
		
		window.location="\war3\ladder\browsernotsupported.html";
	
	}