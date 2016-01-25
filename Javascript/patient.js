window.onload = function () {
    //-------------------------------------------------------------------------
    // define an event listener for the '#createPatientForm'
    //-------------------------------------------------------------------------
    var createPatientForm = document.getElementById('createPatientForm');
    if (createPatientForm !== null) 
    {
        createPatientForm.addEventListener('submit', validatePatientForm);
    }
    
    /*function validatePatientForm(event) {
        var form = event.target;

        if (!confirm("Is the form data correct?")) {
            event.preventDefault();
        }
    }*/

    function validatePatientForm(event) {
        var form = event.target;
        
        var fName = form['fName'].value;
        var lName = form['lName'].value;
        var address = form['address'].value;
        var phoneNumber = form['phoneNumber'].value;
        var email = form['email'].value;
        var dob = form['dob'].value;
        var dateAdmitted = form['dateAdmitted'].value;
        var wardID = form['wardID'].value;

        var spanElements = document.getElementsByClassName("error");
        for (var i = 0; i !== spanElements.length; i++) {
            spanElements[i].innerHTML = "";
        }

        var errors = new Object();

        if (fName === "") {
            errors["fName"] = "Please enter first name.\n";
        }
        if (lName === "") {
            errors["lName"] = "Please enter second name.\n";
        }
        if (address === "") {
            errors["address"] = "Please enter address\n";
        }
        if (phoneNumber === "") {
            errors["phoneNumber"] = "Please enter mobile number\n";
        }
        if (email === "") {
            errors["email"] = "Please enter email address\n";
        }
        if (dob === "") {
            errors["dob"] = "Please enter date of birth\n";
        }
        if (dateAdmitted === "") {
            errors["dateAdmitted"] = "Please enter date admitted.\n";
        }
        if (wardID === "") {
            errors["wardID"] = "Please enter ward ID.\n";
        }

        var valid = true;
        for (var index in errors) {
            valid = false;
            var errorMessage = errors[index];
            var spanElement = document.getElementById(index + "Error");
            spanElement.innerHTML = errorMessage;
        }

        if (!valid || !confirm ("Is the form data correct?")) {
            event.preventDefault() ;
        }
    }

    //-------------------------------------------------------------------------
    // define an event listener for the '#createProgrammerForm'
    //-------------------------------------------------------------------------
    var editPatientForm = document.getElementById('editPatientForm');
    if (editPatientForm !== null) {
        editPatientForm.addEventListener('submit', validatePatientForm);
    }

    //-------------------------------------------------------------------------
    // define an event listener for any '.deleteProgrammer' links
    //-------------------------------------------------------------------------
    var deleteLinks = document.getElementsByClassName('deletePatient');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }

    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this Patient?")) {
            event.preventDefault();
        }
    }

};
