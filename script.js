function onClick(){
    window.location.href="contactus.html"
}

function onKumari(){
    window.location.href="http://localhost/PHOTOGRAPHY%20WEBSITE/ganesh.php"
}

function onWedding(){
    window.location.href="wedding_gallery.html"
}

function onPress(){
    window.location.href="gallery.html"
}


function onLogin(){
    window.location.href="login.html"
}

function onRegister(){
    window.location.href="register.html"
}

function onLoad() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (email === "user05@gmail.com" && password === "user1234") {
        window.location.href = "index.html";
    } else if (email === "admin05@gmail.com" && password === "admin1234") {
        window.location.href = "http://localhost/PHOTOGRAPHY%20WEBSITE/admin.php";
    } else {
        document.getElementById("login-message").innerText = "Invalid email or password.";
    }
}

