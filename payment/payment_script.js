//codes referenced from w3schools
//https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_modal

function popup(){
	//get all the buttons
	var payBtn = document.getElementById("pay-btn");
	var couponBtn = document.getElementById("coupon-btn");
	
	//get the container for popup
	var popupContainer = document.getElementById("none-popup");

	//get the popupTitle
	var popupTitle = document.getElementById("popup-title");
	
	//get the close button
	var closeBtn = document.getElementsByClassName("popup-close-btn")[0];
	
	//get the popup
	var popup = document.getElementById("popup");
	
	//get the textbox
	var textbox = document.getElementById("textBox");
	
	var couponForm = document.getElementById("couponForm");
	
	var paymentDiv = document.getElementById("payment-div");
	
	var payTextBox = document.getElementById("payTextBox");
	
	//if payBtn is clicked, the RM is shown and the title will be payment
	payBtn.onclick = function(){
		popupTitle.innerHTML = "Payment";
		popupContainer.style.display = "block";
		paymentDiv.style.display = "block";
		couponForm.style.display = "none";
		payTextBox.focus();
	}

	//if couponBtn is clicked, the RM is not shown and the title will be CouponID
	couponBtn.onclick = function(){
		popupTitle.innerHTML = "CouponID";
		popupContainer.style.display = "block";
		couponForm.style.display = "block";
		paymentDiv.style.display = "none";
		textbox.focus();
	}
	
	//when the close button is clicked, popup will be closed
	closeBtn.onclick = function(){
		popupContainer.style.display = "none";
	}

	//if user clicks outside the content, it will close
	window.onclick = function(event){
		if(event.target == popup) {
			popupContainer.style.display = "none";
		}
	}
}

function submitOnClick(){
	var popupContainer = document.getElementById("none-popup");
	
	var submitBtn = document.getElementById("submit-btn");

	var popupTitle = document.getElementById("popup-title");
	
	var totalPrice = document.getElementById("totalPrice");
	
	var totalAmount = document.getElementById("totalAmount");
	
	var totalChange = document.getElementById("totalChange");
	
	var payBtn = document.getElementById("pay-btn");
	
	var couponBtn = document.getElementById("coupon-btn");
	
		if(popupTitle.innerHTML == "Payment"){
			payTextBox = document.getElementById("payTextBox");
			textboxValue = payTextBox.value;
			totalAmount.children[3].innerHTML = parseFloat(textboxValue).toFixed(2);
			var finalChange = parseFloat(payTextBox.value) - parseFloat(totalPrice.children[3].innerHTML);
			totalChange.children[3].innerHTML = parseFloat(finalChange).toFixed(2);
			totalAmount.style.display = "table-row";
			totalChange.style.display = "table-row";
			popupContainer.style.display = "none";
			
			couponBtn.disabled = true;
			payBtn.disabled = true;
		}
}

function calculateTotalPrice(){
	var totalPrice = document.getElementById("totalPrice").children[3];
	
	var paymentTable = document.getElementById("payment-table");
	
	var length = paymentTable.rows.length;
	
	var array = [];
	
	var s = ''
	for(var i = 0; i < length; i++){
		var tr = paymentTable.rows[i];
		
		var qtyCell = tr.cells[1];
		
		var cell = tr.cells[2];

		var cell2 = tr.cells[3];
		
		var totalPerItem;
		
		if(i > 0 && i < (length-3)){
			if(i == (length-4)){
				cell.innerHTML = -Math.abs(cell.innerHTML)
				cell2.innerHTML = -Math.abs(cell.innerHTML)
			}
			
			totalPerItem = qtyCell.innerHTML * cell.innerHTML;
			array.push(parseFloat(totalPerItem).toFixed(2));
		}
	}
	
	//referenced
	//https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_reduce
	var totalprice = array.reduce(sum);
	
	function sum(total, num) {
		return parseFloat(total) + parseFloat(num);
	}
	
	totalPrice.innerHTML = totalprice.toFixed(2);
	
	document.getElementById('hidden').value = totalprice.toFixed(2);
}

function init(){
	//calculateTotalPrice();
	popup();
}

window.onload = init;