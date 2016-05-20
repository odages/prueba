<?php
$pdo=new PDO("mysql:host=localhost;dbname=lab5;","root","");
/*var_dump($pdo);*/


	switch($_POST['accion']){

		// Inserta la información
		case 1:
			$statement = $pdo->prepare("INSERT INTO tareas(id,titulo,estatus)VALUES(null,:titulo,1)");
			$statement->execute(array("titulo" => $_POST['titulo']));
			break;

			// Borrar la información
			case 2:
			$statement = $pdo->prepare("DELETE FROM tareas WHERE id=:id");
			$statement->execute(array("id" => $_POST['id']));
			break;

			// Modifica la información
			case 3:
			$statement = $pdo->prepare("UPDATE tareas SET estatus=:estatus WHERE id=:id");
			$statement->execute(array("estatus" => $_POST['estatus'], "id" => $_POST["id"]));
			break;

			// Consulta la información
			default:
				header('Content-Type: application/json'); //para que pueda leerse
				$statement=$pdo->prepare("SELECT * FROM tareas");
				$statement->execute();
				$results=$statement->fetchAll(PDO::FETCH_ASSOC);
				$json=json_encode($results);
				echo $json;
			break;
}
?>
