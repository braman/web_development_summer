function addChess() {
	console.log('sending request...');
	var result = getAllFigures('http://localhost/~raman/webdev/game.php?action=get_all_figures&yourId=1&friendId=2');
	
	result = eval(result);
	
	for (var i=0;i<result.length;i++) {
		console.log(result[i].x + " - " + result[i].y);
	}	
	

	alert(result);
	console.log('request sent');
}

function getAllFigures(url) {
	//send xmlhttprequest
	//get the response
	var result;
	var req = new XMLHttpRequest();
	req.open('GET', url, false);
	req.send();

	if (req.readyState == XMLHttpRequest.DONE ) {
           if(req.statusText == "OK"){
		result = req.responseText;		
           } else {
              alert('Something went wrong ;(')
           }
        }		
	return result;
}



