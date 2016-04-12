// JavaScript Document

var JSONObject;

window.onload = setDate;


function setDate() {
	

	


	$(function() {
	$( "#datepicker" ).datepicker({ maxDate: 21, minDate:0 });
	});

	//var JSONObject;
	

	document.getElementById("button1").addEventListener("click", toggle, false);
	//document.getElementById("datepicker").addEventListener("click", changeDate, false);
	
	var today = new Date();
	var dateField = document.getElementById("date");
	var firstLow = document.getElementById("firstLow");
	var firstHigh =document.getElementById("firstHigh");
	var secondLow = document.getElementById("secondLow");
	var secondHigh = document.getElementById("secondHigh");
	
	
	var weekday=new Array(7);
	weekday[0]="Sunday";
	weekday[1]="Monday";
	weekday[2]="Tuesday";
	weekday[3]="Wednesday";
	weekday[4]="Thursday";
	weekday[5]="Friday";
	weekday[6]="Saturday";
	
	var month = new Array(12);
	month[0] = "January";
	month[1] = "February";
	month[2] = "March";
	month[3] = "April";
	month[4] = "May";
	month[5] = "June";
	month[6] = "July";
	month[7] = "August";
	month[8] = "September";
	month[9] = "October";
	month[10] = "November";
	month[11] = "December";
	
	var currentMonth = month[today.getMonth()];
	
	//document.write(currentMonth);
	var date = today.getDate();
	//document.write(JSONObject[currentMonth][date-1]["firstLow"]);
	
	
	
	dateField.innerHTML = currentMonth +" "+date+", "+ today.getFullYear();
	document.getElementById("datepicker").value=today;
	
	
	
	var control = false;
	
function toggle() {
	
	var dateField = document.getElementById("datepicker").value;
	var date3 = new Date(dateField);
	var newDay1 = date3.getDate();
	
	var newMonth1 = month[date3.getMonth()];
	

	
	if(!control) {
	firstLow.innerHTML=JSONObject[newMonth1][newDay1-1]["firstLowH"];
	firstHigh.innerHTML=JSONObject[newMonth1][newDay1-1]["firstHighH"];
	secondLow.innerHTML=JSONObject[newMonth1][newDay1-1]["secondLowH"];
	secondHigh.innerHTML=JSONObject[newMonth1][newDay1-1]["secondHighH"];
	document.getElementById("button1").innerHTML="TIMES";
	control = true;
	}else{

	firstLow.innerHTML=JSONObject[newMonth1][newDay1-1]["firstLowT"];
	firstHigh.innerHTML=JSONObject[newMonth1][newDay1-1]["firstHighT"];
	secondLow.innerHTML=JSONObject[newMonth1][newDay1-1]["secondLowT"];
	secondHigh.innerHTML=JSONObject[newMonth1][newDay1-1]["secondHighT"];
	document.getElementById("button1").innerHTML="HEIGHTS";
	control = false;	
	
	}
	
	}
	
	
	
	
	
	 var data_file = "rossTides.txt";
 
   var http_request = new XMLHttpRequest();
   
   try{
      // Opera 8.0+, Firefox, Chrome, Safari
      http_request = new XMLHttpRequest();
   }catch (e){
      // Internet Explorer Browsers
      try{
         http_request = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         try{
            http_request = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   http_request.onreadystatechange  = function(){
      if (http_request.readyState == 4  )
      {
        // Javascript function JSON.parse to parse JSON data
        JSONObject = JSON.parse(http_request.responseText);

        // jsonObj variable now contains the data structure and can
        // be accessed as jsonObj.name and jsonObj.country.
        //document.getElementById("Name").innerHTML =  jsonObj.name;
        //document.getElementById("Country").innerHTML = jsonObj.country;
		
	firstLow.innerHTML=JSONObject[currentMonth][date-1]["firstLowT"];
	firstHigh.innerHTML=JSONObject[currentMonth][date-1]["firstHighT"];
	secondLow.innerHTML=JSONObject[currentMonth][date-1]["secondLowT"];
	secondHigh.innerHTML=JSONObject[currentMonth][date-1]["secondHighT"];
	//firstLow.innerHTML=JSONObject.month[today.getMonth()][today.getDate()-1].firstLow;
      }
   }
   http_request.open("GET", data_file, true);
   http_request.send();
	
	
	




}


function reStyle() {
	
	var month2 = new Array(12);
	month2[0] = "January";
	month2[1] = "February";
	month2[2] = "March";
	month2[3] = "April";
	month2[4] = "May";
	month2[5] = "June";
	month2[6] = "July";
	month2[7] = "August";
	month2[8] = "September";
	month2[9] = "October";
	month2[10] = "November";
	month2[11] = "December";
	
	
	var dateCh = document.getElementById("datepicker").value;
	
	var newDate = new Date(dateCh);
	
	var newDay = newDate.getDate();
	
	var newMonth = month2[newDate.getMonth()];
	
	
	//document.getElementById("date").innerHTML=newMonth +" "+newDay+", "+newDate.getFullYear();
	
	document.getElementById("date").innerHTML=newMonth+" "+newDay+", "+newDate.getFullYear() + " <br />All times in GMT (add 1hr for BST)";
	document.getElementById("firstLow").innerHTML=JSONObject[newMonth][newDay-1]["firstLowT"];
	document.getElementById("firstHigh").innerHTML=JSONObject[newMonth][newDay-1]["firstHighT"];
	document.getElementById("secondLow").innerHTML=JSONObject[newMonth][newDay-1]["secondLowT"];
	document.getElementById("secondHigh").innerHTML=JSONObject[newMonth][newDay-1]["secondHighT"];
	
}

