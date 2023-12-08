var quill = new Quill("#editor", {
    theme: "snow",
});
$("#form").on("submit", function() {
    $("#hiddenDescription").val(quill.root.innerHTML);
});
//setInterval(() => {console.log(quill.root.innerHTML)}, 5000)

$(function() {
    $("form").submit(function(e) {
        var formData = $(this).serialize(); // pobranie danych z formularza
        var formArray = $(this).serializeArray();

        var action;
        $.each(formArray, function(i, field) {
            if (field.name == "action") {
                action = field.value;
            }
        });

        console.log(action);
        if (action != "edit") {
            e.preventDefault(); // zablokowanie domyślnego zachowania formularza

            $.ajax({
                url: "../api.php", // adres, na który zostaną wysłane dane
                type: "POST",
                data: formData, // dane z formularza
                success: function(response) {
                    console.log(response); // tutaj można dodać kod obsługi sukcesu
                    window.location.href = window.location.href;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus, errorThrown); // tutaj można dodać kod obsługi błędu
                },
            });
        }
    });
});

function showForm() {
    var formElement = document.querySelector(".form-element");

    if (window.getComputedStyle(formElement).display === "block") {
        formElement.style.display = "none";
    } else {
        formElement.style.display = "block";
    }
}

function edit(id) {
    var formElement = document.querySelector(".form-element");

    if (window.getComputedStyle(formElement).display === "block") {
        formElement.style.display = "none";
    } else {
        formElement.style.display = "block";
    }
}