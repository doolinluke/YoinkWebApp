window.onload = function () {
    //-------------------------------------------------------------------------
    // define an event listener for the '#createBusinessForm'
    //-------------------------------------------------------------------------
    var createBusinessForm = document.getElementById('createBusinessForm');
    if (createBusinessForm !== null) 
    {
        createBusinessForm.addEventListener('submit', validateBusinessForm);
    }
    
    var createBusinessForm = document.getElementById('createBusinessForm');
    if (createBusinessForm !== null) 
    {
        createBusinessForm.addEventListener('click', validateBusinessForm);
    }

    function validateBusinessForm(event) {
        var form = event.target;
        
        var business_name = form['business_name'].value;
        var business_address = form['business_address'].value;
        var business_lat = form['business_lat'].value;
        var business_long = form['business_long'].value;
        var business_type = form['business_type'].value;

        var spanElements = document.getElementsByClassName("error");
        for (var i = 0; i !== spanElements.length; i++) {
            spanElements[i].innerHTML = "";
        }

        var errors = new Object();

        if (business_name === "") {
            errors["business_name"] = "Please enter name of business.\n";
        }
        if (business_address === "") {
            errors["business_address"] = "Please enter business address.\n";
        }
        if (business_lat === "") {
            errors["business_lat"] = "Please enter latitude\n";
        }
        if (business_long === "") {
            errors["business_long"] = "Please enter longitude\n";
        }
        if (business_type === "") {
            errors["business_type"] = "Please enter business type\n";
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
    // define an event listener for the '#createBusinessForm'
    //-------------------------------------------------------------------------
    var editBusinessForm = document.getElementById('editBusinessForm');
    if (editBusinessForm !== null) {
        editBusinessForm.addEventListener('submit', validateBusinessForm);
    }

    //-------------------------------------------------------------------------
    // define an event listener for any '.deleteBusiness' links
    //-------------------------------------------------------------------------
    var deleteLinks = document.getElementsByClassName('deleteBusiness');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }

    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this Business?")) {
            event.preventDefault();
        }
    }
};
