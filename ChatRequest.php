<?php 
	$chatLogFile = "user_list";

	$content = file_get_contents("php://input");
	$obj = json_decode($content);
	$chatLog = Array();

	//check if file exists
	if(!file_exists($chatLogFile)){
		file_put_contents($chatLogFile, serialize($chatLog));
	}
	else{
		$file = file_get_contents($chatLogFile);
		$chatLog = unserialize($file);
	}

	//check type and do something
	if($obj->type === "send"){
		array_push($chatLog, ["name" => $obj->name, "msg" => $obj->msg]);
		file_put_contents($chatLogFile, serialize($chatLog));
	}
	else if($obj->type === "receive"){
		$file = file_get_contents($chatLogFile);
		$chatLog = unserialize($file);
		print(json_encode($chatLog));
	}
	else{
		print("oops");
	}
?>