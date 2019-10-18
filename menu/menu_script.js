var formIsOn = false;
var addCategoryIsOn = false;
var addItemIsOn = false;
var editCategoryIsOn = false;
var editItemIsOn = false;
var deleteCategoryIsOn = false;
var deleteItemIsOn = false;

function showAddCategory(){
	var displayBox = document.getElementById("add-category-form");
	if ((addCategoryIsOn == false) && (formIsOn == false)){
		displayBox.style.display = "block";
		addCategoryIsOn = true;
		formIsOn = true;
	} else if ((addCategoryIsOn == true) && (formIsOn == true)){
		displayBox.style.display = "none";
		addCategoryIsOn = false;
		formIsOn = false;
	} else {
		alert("Please click the appropriate button to hide its form.");
	}
}

function showAddItem(){
	var displayBox = document.getElementById("add-item-form");
	if ((addItemIsOn == false) && (formIsOn == false)){
		displayBox.style.display = "block";
		addItemIsOn = true;
		formIsOn = true;
	} else if ((addItemIsOn == true) && (formIsOn == true)){
		displayBox.style.display = "none";
		addItemIsOn = false;
		formIsOn = false;
	} else {
		alert("Please click the appropriate button to hide its form.");
	}
}

function showEditCategory(){
	var displayBox = document.getElementById("edit-category-form");
	if ((editCategoryIsOn == false) && (formIsOn == false)){
		displayBox.style.display = "block";
		editCategoryIsOn = true;
		formIsOn = true;
	} else if ((editCategoryIsOn == true) && (formIsOn == true)){
		displayBox.style.display = "none";
		formIsOn = false;
		editCategoryIsOn = false;
	} else {
		alert("Please click the appropriate button to hide its form.");
	}
}

function showEditItem(){
	var displayBox = document.getElementById("edit-item-form");
	if ((editItemIsOn == false) && (formIsOn == false)){
		displayBox.style.display = "block";
		editItemIsOn = true;
		formIsOn = true;
	} else if ((editItemIsOn == true) && (formIsOn == true)){
		displayBox.style.display = "none";
		editItemIsOn = false;
		formIsOn = false;
	} else {
		alert("Please click the appropriate button to hide its form.");
	}
}

function showDeleteCategory(){
	var displayBox = document.getElementById("delete-category-form");
	if ((deleteCategoryIsOn == false) && (formIsOn == false)){
		displayBox.style.display = "block";
		deleteCategoryIsOn = true;
		formIsOn = true;
	} else if ((deleteCategoryIsOn == true) && (formIsOn == true)){
		displayBox.style.display = "none";
		formIsOn = false;
		deleteCategoryIsOn = false;
	} else {
		alert("Please click the appropriate button to hide its form.");
	}
}

function showDeleteItem(){
	var displayBox = document.getElementById("delete-item-form");
	if ((deleteItemIsOn == false) && (formIsOn == false)){
		displayBox.style.display = "block";
		deleteItemIsOn = true;
		formIsOn = true;
	} else if ((deleteItemIsOn == true) && (formIsOn == true)){
		displayBox.style.display = "none";
		deleteItemIsOn = false;
		formIsOn = false;
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