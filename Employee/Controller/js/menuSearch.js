function searchFood() {
    let keyword = $("#searchInput").val();

    $.ajax({
        url: "../../Controller/php/SearchMenu.php",
        type: "POST",
        data: { keyword: keyword },
        dataType: "html",
        success: function (response) {
            $("#menuBody").html(response);
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            alert("Search failed");
        }
    });
}

