function validateRegistration(form) {
    var username = form['username'].value;
    var password = form['password'].value;
    var password2 = form['password2'].value;

    var spanElements = document.getElementsByClassName("error");
    for (var i = 0; i !== spanElements.length; i++) {
        spanElements[i].innerHTML = "";
    }

    var errors = new Object();

    if (username === "") {
        errors["username"] = "Username cannot be empty\n";
    }
    if (password === "") {
        errors["password"] = "Password cannot be empty\n";
    }
    if (password2 === "") {
        errors["password2"] = "Password2 cannot be empty\n";
    }
    else if (password === password2) {
        errors["password2"] = "Passwords must match\n";
    }

    var valid = true;
    for (var index in errors) {
        valid = false;
        var errorMessage = errors[index];
        var spanElement = document.getElementById(index + "Error");
        spanElement.innerHTML = errorMessage;
    }
    
    if (!valid) {
        event.preventDeFault() ;
    }
}

