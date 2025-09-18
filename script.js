function chengeView() {
    var SignUpBox = document.getElementById("signUpBox");
    var SignInBox = document.getElementById("SignInBox");

    SignUpBox.classList.toggle("d-none");
    SignInBox.classList.toggle("d-none");
}
function SignUp() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("mobile", mobile.value);
    f.append("gender", gender.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "success") {
                document.getElementById("msg").innerHTML = "Register Successful";
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
            } else {
                document.getElementById("msg").innerHTML = response;
                document.getElementById("msgdiv").className = "d-block";
            }

        };
    }
    request.open("POST", "signupProcess.php", true);
    request.send(f);
}
function SignIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var Rme = document.getElementById("rememberMe");

    var f = new FormData();
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("rMe", Rme.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = response;
                document.getElementById("msgdiv2").className = "d-block";
            }
        };
    }
    request.open("POST", "signinProcess.php", true);
    request.send(f);
}

var forgotPasswordModal;

function forgotPassword() {

    var email = document.getElementById("email2").value;
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "success") {
                alert("Verification Code Send to your Email. Please check Email");
                var modal = document.getElementById("Fpassword");
                forgotPasswordModal = new bootstrap.Modal(modal);
                forgotPasswordModal.show();
            } else {
                document.getElementById("msg2").innerHTML = response;
                document.getElementById("msgdiv2").className = "d-block";
            }
        }
    }

    request.open("GET", "forgotPasswordProcess.php?e=" + email, true);
    request.send();
}
function ShowPassword1() {
    var textfield = document.getElementById("np");
    var button = document.getElementById("npb");

    if (textfield.type == "password") {
        textfield.type = "text";
        button.innerHTML = "Hide"
    } else {
        textfield.type = "password";
        button.innerHTML = "show"
    }

}
function ShowPassword2() {
    var textfield = document.getElementById("rnp");
    var button = document.getElementById("rnpb");

    if (textfield.type == "password") {
        textfield.type = "text";
        button.innerHTML = "Hide"
    } else {
        textfield.type = "password";
        button.innerHTML = "show"
    }
}
function ResetPassword() {
    var email = document.getElementById("email2");
    var NewPassword = document.getElementById("np");
    var RetypePassword = document.getElementById("rnp");
    var Verification = document.getElementById("vcode");

    var f = new FormData();
    f.append("e", email.value);
    f.append("n", NewPassword.value);
    f.append("r", RetypePassword.value);
    f.append("v", Verification.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "success") {
                alert("password Update Successful");
                forgotPasswordModal.hide();
                window.location = "index.php";
            } else {
                alert(response);
            }
        }
    }
    request.open("POST", "resetPasswordProcess.php", true);
    request.send(f);
}
function signout() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "success") {
                alert("Log Out Successfull");
                window.location.reload();
            }
        };
    }
    request.open("POST", "signoutProcess.php", true);
    request.send();
}
function UpdateProfileImage() {
    var img = document.getElementById("profileimage");
    img.onchange = function () {
        var file = this.file(0);
        var url = window.URL.createObjectURL(file);

        document.getElementById("img").src = url;
    }
}

function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var address1 = document.getElementById("address1");
    var address2 = document.getElementById("address2");
    var province = document.getElementById("Province");
    var district = document.getElementById("District");
    var city = document.getElementById("City");
    var postalcode = document.getElementById("Postalcode");
    var imege = document.getElementById("profileimage");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("a1", address1.value);
    form.append("a2", address2.value);
    form.append("p", province.value);
    form.append("d", district.value);
    form.append("c", city.value);
    form.append("pc", postalcode.value);
    form.append("i", imege.files[0]);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Updaated" || response == "Saved") {

                window.location.reload();

            } else {

                alert(response);
            }
        }
    }
    request.open("POST", "UpdateProfileProccess.php", true);
    request.send(form);

}