var fname = document.getElementById("fname");
var lname = document.getElementById("lname");
var pnumber = document.getElementById("pnumber");
var recepid = document.getElementById("recepid");
var email = document.getElementById("email");
var password = document.getElementById("password");
var button1 = document.getElementById("btn1");
var button2 = document.getElementById("btn2");
var emailCheck = document.getElementById("emailcheck");
var transactionOption = document.getElementById("transaction");

//firstname validation
function fnameTest() {
    if (fname.value === null || fname.value === "") {
        alert("First name cannot be empty");
        fname.classList.remove("valid");
        fname.classList.add("invalid");
        fname.focus();
    }

    else {
        return true;
    }
}

function fnameTestCss() {
    if (fname.value === null || fname.value === "") {
        fname.classList.remove("valid");
        fname.classList.add("invalid");
    }

    else {
        return true;
    }
}

function fnameT() {
    if (fnameTestCss()) {
        fname.classList.remove("invalid");
        fname.classList.add("valid");
        return true;
    }
}

fname.addEventListener("keyup", fnameT);


//last name validation
function lnameTest() {
    if (lname.value === null || lname.value === "") {
        alert("Last name cannot be empty");
        lname.classList.remove("valid");
        lname.classList.add("invalid");
        lname.focus();
    }

    else {
        return true;
    }
}

function lnameTestCss() {
    if (lname.value === null || lname.value === "") {
        lname.classList.remove("valid");
        lname.classList.add("invalid");
        lname.focus();
    }

    else {
        return true;
    }
}

function lnameT() {
    if (lnameTestCss()) {
        lname.classList.remove("invalid");
        lname.classList.add("valid");
        return true;
    }
}

lname.addEventListener("keyup", lnameT);



//password validation
function passwordTest() {
    var upperCase = /^(?=.*[A-Z])/;
    var specialChar = /^(?=.*[!@#$%^&*])/;
    var num = /^(?=.*[0-9])/;
    if (password.value.length > 14) {
        alert("Password must be less than 14");
        password.classList.remove("valid");
        password.classList.add("invalid");
        password.focus();
    }
    
    else if (!upperCase.test(password.value)) {
        alert("Password must contain at least an upper letter");
        password.classList.remove("valid");
        password.classList.add("invalid");
        password.focus();
    }

    
    else if (!specialChar.test(password.value)) {
        alert("Password must contain at least one special character");
        password.classList.remove("valid");
        password.classList.add("invalid");
        password.focus();
    } 

    else if (!num.test(password.value)) {
        alert("Password must contain at least a number");
        password.classList.remove("valid");
        password.classList.add("invalid");
        password.focus();
    }

    else {
        return true;
    }
}

function passwordTestCss() {
    var upperCase = /^(?=.*[A-Z])/;
    var specialChar = /^(?=.*[!@#$%^&*])/;
    var num = /^(?=.*[0-9])/;
    if (password.value.length > 14) {
        password.classList.remove("valid");
        password.classList.add("invalid");
        password.focus();
    }
    
    else if (!upperCase.test(password.value)) {
        password.classList.remove("valid");
        password.classList.add("invalid");
        password.focus();
    }

    
    else if (!specialChar.test(password.value)) {
        password.classList.remove("valid");
        password.classList.add("invalid");
        password.focus();
    } 

    else if (!num.test(password.value)) {
        password.classList.remove("valid");
        password.classList.add("invalid");
        password.focus();
    }

    else {
        return true;
    }
}

function passwordT() {
    if (passwordTestCss()) {
        password.classList.remove("invalid");
        password.classList.add("valid");
        return true;
    }
}

password.addEventListener("keyup", passwordT);


//ID validation
function idTest() {
    var idregex = /\D/;
    if (idregex.test(recepid.value) || recepid.value.length < 6 || recepid.value.length > 6) {
        alert("User ID should contain exactly 6 digits");
        recepid.classList.remove("valid");
        recepid.classList.add("invalid");
        recepid.focus();
    }

    else {
        return true;
    }
}

function idTestCss() {
    var idregex = /\D/;
    if (idregex.test(recepid.value) || recepid.value.length < 6 || recepid.value.length > 6) {
        recepid.classList.remove("valid");
        recepid.classList.add("invalid");
        recepid.focus();
    }

    else {
        return true;
    }
}

function idT() {
    if (idTestCss()) {
        recepid.classList.remove("invalid");
        recepid.classList.add("valid");
        return true;
    }
}

recepid.addEventListener("keyup", idT);



//Phone number validation
function phoneTest() {
    var phoneNum = /^\d{3}[-\s]?\d{3}[-\s]?\d{4}$/;
    if (!phoneNum.test(pnumber.value) || pnumber.value.length > 12) {
        alert("Phone number should contain exact 10 digits");
        pnumber.classList.remove("valid");
        pnumber.classList.add("invalid");
        pnumber.focus();
    }

    else {
        return true;
    }
}

function phoneTestCss() {
    var phoneNum = /^\d{3}[-\s]?\d{3}[-\s]?\d{4}$/;
    if (!phoneNum.test(pnumber.value) || pnumber.value.length > 12) {
        pnumber.classList.remove("valid");
        pnumber.classList.add("invalid");
        pnumber.focus();
    }

    else {
        return true;
    }
}

function phoneT() {
    if (phoneTestCss()) {
        pnumber.classList.remove("invalid");
        pnumber.classList.add("valid");
        return true;
    }
}

pnumber.addEventListener("keyup", phoneT);



//Email validation
function emailTest() {
    var emailRe = /^\w+(_?\w+)*@\w+\.\w{3,6}$/;
    if (!emailRe.test(email.value)) {
        alert("Email is invalid");
        email.classList.remove("valid");
        email.classList.add("invalid");
        email.focus();
    }

    else {
        return true;
    }
}

function emailTestCss() {
    var emailRe = /^\w+(_?\w+)*@\w+\.\w{3,6}$/;
    if (!emailRe.test(email.value)) {
        email.classList.remove("valid");
        email.classList.add("invalid");
        email.focus();
    }

    else {
        return true;
    }
}

function emailT() {
    if (emailTestCss()) {
        email.classList.remove("invalid");
        email.classList.add("valid");
        return true;
    }
}

email.addEventListener("keyup", emailT);



//Testing orderly
function validate() {
    if (fnameTest()) {
        if (lnameTest()) {
            if (phoneTest()) {
                if (idTest()) {
                    if (!email.disabled) {
                        if (emailTest()) {
                            if (passwordTest()) {
                                if (!transactionCheck()) {
                                    return false;
                                }
                            

                                else {
                                    return true;
                                }
                            }
                        }
                    }

                    else {
                        if (passwordTest()) {
                            if (!transactionCheck()) {
                                return false;
                            }
                        

                            else {
                                return true;
                            }
                        }
                    }
                }
            }
        }
    }
}


//Email checkbox
function emailOptional() {
    if (email.disabled) {
        email.removeAttribute("disabled");
        email.setAttribute("required", "");
        return false;
    }

    else {
        email.setAttribute("disabled", "");
        email.removeAttribute("required");
        return true;
    }
}

emailCheck.addEventListener("click", emailOptional);

//Transaction
function transactionCheck() {
    if (transactionOption.value == "none") {
        alert("Please choose a transaction");
        return false;
    }
    return true;
}

button1.addEventListener("click", function(event) {
    if (!validate()) {
        event.preventDefault();
    }
});








