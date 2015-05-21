function addChess() {
	var c = new Chess(10, 10);
	console.log("Starting to render the chess...")
	c.render(document.getElementsByTagName("body")[0]);
	console.log("Render complete")
}

function Chess(rows, cols) {
	this.rows = rows;
	this.cols = cols;

	this.render = function(elem) {
		var t = document.createTextNode("Test!");//draw here
		elem.appendChild(t);	
	}

}