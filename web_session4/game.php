<?php

	class Figure {
		var $x = -1;
		var $y = -1;
		var $type = 0;

		function __construct($x, $y) {
			$this->x = $x;
			$this->y = $y;
		}

	}
	
	class Game {
		var $figures = array();
		var $yourId;
		var $friendId;

		function __construct($yourId, $friendId) {
			$this->yourId = $yourId;
			$this->friendId = $friendId;
			$this->loadGame();
		}

		function loadGame() {
			$fname = $yourId . "-" . $friendId . ".txt";

			$contents = get_file_contents($fname);
			$this->figures = json_decode($contents);
		}


		function makeMove($x1, $y1, $x2, $y2) {
				
		}
	}


	function renderJSON($obj) {
		header("Content-Type: application/json");
		header("Access-Control-Allow-Origin: *");
		echo json_encode($obj);
	}

	function getAllFigures($yourId, $friendId) {
		$figures = array("yours" => array(), "friends" => array());
		
		for ($i=0;$i<10;$i++) {
			array_push($figures["yours"],   new Figure(0,0));
			array_push($figures["friends"], new Figure(0,0));
		}

		renderJSON($figures);
	}


	
	
	$action = $_GET['action'];
	$yourId = $_GET['yourId'];
	$friendId = $_GET['friendId'];

	if ($action == "get_all_figures") {
		getAllFigures($yourId, $friendId);
	}
?>

