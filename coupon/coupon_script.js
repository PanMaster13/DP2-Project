var formIsOn = false;
var addCouponIsOn = false;
var editCouponIsOn = false;
var deleteCouponIsOn = false;

function showAddCoupon(){
	var displayBox = document.getElementById("add-coupon-form");
	if ((addCouponIsOn == false) && (formIsOn == false)){
		displayBox.style.display = "block";
		addCouponIsOn = true;
		formIsOn = true;
	} else if ((addCouponIsOn == true) && (formIsOn == true)){
		displayBox.style.display = "none";
		addCouponIsOn = false;
		formIsOn = false;
	} else {
		alert("Please click the appropriate button to hide its form.");
	}
}

function showEditCoupon(){
	var displayBox = document.getElementById("edit-coupon-form");
	if ((editCouponIsOn == false) && (formIsOn == false)){
		displayBox.style.display = "block";
		editCouponIsOn = true;
		formIsOn = true;
	} else if ((editCouponIsOn == true) && (formIsOn == true)){
		displayBox.style.display = "none";
		formIsOn = false;
		editCouponIsOn = false;
	} else {
		alert("Please click the appropriate button to hide its form.");
	}
}

function showDeleteCoupon(){
	var displayBox = document.getElementById("delete-coupon-form");
	if ((deleteCouponIsOn == false) && (formIsOn == false)){
		displayBox.style.display = "block";
		deleteCouponIsOn = true;
		formIsOn = true;
	} else if ((deleteCouponIsOn == true) && (formIsOn == true)){
		displayBox.style.display = "none";
		formIsOn = false;
		deleteCouponIsOn = false;
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