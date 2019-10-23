function autoQuantitiy(){
	var checkboxes = document.getElementsByClassName('checkboxes');
	
	for(var i=0; i<checkboxes.length; i++){
		var siblings = checkboxes[i].parentNode.parentNode.children[2];
		
		if(checkboxes[i].checked){
			siblings.getElementsByClassName('quantity')[0].value = 1;
		}
		else
			siblings.getElementsByClassName('quantity')[0].value = 0;		
	}
}