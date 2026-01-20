function editFood(foodData) {
    if (!foodData) return;

    const food = typeof foodData === 'string'
        ? JSON.parse(foodData)
        : foodData;

    sessionStorage.setItem('food', JSON.stringify(food));
    window.location.href = 'Editfood.php';
}

function deleteFood(menu_id){

    // console.log(menu_id);
     $.ajax({
        url: "../../Controller/php/DeleteFood.php",
        type: "POST",
        dataType: "json",
        data:{
            manu_id: menu_id
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


}