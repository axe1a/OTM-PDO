<?php  

function insertPlanner($pdo, $first_name, $last_name, $contact, $email, $gender) {

	$sql = "INSERT INTO eventplanner (planner_first_name, planner_last_name, 
		planner_contact, planner_email, planner_gender) VALUES (?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $contact, $email, $gender]);

	if ($executeQuery) {
		return true;
	}
}



function updatePlanner($pdo, $first_name, $last_name, 
	$contact, $email, $gender, $planner_id) {

	$sql = "UPDATE eventplanner
				SET planner_first_name = ?,
					planner_last_name = ?,
					planner_contact = ?, 
					planner_email = ?,
					planner_gender = ?
				WHERE planner_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $contact, $email, $gender, $planner_id]);
	
	if ($executeQuery) {
		return true;
	}

}


function deletePlanner($pdo, $planner_id) {
	$deletePlannerEvent = "DELETE FROM events WHERE planner_id = ?";
	$deleteStmt = $pdo->prepare($deletePlannerEvent);
	$executeDeleteQuery = $deleteStmt->execute([$planner_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM eventplanner WHERE planner_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$planner_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}




function getAllPlanner($pdo) {
	$sql = "SELECT * FROM eventplanner";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getPlannerByID($pdo, $planner_id) {
	$sql = "SELECT * FROM eventplanner WHERE planner_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$planner_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}


function getEventByPlanner($pdo, $planner_id) {
	
	$sql = "SELECT 
				events.event_id AS event_id,
				events.event_name AS event_name,
				events.event_type AS event_type,
				CONCAT(eventplanner.planner_first_name,' ',eventplanner.planner_last_name) AS event_coordinator,
				events.date_added AS date_added
			FROM events
			JOIN eventplanner ON events.planner_id = eventplanner.planner_id
			WHERE events.planner_id = ? 
			GROUP BY events.event_type;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$planner_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function insertEvent($pdo, $event_name, $event_type, $planner_id) {
	$sql = "INSERT INTO events (event_name, event_type, planner_id) VALUES (?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$event_name, $event_type, $planner_id]);
	if ($executeQuery) {
		return true;
	}

}

function getEventByID($pdo, $event_id) {
	$sql = "SELECT 
				events.event_id AS event_id,
				events.event_name AS event_name,
				events.event_type AS event_type,
				events.date_added AS date_added,
				CONCAT(eventplanner.planner_first_name,' ',eventplanner.planner_last_name) AS event_coordinator
			FROM events
			JOIN eventplanner ON events.planner_id = eventplanner.planner_id
			WHERE events.event_id = ?;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$event_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateEvent($pdo, $event_name, $event_type, $event_id) {
	$sql = "UPDATE events
			SET event_name = ?,
				event_type = ?
			WHERE event_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$event_name, $event_type, $event_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteEvent($pdo, $event_id) {
	$sql = "DELETE FROM events WHERE event_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$event_id]);
	if ($executeQuery) {
		return true;
	}
}
