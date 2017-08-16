#URL shortener  
NGINX stuff
if (!-e $request_filename) {  
	rewrite ([^/]+)$ /index.php?id=$1 last;  
}  

