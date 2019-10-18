var formIsOn = false;
var addTableIsOn = false;
var editTableIsOn = false;
var deleteTableIsOn = false;

function showAddTable(){
	var displayBox = document.getElementById("add-table-form");
	if ((addTableIsOn == false) && (formIsOn == false)){
		displayBox.style.display = "block";
		addTableIsOn = true;
		formIsOn = true;
	} else if ((addTableIsOn == true) && (formIsOn == true)){
		displayBox.style.display = "none";
		addTableIsOn = false;
		formIsOn = false;
	} else {
		alert("Please click the appropriate button to hide its form.");
	}
}

function showEditTable(){
	var displayBox = document.getElementById("edit-table-form");
	if ((editTableIsOn == false) && (formIsOn == false)){
		displayBox.style.display = "block";
		editTableIsOn = true;
		formIsOn = true;
	} else if ((editTableIsOn == true) && (formIsOn == true)){
		displayBox.style.display = "none";
		formIsOn = false;
		editTableIsOn = false;
	} else {
		alert("Please click the appropriate button to hide its form.");
	}
}

function showDeleteTable(){
	var displayBox = document.getElementById("delete-table-form");
	if ((deleteTableIsOn == false) && (formIsOn == false)){
		displayBox.style.display = "block";
		deleteTableIsOn = true;
		formIsOn = true;
	} else if ((deleteTableIsOn == true) && (formIsOn == true)){
		displayBox.style.display = "none";
		formIsOn = false;
		deleteTableIsOn = false;
	} else {
		alert("Please click the appropriate button to hide its form.");
	}
}

//Codes taken from : https://jsfiddle.net/armaandhir/Lgt1j68s/
function highlight_row() {
    var tableList = document.getElementsByClassName("theTables");
	
	for (var x = 0; x < tableList.length; x++)
	{
		var cells = tableList[x].getElementsByTagName("td");
		
		for (var i = 0; i < cells.length; i++) {
			
			var cell = cells[i];
			
			cell.onclick = function(){
				//Deselects all other rows
				for (var y = 0; y < tableList.length; y++)
				{
					var otherRows = tableList[y].getElementsByTagName("tr");
					for (var j = 0; j < otherRows.length; j++)
					{
						otherRows[j].classList.remove("selectedRow");
					}
				}
			
				// Sets clicked row with the class name
				this.parentNode.className = "selectedRow";
			}
		}
	}
}

window.onload = highlight_row;