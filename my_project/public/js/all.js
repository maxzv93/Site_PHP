// $(document).ready(function () {
//     $(".loader").fadeOut(500);
// });
//
// const showCreateModal =  () => {
//     $(".modal").show();
//     $(".modalLoader").show();
//     $.get("",{},function (data) {
//         //расставление элементов на странице и загрузка всего
//         $(".modalLoader").hide();
//     })
// };

 function showDevice(deviceId) {
    $.get("/devices/" + deviceId + ".json", {}, function (device) {
        //console.log(data);
        showModal(
            "Просмотр устройства № " + deviceId,
            device.Name + "; Цена: " + device.price,
        "<div class=\"btn btn-primary\">Купить</div>"
        );
    });
}

function showModal(name, content, buttons) {
    $(".container").addClass("blur");
    $("#modalBackground").show();

    let modalWrapper = $("#deviceModalTemplate")
        .html()
        .replace('{name}', name)
        .replace('{content}', content)
        .replace('{buttons}', buttons);

    $("#modalBackground").after(modalWrapper);
}

function hideModal() {
    $("#modalBackground").hide();
    $("#modalBackground").next().remove();
    $(".blur").removeClass("blur");
}


function addToFavourite(deviceId) {
    // Отправка запроса обработка результата
    // let result;
    $.get("/devices/add_to_favourite/" + deviceId, {}, function (result) {
        console.log(result);
        if(result.status === "success")
            alert("Добавили");
        else
            alert("Все плохо");
    });

}