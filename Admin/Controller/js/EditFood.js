window.addEventListener('DOMContentLoaded', function () {
    const editFood = sessionStorage.getItem('food');
    if (!editFood) return;

    const food = JSON.parse(editFood);
    document.getElementById("foodId").value = food.menu_id ?? food.manu_id ?? '';
    document.getElementById('food_name').value = food.item_name ?? '';
    document.getElementById('food_category').value = food.category ?? '';
    document.getElementById('price').value = food.price ?? '';
    document.getElementById('quantity').value = food.quantity ?? '';


    document.getElementById('status').value =
        (food.status || '').toLowerCase().trim();

    sessionStorage.removeItem('food');
});

const submit = document.getElementById("submit");
submit.addEventListener("click", function (e) {
    e.preventDefault();
    const foodId=document.getElementById("foodId").value;
    const name=document.getElementById('food_name').value;
    const category=document.getElementById('food_category').value;
    const status=document.getElementById('status').value;
    const quantity=document.getElementById("quantity").value;
    const price=document.getElementById('price').value ;
    
   

    if(!name.trim()){
        return;
    }

    const priceValue=parseFloat(price);
    if(!price.trim() || Number.isNaN(priceValue)){
        return;
    }

    const quantityValue=parseInt(quantity);
    if(quantity.trim()===''){
        return;
    } else if(Number.isNaN(quantityValue) || quantityValue<0){
        return;
    }


    // console.log(foodId);
    // console.log(name);
    // console.log(category);
    // console.log(status);
    // console.log(quantity);
    // console.log(price);

    $.ajax({
        url: "../../Controller/php/UpdateFood.php",
        type: "POST",
        dataType: "json",
        data:{
            foodId:foodId,
            name:name,
            category:category,
            status:status,
            quantity:quantity,
            price:price,
        },
        success: function(response){
                if(response.success){
                    alert(response.message);
                    window.location.href = "../../View/html/Foodlist.php";
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
    })

})