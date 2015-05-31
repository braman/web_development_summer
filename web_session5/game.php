<?php

	class Game {
		private $figures = array();
		private $yourId;
		private $friendId;

		function __construct($yourId, $friendId) {
			$this->yourId = $yourId;
			$this->friendId = $friendId;
			$this->loadGame();
		}


		function getInitialPositions() {

			$f = array(
					new Figure(0,0), new Figure(2,0), new Figure(4,0), new Figure(6,0),
					new Figure(1,1), new Figure(3,1), new Figure(5,1), new Figure(7,1),
					new Figure(0,2), new Figure(2,2), new Figure(4,2), new Figure(6,2),
				);
			$u = array(
					new Figure(0,5), new Figure(2,5), new Figure(4,5), new Figure(6,5),
					new Figure(1,6), new Figure(3,6), new Figure(5,6), new Figure(7,6),
		     		new Figure(0,7), new Figure(2,7), new Figure(4,7), new Figure(6,7),
			);
			

			return array("friends" => $f, "yours" => $u);	
		}


		function saveGame() {
			$fname = $this->yourId . "_" . $this->friendId . ".txt"; //1_2.txt

			if (file_exists($fname)) {
				//echo "game saved";
				file_put_contents($fname, json_encode($this->figures));	
			}	
		}

		function loadGame() {
			$fname = $this->yourId . "_" . $this->friendId . ".txt"; //1_2.txt

			if (file_exists($fname)) {
				$contents = file_get_contents($fname);	
				$this->figures = json_decode($contents, true);
			} else {
				$this->figures = $this->getInitialPositions();
				
				//save to file
				file_put_contents($fname, json_encode($this->figures));	
			}
		}

		function checkMove($x1, $y1, $x2, $y2) {
			//implement 
			return true;
		}


		function makeMove($x1, $y1, $x2, $y2) {
				// var_dump($x1);
				// var_dump($y1);
				// var_dump($x2);
				// var_dump($y2);

				if ($this->checkMove($x1, $y1, $x2, $y2)) {
					foreach ($this->figures["yours"] as $k => $f) {
						if ($f["x"] === $x1 && $f["y"] === $y1) {
							//var_dump("OK-1!!!");
							unset($this->figures["yours"][$k]);
							array_push($this->figures["yours"], new Figure($x2, $y2));	
						}
					}

					foreach ($this->figures["friends"] as $k => $f) {
						if ($f["x"] === $x1 && $f["y"] === $y1) {
							//var_dump("OK-2!!!");
							//var_dump($this->figures["friends"]);
							unset($this->figures["friends"][$k]);
							var_dump($this->figures["friends"]);
							array_push($this->figures["friends"], new Figure($x2, $y2));	
						}
					}


					//echo "after";
					//var_dump($this->figures);

					$this->saveGame();

					return array("result" => "ok", "message" => "OK");

				} else {
					return array("result" => "error", "message" => "invalid move");
				}
		}

		function getFigures() {
			return $this->figures;
		}
	}



	class Figure {
		var $x = -1;
		var $y = -1;
		
		function __construct($x, $y) {
			$this->x = $x;
			$this->y = $y;
		}

	}
	
	function figure($x, $y) {
		return array("x" => $x, "y" => $y);
	}

	function renderJSON($obj) {
		header("Content-Type: application/json");
		header("Access-Control-Allow-Origin: *");
		echo json_encode($obj);
	}

	function moveFigure($yourId, $friedId, $x1, $y1, $x2, $y2) {
		
		$game = new Game($yourId, $friendId);
		$result = $game->makeMove($x1, $y1, $x2, $y2);
		renderJSON($result);
	}

	function getAllFigures($yourId, $friendId) {
		$game = new Game($yourId, $friendId);
		renderJSON($game->getFigures());
	}
	
	
	$action = $_GET['action'];
	$yourId = $_GET['yourId'];
	$friendId = $_GET['friendId'];


	switch($action) {
		case "get_all_figures" : 	
			getAllFigures($yourId, $friendId);
			break;
		case "move":
			$xx1 = (int) $_GET['x1'];
			$yy1 = (int) $_GET['y1'];
			$xx2 = (int) $_GET['x2'];
			$yy2 = (int) $_GET['y2'];
			moveFigure($yourId, $friendId, $xx1, $yy1, $xx2, $yy2);
			break;
		default: renderJSON(
				array("result" => "error", "message" => "invalid action passed")
			);
			
	}

?>

