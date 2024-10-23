<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertPlannerBtn'])) {

	$query = insertPlanner($pdo, $_POST['firstName'], $_POST['lastName'],
	$_POST['contact'], $_POST['email'], $_POST['gender']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Insertion failed";
	}

}


if (isset($_POST['editPlannerBtn'])) {
	$query = updatePlanner($pdo, $_POST['firstName'], $_POST['lastName'], 
	$_POST['contact'], $_POST['email'], $_POST['gender'], $_GET['planner_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Edit failed";;
	}

}




if (isset($_POST['deletePlannerBtn'])) {
	$query = deletePlanner($pdo, $_GET['planner_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}




if (isset($_POST['insertEventBtn'])) {
	$query = insertEvent($pdo, $_POST['event_name'], $_POST['event_type'], $_GET['planner_id']);

	if ($query) {
		header("Location: ../viewEvent.php?planner_id=" .$_GET['planner_id']);
	}
	else {
		echo "Insertion failed";
	}
}




if (isset($_POST['editEventBtn'])) {
	$query = updateEvent($pdo, $_POST['event_name'], $_POST['event_type'], $_GET['event_id']);

	if ($query) {
		header("Location: ../viewEvent.php?planner_id=" .$_GET['planner_id']);
	}
	else {
		echo "Update failed";
	}

}




if (isset($_POST['deleteEventBtn'])) {
	$query = deleteEvent($pdo, $_GET['event_id']);

	if ($query) {
		header("Location: ../viewEvent.php?planner_id=" .$_GET['planner_id']);
	}
	else {
		echo "Deletion failed";
	}
}


