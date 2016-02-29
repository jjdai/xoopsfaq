 
document.onkeydown = applyKey;
 

/*********************************************
 *  imprime et ferme la fenetre
 *********************************************/ 
function printDoc(closeAfterPrint){
  
  window.print();
  if (closeAfterPrint==true)   window.close();
	return false;
}

function closeDoc(){
  window.close();
	return false;
}

/*********************************************
 *   
 *********************************************/ 
function applyKey (_event_){
	
	// --- Retrieve event object from current web explorer
	var winObj = checkEventObj(_event_);
	
	var intKeyCode = winObj.keyCode;
	var intAltKey = winObj.altKey;
	var intCtrlKey = winObj.ctrlKey;
//alert("key : " + intKeyCode);	
	if (intKeyCode == 27 ){
    window.close();
  }
		
// 	// 1° --- Access with [ALT/CTRL+Key]
// 	if (intAltKey || intCtrlKey) {
// 		
// 		if ( intKeyCode == KEY_RIGHT || intKeyCode == KEY_LEFT ){
// 			
// 			// --- Display Message
// 			alert("Hello with ALT/CTRL !");
// 			
// 			// 3° --- Map the keyCode in another keyCode not used
// 			winObj.keyCode = intKeyCode = REMAP_KEY_T;
// 			winObj.returnValue = false;
// 			return false;
// 		}
// 		
// 	}
// 	// 2 ° --- Access without [ALT/CTRL+Key]
// 	else {
// 		
// 		if ( intKeyCode == KEY_RIGHT || intKeyCode == KEY_LEFT ){
// 			
// 			// --- Display Message
// 			alert("Hello !");
// 			
// 			// 3° --- Map the keyCode in another keyCode not used
// 			winObj.keyCode = intKeyCode = REMAP_KEY_T;
// 			winObj.returnValue = false;
// 			return false;
// 		}
// 		
// 	}
	
}
function checkEventObj ( _event_ ){
	// --- IE explorer
	if ( window.event )
		return window.event;
	// --- Netscape and other explorers
	else
		return _event_;
}
