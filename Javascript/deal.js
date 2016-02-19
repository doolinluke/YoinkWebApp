window.onload = function () {
    //-------------------------------------------------------------------------
    // define an event listener for the '#createDealForm'
    //-------------------------------------------------------------------------
    var createDealForm = document.getElementById('createDealForm');
    if (createDealForm !== null) 
    {
        createDealForm.addEventListener('submit', validateDealForm);
    }

    function validateDealForm(event) {
        var form = event.target;
        
        var deal_description = form['deal_description'].value;
        var deal_category = form['deal_category'].value;
        var business_name = form['business_name'].value;

        var spanElements = document.getElementsByClassName("error");
        for (var i = 0; i !== spanElements.length; i++) {
            spanElements[i].innerHTML = "";
        }

        var errors = new Object();

        if (deal_description === "") {
            errors["deal_description"] = "Please enter deal name.\n";
        }
        if (deal_category === "") {
            errors["deal_category"] = "Please enter deal category\n";
        }
        if (business_name === "") {
            errors["business_name"] = "Please enter Business name\n";
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
    // define an event listener for the '#createDealForm'
    //-------------------------------------------------------------------------
    var editDealForm = document.getElementById('editDealForm');
    if (editDealForm !== null) {
        editDealForm.addEventListener('submit', validateDealForm);
    }

    //-------------------------------------------------------------------------
    // define an event listener for any '.deleteProgrammer' links
    //-------------------------------------------------------------------------
    var deleteLinks = document.getElementsByClassName('deleteDeal');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }

    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this Deal?")) {
            event.preventDefault();
        }
    }
};
