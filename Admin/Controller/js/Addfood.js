
    const foodForm = document.getElementById("foodForm");
    const submit= document.getElementById("submitFood");
    const cancel = document.querySelector(".cancelButton");
    submit.addEventListener("click", function(e){
        console.log("start");

        e.preventDefault();
        
        let valid = true;

        const name = (document.getElementById("food_name")?.value || "").trim();
        const category = (document.getElementById("food_category")?.value || "").trim();
        const priceRaw = (document.getElementById("price")?.value || "").trim();
        const status = (document.getElementById("status")?.value || "").trim();
        const quantityRaw = (document.getElementById("quantity")?.value || "").trim();

        if (!name || name.length < 3) {
            valid = false;
        }

        if (!category || category.length < 3) {
            valid = false;
        }

        const price = parseFloat(priceRaw);
        if (Number.isNaN(price) || price <= 0) {
            valid = false;
        }

        const quantity = Number.parseInt(quantityRaw, 10);
        if (Number.isNaN(quantity) || quantity < 0) {
            valid = false;
        }

        if (!status) {
            valid = false;
        }

        if (!valid) {
            alert("Please Fill the form again");
            reset();
            return;
        }

        console.log(name);
        console.log(category);
        console.log(price);
        console.log(quantity);
        console.log(status);



        $.ajax({
            url: "../../Controller/php/Addfood.php",
            type: "POST",
            dataType: "json",
            data: {
                name: name,
                category: category,
                price: price,
                quantity: quantity,
                status: status
            },
            success: function(response){
                if(response.success){
                    alert(response.message);
                    window.location.href = "Foodlist.php";
                } else {
                    var message = response.message || "An unknown error occurred!";
                    alert(message);
                }
            },
            error: function (xhr, statusText, error) {
                console.error("AJAX Error:", statusText, error);
                console.error("Response:", xhr.responseText);
                alert("Error sending data: " + error);
            }
        });

     })
   


   function reset() {
        document.getElementById("foodForm").reset();
    }

    cancel.addEventListener("click", function(e){
        reset();
    })





