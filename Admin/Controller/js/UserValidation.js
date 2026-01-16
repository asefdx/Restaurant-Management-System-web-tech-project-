let emailExists = false;

function checkEmailExists(email) {
    if(!email || !/^[a-z0-9]+@[a-z]+\.[a-z]{3,}$/.test(email)) {
        document.getElementById("emailErr").textContent = "";
        emailExists = false;
        return;
    }
    
    $.ajax({
        url: "../../Controller/php/EmailCheck.php",
        dataType: "json",
        method: "POST",
        data: {
            email: email
        },
        success: function(response) {
            if (response.success) {
                document.getElementById("emailErr").textContent = "Email already exists";
                document.getElementById("emailErr").style.color = "red";
                emailExists = true;
            } else {
                document.getElementById("emailErr").textContent = "Email available";
                document.getElementById("emailErr").style.color = "green";
                emailExists = false;
            }
        },
        error: function() {
            document.getElementById("emailErr").textContent = "";
            emailExists = false;
        }
    });
}



submit=document.getElementById("submitUser");
submit.addEventListener("click",function(e){
    e.preventDefault();
    
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let roleSelected = document.querySelector('input[name="role"]:checked');
    
    // Validation before sending
    if(!name || name.trim() === "") {
        alert("Please enter a name");
        return false;
    }
    
    if(emailExists) {
        alert("Email is already registered in database");
        return false;
    }

    if(password.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
    }
    
    if(!roleSelected) {
        alert("Please select a role");
        return false;
    }
    
  
    $.ajax({
        url : "../../Controller/php/UserValidation.php",
        type : "POST",
        dataType: "json",
        data : {
            name : name,
            email : email,
            password : password,
            role : roleSelected.value
        },
        success:function(response){
            if(response.success){
                alert(response.message);
                reset();
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error){
            console.error("AJAX Error:", status, error);
            console.error("Response:", xhr.responseText);
            alert("Error sending data: " + error);
        }
    })
})





function reset(){

    document.getElementById("UserFrom").reset();

}