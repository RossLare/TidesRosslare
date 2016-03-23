// JavaScript Document


window.addEventListener('resize', function(event){
  // do stuff here
  
  var w = window.innerWidth;
  var h = window.innerHeight;
  var button = document.getElementById("button1");
  var picker = document.getElementById("picker2");
  //480 800
  
  if( w > 480 && w < 800 ) {
	  
	  
	  button.style.top = "23%";
	  picker.style.top = "35px";
	  
	}else {
		
		
	  button.style.top = "50%";
	   picker.style.top = "55px";
	}
 
});