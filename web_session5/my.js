var board = undefined;

function addChess() {
	
	board = new Board(8,8);
	var place = document.getElementById("boardPlace");	

	console.log('sending request...');
	//var result = getAllFigures('http://localhost/~raman/webdev/game.php?action=get_all_figures&yourId=1&friendId=2');
	
	//result = eval(result);
	
	//board.setFigures(result);

	board.render(place);

	//for (var i=0;i<result.length;i++) {
	//	console.log(result[i].x + " - " + result[i].y);
	//}	
	

	//alert(result);
	//console.log('request sent');
}

function Board(w, h) {
	this.rows = w;
	this.cols = h;
	this.figures = undefined;


	this.setFigures = function(figures) {
		this.figures = figures;
	};



	this.hasFigureAtPos = function(ii,jj) {
		for (var i=0;i<this.figures.yours.length;i++) {
			if ((this.figures.yours[i].x == ii && this.figures.yours[i].y == jj)) {
				return 1;
			}
		}
	
		for (var i=0;i<this.figures.friends.length;i++) {
            if (this.figures.friends[i].x == ii && this.figures.friends[i].y == jj) {
                return 2;
            }
        }

		return 0;
	}; 

	
	this.render = function(elem) {
		var tab = document.getElementById("board");
		if (tab != null) { 
			tab.parentNode.removeChild(tab);
		}
		console.log("render started");
		
		var table = document.createElement("table");
		table.id = "board";
		
		for (var i = 0; i < this.rows; i++) {
			var tr = table.insertRow();
			for (var j = 0; j < this.cols; j++) {
				var td = tr.insertCell();
						
				console.log(i + " - " + j); 	
			
				//td.appendChild(document.createTextNode('Cell #' + ' ' + (i * col + j + 1)));
				td.style.width = "100px";
				td.style.height = "100px";

				if ((i + j) % 2 == 0) {
					td.style.background = "black";
				} else {
					td.style.background = "white";
				}

				if (this.hasFigureAtPos(j, i) > 0) {
					//alert("is not null");
					var f = document.createTextNode('X');
					td.appendChild(f);
					td.style.color =  "red";
				}
			}
		}
		elem.appendChild(table);	
	}
} 



function makeMove(url) {
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



