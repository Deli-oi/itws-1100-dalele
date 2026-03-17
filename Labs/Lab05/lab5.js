/* Lab 5 JavaScript File 
   Place variables and functions in this file */

function validate(formObj) {
   // put your validation code here
   // it will be a series of if statements
   var alertMsg = "";
   var isValid = true;
   if (formObj.firstName.value == "") {
      if (alertMsg == "") {
         formObj.firstName.focus();
      }
      alertMsg += "You must enter a first name\n";
      isValid = false;
   }
   if (formObj.lastName.value == "") {
      if (alertMsg == "") {
         formObj.lastName.focus();
      }
      alertMsg += "You must enter a last name\n";
      
      isValid = false;
   }
   if (formObj.title.value == "") {
      if (alertMsg == "") {
         formObj.title.focus();
      }
      alertMsg += "You must enter a title\n";
      
      isValid =  false;
   }
   if (formObj.org.value == "") {
      if (alertMsg == "") {
         formObj.org.focus();
      }
      alertMsg += "You must enter an organization\n";
      
      isValid = false;
   }
   if (formObj.pseudonym.value == "") {
      if (alertMsg == "") {
         formObj.pseudonym.focus();
      }
      alertMsg += "You must enter a nickname\n";
      
      isValid = false;
   }
   if (!isValid) {
      alert(alertMsg);
   } else {
      alert("Form submitted successfully!");
   }
   return isValid;
}


function clearText() {
   var textObj = document.getElementById("comments");
   if (textObj.value == "Please enter your comments") {
      textObj.value = "";
   }
}

function emptyText() {
   var textObj = document.getElementById("comments");
   if (textObj.value == "") {
      textObj.value = "Please enter your comments";
   }
}


function showNickname() {
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var nickname = document.getElementById("pseudonym").value;

    
    alert(firstName + " " + lastName + " is " + nickname);
}