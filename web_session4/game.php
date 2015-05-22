<?php

	class Figure {
		var $x = -1;
		var $y = -1;
		var $type = 0;

		function __constructor($x, $y) {
			this.$x = $x;
			this.$y = $y;
		}

	}
	
	function renderJSON($obj) {
		header("Content-Type: application/json");
		header("Access-Control-Allow-Origin: *");
		echo json_encode($obj);
	}

	function getAllFigures($yourId, $friendId) {
		$figures = array();
		
		for ($i=0;$i<10;$i++) {
			array_push($figures, new Figure(0,0));
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

