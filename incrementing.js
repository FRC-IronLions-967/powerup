$(document).ready(function(){

//CIM Motors
	$("#minusOneDriveMotors").click(function(){
		changeBy("driveMotors",-1);
	});
	$("#plusOneDriveMotors").click(function(){
		changeBy("driveMotors",1);
	});

//Weight
	$("#minusOneWeight").click(function(){
		changeBy("weight",-1);
	});
	$("#plusOneWeight").click(function(){
		changeBy("weight",1);
	});

});

function changeBy(elementID, changeAmount){
	var startAmount = parseInt($("#"+elementID).val());
	if (startAmount + changeAmount > 0){
		$("#"+elementID).val(startAmount + changeAmount);
	}
	else{
		$("#"+elementID).val(0);
	}
}