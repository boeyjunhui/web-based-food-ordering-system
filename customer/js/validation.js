//validate rider sign up
function validate_rider_sign_up() {

    var password = document.getElementById('p1').value;
    var retypepassword = document.getElementById('p2').value;
    var phone = document.getElementById('phone').value;
    var firstname = document.getElementById('name1').value;
    var lastname = document.getElementById('name2').value;
    var name_pattern = /^[a-zA-Z ]+$/
    var email = document.getElementById('email').value;
    var email_pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/
    var ic = document.getElementById('ic').value;
    var zipcode = document.getElementById('zipcode').value;


    if (!firstname.match(name_pattern)) {
        alert("Invalid Name. Use letters only.");
        return false;
    }
    if (!lastname.match(name_pattern)) {
        alert("Invalid Name. Use letters only.");
        return false;
    } else if (isNaN(phone) || phone.length != 10) {
        alert("Invalid Phone Number. Number length must be 10.");
        return false;
    } else if (!email.match(email_pattern)) {
        alert("Invalid Email. Must require proper email characters.");
        return false;
    } else if (isNaN(ic) || ic.length != 12) {
        alert("Invalid Identification Number. Number length must be 12.");
        return false;
    } else if (isNaN(zipcode) || zipcode.length != 5) {
        alert("Invalid Zip code. must be written in numeric and 5 digits only.");
        return false;
    } else if (password != retypepassword) {
        alert("Password confirmation does not match.");
        return false;
    } else {
        return true;
    }

}

//validate contact
function validate_contact() {

    var phone = document.getElementById('phone').value;
    var firstname = document.getElementById('name1').value;
    var lastname = document.getElementById('name2').value;
    var name_pattern = /^[a-zA-Z ]+$/
    var email = document.getElementById('email').value;
    var email_pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/


    if (!firstname.match(name_pattern)) {
        alert("Invalid Name. Use letters only.");
        return false;
    } else if (!lastname.match(name_pattern)) {
        alert("Invalid Name. Use letters only.");
        return false;
    } else if (!email.match(email_pattern)) {
        alert("Invalid Email. Must require proper email characters.");
        return false;
    } else if (isNaN(phone) || phone.length != 10) {
        alert("Invalid Phone Number. Number length must be 10.");
        return false;
    } else {
        return true;
    }

}

//validate customer sign up
function validate_sign_up() {

    var password = document.getElementById('pwd').value;
    var phone = document.getElementById('phone').value;
    var firstname = document.getElementById('fname').value;
    var lastname = document.getElementById('lname').value;
    var name_pattern = /^[a-zA-Z ]+$/
    var email = document.getElementById('email').value;
    var email_pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/
    var zipcode = document.getElementById('zipcode').value;
    var city = document.getElementById('city').value;
    var city_pattern = /^[a-zA-Z ]+$/


    if (!firstname.match(name_pattern)) {
        alert("Invalid Name. Use letters only.");
        return false;
    }
    if (!lastname.match(name_pattern)) {
        alert("Invalid Name. Use letters only.");
        return false;
    } else if (isNaN(phone) || phone.length != 10) {
        alert("Invalid Phone Number. Number length must be 10.");
        return false;
    } else if (!email.match(email_pattern)) {
        alert("Invalid Email. Must require proper email characters.");
        return false;
    } else if (!city.match(city_pattern)) {
        alert("Invalid City. Use letters only.");
        return false;
    } else if (isNaN(zipcode) || zipcode.length != 5) {
        alert("Invalid Zip code. must be written in numeric and 5 digits only.");
        return false;
    } else {
        return true;
    }

}

//validate customer edit profile
function validate_edit_profile() {

    var phone = document.getElementById('phone').value;
    var firstname = document.getElementById('fname').value;
    var lastname = document.getElementById('lname').value;
    var name_pattern = /^[a-zA-Z ]+$/
    var email = document.getElementById('email').value;
    var email_pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/
    var zipcode = document.getElementById('zipcode').value;
    var city = document.getElementById('city').value;
    var city_pattern = /^[a-zA-Z ]+$/


    if (!firstname.match(name_pattern)) {
        alert("Invalid Name. Use letters only.");
        return false;
    }
    if (!lastname.match(name_pattern)) {
        alert("Invalid Name. Use letters only.");
        return false;
    } else if (isNaN(phone) || phone.length != 10) {
        alert("Invalid Phone Number. Number length must be 10.");
        return false;
    } else if (!email.match(email_pattern)) {
        alert("Invalid Email. Must require proper email characters.");
        return false;
    } else if (!city.match(city_pattern)) {
        alert("Invalid City. Use letters only.");
        return false;
    } else if (isNaN(zipcode) || zipcode.length != 5) {
        alert("Invalid Zip code. must be written in numeric and 5 digits only.");
        return false;
    } else {
        return true;
    }

}