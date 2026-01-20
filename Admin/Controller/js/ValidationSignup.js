function signupValidation(){
  
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirm_password").value.trim();
    const role = document.querySelector('input[name="role"]:checked');

    // console.log("name");
    // console.log("email");
    // console.log("password");
    // console.log("role");
    
    
    if(name === ""){
        alert("Full Name is required!");
        document.getElementById("name").focus();
        return false;
    }
    if(name.length < 3){
        alert("Full Name must be at least 3 characters long!");
        document.getElementById("name").focus();
        return false;
    }
    
    
    if(email === ""){
        alert("Email Address is required!");
        document.getElementById("email").focus();
        return false;
    }
    const emailPattern = /^[a-z0-9._%+-]+@[a-z]+(?:-[a-z]+)?\.[a-z]{2,}$/; 
    if(!emailPattern.test(email)){
        alert("Please enter a valid email address!");
        document.getElementById("email").focus();
        return false;
    }
    
    
    if(password === ""){
        alert("Password is required!");
        document.getElementById("password").focus();
        return false;
    }
    if(password.length < 6){
        alert("Password must be at least 6 characters long!");
        document.getElementById("password").focus();
        return false;
    }
    
    
    if(confirmPassword === ""){
        alert("Confirm Password is required!");
        document.getElementById("confirm_password").focus();
        return false;
    }
    if(password !== confirmPassword){
        document.getElementById("confirm_password").focus();
        return false;
    }
    
    if(!role){
        return false;
    }
    
    return true;
}