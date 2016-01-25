window.onload = function () {
    //-------------------------------------------------------------------------
    // define an event listener for the '#createWardForm'
    //-------------------------------------------------------------------------
    var createWardForm = document.getElementById('createWardForm');
    if (createWardForm !== null) 
    {
        createWardForm.addEventListener('submit', validateWardForm);
    }
    
    /*function validateWardForm(event) {
        var form = event.target;

        if (!confirm("Is the form data correct?")) {
            event.preventDefault();
        }
    }*/

    function validateWardForm(event) {
        var form = event.target;
        
        var wardName = form['wardName'].value;
        var numberBeds = form['numberBeds'].value;
        var headNurse = form['headNurse'].value;

        var spanElements = document.getElementsByClassName("error");
        for (var i = 0; i !== spanElements.length; i++) {
            spanElements[i].innerHTML = "";
        }

        var errors = new Object();

        if (wardName === "") {
            errors["wardName"] = "Please enter ward name.\n";
        }
        if (numberBeds === "") {
            errors["numberBeds"] = "Please enter number of beds.\n";
        }
        if (headNurse === "") {
            errors["headNurse"] = "Please enter head nurse\n";
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
    var editWardForm = document.getElementById('editWardForm');
    if (editWardForm !== null) {
        editWardForm.addEventListener('submit', validateWardForm);
    }

    //-------------------------------------------------------------------------
    // define an event listener for any '.deleteProgrammer' links
    //-------------------------------------------------------------------------
    var deleteLinks = document.getElementsByClassName('deleteWard');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }

    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this Ward?")) {
            event.preventDefault();
        }
    }

};
