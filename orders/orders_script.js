//Codes taken from : https://jsfiddle.net/armaandhir/Lgt1j68s/
//to highlight selected rows and also to use the selected for cancel of order-table
//or payment of order
function highlight_row() {
    var table = document.getElementById('order-table');
    var cells = table.getElementsByTagName('td');

	var cancelPopupBtn = document.getElementById('delete-popup-button');
	var payBtn = document.getElementById("pay-button");
	
	var amendBtn = document.getElementById("amend-button");
	var cancelBtn = document.getElementById("cancel-button");
	
    for (var i = 0; i < cells.length; i++) {
        var cell = cells[i];
        cell.onclick = function () {
            var rowId = this.parentNode.rowIndex;
			
            var rowsNotSelected = table.getElementsByTagName('tr');
            for (var row = 0; row < rowsNotSelected.length; row++) {
                rowsNotSelected[row].classList.remove('selectedRow');
            }
            var rowSelected = table.getElementsByTagName('tr')[rowId];
            rowSelected.className += " selectedRow";
			
			undisabled_buttons();
			
			console.log(rowId);
			console.log(rowSelected.cells[3]);
			
			cancelPopupBtn.onclick = function(){
				window.location.href = "/orders/orders_delete.php?orderID=" + rowSelected.cells[0].innerHTML;
			}
			
			payBtn.onclick = function(){
				window.location.href = "/payment/index.php?orderID=" + rowSelected.cells[0].innerHTML;
			}
			
			amendBtn.onclick = function(){
				window.location.href = "/orders/order_update.php?orderID=" + rowSelected.cells[0].innerHTML;
			}
        }
    }
}

function delete_popup(){
	var deleteBtn = document.getElementById("cancel-button");
	
	var popupContainer = document.getElementById("none-popup");
	var closepopoutBtn = document.getElementsByClassName("popup-close-btn")[0];
	
	var cancelpopoutBtn = document.getElementById("cancel-popup-button");
	
	deleteBtn.onclick = function(){
		popupContainer.style.display = "block";
	}
	
	//when the close button is clicked, popup will be closed
	closepopoutBtn.onclick = function(){
		popupContainer.style.display = "none";
	}
	
	cancelpopoutBtn.onclick = function(){
		popupContainer.style.display = "none";
	}
}

function undisabled_buttons(){
	var amendBtn = document.getElementById("amend-button");
	var cancelBtn = document.getElementById("cancel-button");
	var payBtn = document.getElementById("pay-button");
	
	amendBtn.disabled = false;
	cancelBtn.disabled = false;
	payBtn.disabled = false;
}

function disable_buttons(){
	var amendBtn = document.getElementById("amend-button");
	var cancelBtn = document.getElementById("cancel-button");
	var payBtn = document.getElementById("pay-button");
	
	amendBtn.disabled = true;
	cancelBtn.disabled = true;
	payBtn.disabled = true;
}

function init(){
	disable_buttons();
	highlight_row();
	delete_popup();
}

window.onload = init;