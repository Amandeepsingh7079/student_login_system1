function validateForm() {
    // Get form elements
    let fname = document.forms["myform"]["fname"].value;
    let lname = document.forms["myform"]["lname"].value;
    let password = document.forms["myform"]["password"].value;
    let cpassword = document.forms["myform"]["cpassword"].value;
    let gender = document.forms["myform"]["gender"].value;
    let email = document.forms["myform"]["email"].value;
    let phone = document.forms["myform"]["phone"].value;
    let address = document.forms["myform"]["address"].value;
   

    // Validate first name
    if (fname == "") {
        alert("First Name must be filled out");
        return false;
    }

    // Validate last name
    if (lname == "") {
        alert("Last Name must be filled out");
        return false;
    }

    // Validate password
    if (password == "") {
        alert("Password must be filled out");
        return false;
    }

    // Validate confirm password
    if (cpassword == "") {
        alert("Confirm Password must be filled out");
        return false;
    }

    // Check if passwords match
    if (password !== cpassword) {
        alert("Passwords do not match");
        return false;
    }

    // Validate gender selection
    if (gender == "select") {
        alert("Please select a gender");
        return false;
    }

    // Validate email
    let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (email == "" || !emailPattern.test(email)) {
        alert("Please enter a valid email address");
        return false;
    }

    // Validate phone number
    let phonePattern = /^[0-9]{10}$/;
    if (phone == "" || !phonePattern.test(phone)) {
        alert("Please enter a valid phone number (10 digits)");
        return false;
    }

    // Validate address
    if (address == "") {
        alert("Address must be filled out");
        return false;
    }

   
}