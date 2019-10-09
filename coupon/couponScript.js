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

function test(){
	window.open("addCoupon.php", "Another one", "width=500, height=500");
}

window.onload = highlight_row;