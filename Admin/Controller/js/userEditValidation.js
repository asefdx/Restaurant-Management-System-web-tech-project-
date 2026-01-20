window.addEventListener('DOMContentLoaded', function () {
    const editUser = sessionStorage.getItem('editUser');
    if (!editUser) return;

    const user = JSON.parse(editUser);

    document.getElementById('name').value = user.name ?? '';
    document.getElementById('email').value = user.email ?? '';
    document.getElementById('password').value = user.password ?? '';
    document.getElementById('userId').value = user.user_id ?? '';


    document.getElementById('role').value =
        (user.role || '').toLowerCase().trim();

    sessionStorage.removeItem('editUser');
});

function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggle = field.nextElementSibling;
            
            if (field.type === 'password') {
                field.type = 'text';
                toggle.textContent = 'Hide';
            } else {
                field.type = 'password';
                toggle.textContent = 'Show';
            }
        }

        
        document.getElementById('editProfileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let isValid = true;

            const userId = document.getElementById('userId').value;
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim().toLowerCase(); // normalize to lowercase
            const password = document.getElementById('password').value;
            const role = document.getElementById('role').value;

            const emailPattern = /^[a-z0-9._%+-]+@[a-z]+(?:-[a-z]+)?\.[a-z]{2,}$/; // lowercase, no numbers in domain

            // console.log("name");
            // console.log("email");
             // console.log("password");
            // console.log("role");
            if (!name || name.length <= 3) {
                alert("Please enter a name with more than 3 characters");
                isValid = false;
            }

           
            if (!emailPattern.test(email)) {
                alert("Invalid Email");
                isValid = false;
            }

           
            if (password.length < 6) {
                alert("Invalid Password");
                isValid = false;
            }

           
            if (!role) {
                alert("Please select a role");
                isValid = false;
            }

            if (!isValid) {
                alert("There is something wrong in your input. Please check again");
                return;
            }

                $.ajax({
                    url : "../../Controller/php/UpdateUser.php",
                    type : "POST",
                    datatype: "json",
                    data:{
                        userId: userId,
                        name: name,
                        email: email,
                        password: password,
                        role: role,
                    },
                success:function(response){
                    if(response.Success){
                         alert(response.message);
                         window.location.href = "../../View/html/userList.php";
                     } else {
        
                        var message = response.message || "An unknown error occurred!";
                        alert(message);
                        }
                },
                    error: function(xhr, status, error){
                     console.error("AJAX Error:", status, error);
                    console.error("Response:", xhr.responseText);
                     alert("Error sending data: " + error);
                    }

                
                });
            


        });
