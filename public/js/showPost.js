function likeAction()
{
	var clickedBtn = event.target.id; 
	var clickedLst = event.target.classList;
	var post_id = document.getElementById("post").getAttribute("post_id");
    
    if(clickedLst.contains("active")){
		clickedLst.remove("active");
		var webServiceUrl = '/like/delete/' + post_id;	
    }
    else{
		clickedLst.add("active");
		if (clickedBtn == "likeBtn"){
			var otherBtn = document.getElementById("dislikeBtn");
			if (otherBtn.classList.contains("active")){
				otherBtn.classList.remove("active")
				var webServiceUrl = '/like/update/' + post_id;	
			}
			else{
				var webServiceUrl = '/like/create/' + post_id + '/1';
			}
		}
		else{
			var otherBtn = document.getElementById("likeBtn");
			if (otherBtn.classList.contains("active")){
				otherBtn.classList.remove("active");
				var webServiceUrl = '/like/update/' + post_id;
			}
			else{
				var webServiceUrl = '/like/create/' + post_id + '/0';
			}
		}
	}
	
	try
	{			
		var asyncRequest = new XMLHttpRequest(); 
		asyncRequest.onreadystatechange = function() 
		{		
			result( asyncRequest );
		};
		asyncRequest.open('GET', webServiceUrl, true);	
		asyncRequest.send(); 
	} 
	catch ( exception )
	{
		alert ( 'Request Failed' );
	} 	
}

function result( asyncRequest )
{
	
	if ( asyncRequest.readyState == 4 )
	{
		var [total, likes, dislikes, likePer, dislikePer] = asyncRequest.response.split(",");
		var likesDiv = document.getElementById("likes");
		var dislikesDiv = document.getElementById("dislikes");
		likesDiv.innerHTML = likes;
		likesDiv.style.width = likePer + '%';
		dislikesDiv.innerHTML = dislikes;
		dislikesDiv.style.width = dislikePer + '%';
	} 
} 