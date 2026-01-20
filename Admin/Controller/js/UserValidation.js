const emailPattern = /^[a-z0-9._%+-]+@[a-z]+(?:-[a-z]+)?\.[a-z]{2,}$/; 
let emailExists = false;

function togglePassword() {
            let pwd = document.getElementById('password');
            let toggle = document.querySelector('.showPasswordToggle');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                toggle.textContent = 'Hide';
            } else {
                pwd.type = 'password';
                toggle.textContent = 'Show';
            }
        }

function checkEmailExists(email) {
    email = (email || "").trim().toLowerCase();
    
    
    if (!email) {
        document.getElementById("emailErr").textContent = "";
        document.getElementById("emailErr").style.display = "none";
        emailExists = false;
        return false;
    }
    
    
    if (!emailPattern.test(email)) {
        document.getElementById("emailErr").textContent = "Please enter a valid email format";
        document.getElementById("emailErr").style.color = "orange";
        document.getElementById("emailErr").style.display = "block";
        emailExists = false;
        return false;
    }
    
    $.ajax({
        url: "../../Controller/php/EmailCheck.php",
        dataType: "json",
        method: "POST",
        async: false, 
        data: {
            email: email
        },
        
        success: function(response) {
            if (response.success) {
                document.getElementById("emailErr").textContent = "Email already exists";
                document.getElementById("emailErr").style.color = "red";
                document.getElementById("emailErr").style.display = "block";
                emailExists = true;
            } else {
                document.getElementById("emailErr").textContent = "Email available";
                document.getElementById("emailErr").style.color = "green";
                document.getElementById("emailErr").style.display = "block";
                emailExists = false;
            }
        },
        error: function() {
            document.getElementById("emailErr").textContent = "";
            document.getElementById("emailErr").style.display = "none";
            emailExists = false;
        }
    });
    return emailExists; 
}

submit = document.getElementById("submitUser");
submit.addEventListener("click", function(e) {
    e.preventDefault();
    
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim().toLowerCase();
    let password = document.getElementById("password").value.trim();
    let roleSelected = document.getElementById("role").value;
    
    
    if (!name || name.length <= 3) {
        alert("Please enter a name with more than 3 characters");
        return false;
    }

    if (!emailPattern.test(email)) {
        alert("Invalid email format")
        return false;
    }
    
    if (checkEmailExists(email)) {
        alert("Email is already registered in database");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
    }
    
    if (!roleSelected) {
        alert("Please select a role");
        return false;
    }

    // console.log(name);
    // console.log(email);
    // console.log(password);
    // console.log(roleSelected);
    $.ajax({
        url: "../../Controller/php/UserValidation.php",
        type: "POST",
        dataType: "json",
        data: {
            name: name,
            email: email,
            password: password,
            role: roleSelected
        },
        success: function(response) {
            if (response.success) {
                alert(response.message);
                reset();
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.error("Response:", xhr.responseText);
            alert("Error sending data: " + error);
        }
    });
});

function reset() {
    document.getElementById("UserFrom").reset();
}

function editUser(userData) {
    
    const user = JSON.parse(userData);
    
    sessionStorage.setItem('editUser', JSON.stringify(user));
    
    window.location.href = 'EditUser.php';
}

function deleteUser(userId){

    $.ajax({
        url:"../../Controller/php/DeleteUser.php",
        dataType: "json",
        type:"POST",
        data: {
            userId: userId
        },
         success: function(response) {
            if (response.success) {
                alert(response.message);
                window.location.href = "../../View/html/userList.php";
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.error("Response:", xhr.responseText);
            alert("Error sending data: " + error);
        }

    });



}

