//id of modal (the background i guess, the shaded area when its enabled)
var modal = document.getElementById("modal");

// show modal of the respective form
function showModal(formID){
	var form = document.getElementById(formID);
	//id of modal contents
	var addModal = document.getElementById("modal-add-table");
	var editModal = document.getElementById("modal-edit-table");
	var removeModal = document.getElementById("modal-delete-table");
	
	//hide all forms
	addModal.style.display = "none";
	editModal.style.display = "none";
	removeModal.style.display = "none";
	
	//display both modal and selected form
	modal.style.display = "block";
	form.style.display = "block";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 

function closeBtn(){
	//get the close button
	var closeBtn = document.getElementsByClassName("popup-close-btn");

	for(var i=0; i<closeBtn.length; i++){
	
	//when the close button is clicked, popup will be closed
	closeBtn[i].onclick = function(){
		modal.style.display = "none";
	}
	}
}


//Codes taken from : https://jsfiddle.net/armaandhir/Lgt1j68s/
function highlight_row() {
    var tableList = document.getElementsByClassName("theTables");
	var editButton = document.getElementById("edit-button");
	var removeButton = document.getElementById("remove-button");
	
	for (var x = 0; x < tableList.length; x++)
	{
		var cells = tableList[x].getElementsByTagName("td");
		
		for (var i = 0; i < cells.length; i++) {
			
			var cell = cells[i];
			
			cell.onclick = function(){
				//enable buttons if disabled (first time only)
				if (editButton.disabled){
					editButton.disabled = false;
					removeButton.disabled = false;
				}
				
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
				var row = this.parentNode;
				row.className = "selectedRow";
				
				document.getElementById("form-edit-table").elements.namedItem("edit_number").value = row.childNodes[0].textContent;
				document.getElementById("form-edit-table").elements.namedItem("tableID").value = row.childNodes[0].textContent;
				document.getElementById("form-edit-table").elements.namedItem("tableSeats").value = row.childNodes[1].textContent;
				
				document.getElementById("form-delete-table").elements.namedItem("delete_number").value = row.childNodes[0].textContent;
			}
		}
	}
}

window.onload = init;

function init(){
	closeBtn()
	highlight_row()
}
