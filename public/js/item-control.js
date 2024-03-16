var itemPath;
var modalChangeOrder = new bootstrap.Modal(
    document.getElementById("modalubahpesanan")
);
var modalDetail = new bootstrap.Modal(document.getElementById("modaldetail"));

async function getItemsData(useFilter = false) {
    let elLoading = $('#loading-container');
    if (elLoading.hasClass('d-none')) {
        elLoading.removeClass('d-none');
    }
    try {
        let urlParams = window.location.search;
        let queryParam = "";
        if (urlParams !== "") {
            window.location.search
                .substr(1)
                .split("&")
                .forEach(function (v, k) {
                    let itemSplit = v.split("=");
                    let key = itemSplit[0];
                    let value = itemSplit[1] && decodeURIComponent(itemSplit[1]);
                    queryParam += "&" + key + "=" + value;
                });
        }
        let q = $("#txt-search").val();
        let filterCity = $("#filter-city").val();
        let filterStatus = $("#filter-status").val();
        let filterType = $("#filter-type").val();

        let filter = "";
        if (useFilter) {
            if (filterCity !== "") {
                filter += "&city=" + filterCity;
            }

            if (filterStatus !== "") {
                filter += "&status=" + filterStatus;
            }

            if (filterType !== "") {
                filter += "&type=" + filterType;
            }

            if (filter !== "") {
                queryParam = filter;
            }
        }

        let url = itemPath + "?q=" + q + queryParam;
        let response = await $.get(url);
        if (!elLoading.hasClass('d-none')) {
            elLoading.addClass('d-none');
        }
        let data = response["data"];
        generateItemElement(data);
    } catch (e) {
        alert("internal server error");
    }
}

function createElement(value) {
    let image = "https://internal.yousee-indonesia.com/" + value["image1"];
    let city = value["city"]["name"];
    let address = value["address"];
    let width = value["width"];
    let height = value["height"];
    let id = value["id"];
    let statusRent = value["status_rent"];
    let statusClass = "";
    let statusString = "-";
    let rentUntilString = "";

    switch (statusRent) {
        case 0:
            statusClass = "tersedia";
            statusString = "Tersedia";
            break;
        case 1:
            statusClass = "disewa";
            statusString = "Disewa";
            let dateRentUntil = value["rent_until"];
            if (dateRentUntil !== null) {
                let date = new Date(dateRentUntil);
                let dateString = date.toLocaleDateString("id-ID", {
                    day: "numeric",
                    month: "long",
                    year: "numeric",
                });
                rentUntilString = "<p>Di sewa sampai tanggal " + dateString + "</p>";
            }
            break;
        case 2:
            statusClass = "akandiseway";
            statusString = "Akan Disewa";
            break;
        default:
            break;
    }
    return (
        '<div class="card card-item " data-id="' +
        id +
        '">' +
        '<div class="card-content">' +
        '<img src="' +
        image +
        '" alt="img-item" class="img-item" onerror="onErrorImage(this)" />' +
        "<div>" +
        '<p class="fw-bold">' +
        city +
        "</p>" +
        '<p class="text-grey">' +
        address +
        "</p>" +
        '<p class="text-grey">' +
        "Ukuran: " +
        width +
        "m" +
        " x " +
        height +
        "m" +
        "</p>" +
        '<span class="status ' +
        statusClass +
        '">' +
        statusString +
        "</span>" +
        rentUntilString +
        "</div>" +
        "</div>" +
        '<div class="btn-container">' +
        '<a href="#" class="btn sewa btn-rent-trigger" data-id="' +
        id +
        '">Disewa</a>' +
        '<a href="#" class="btn akandisewa btn-will-rent-trigger" data-id="' +
        id +
        '">Akan Disewa</a>' +
        '<a href="#" class="btn tersedia btn-available-trigger" data-id="' +
        id +
        '">Tersedia</a>' +
        "</div>" +
        "</div>"
    );
}

function onErrorImage(el) {
    el.onerror = null;
    el.src = "/images/local/no-image.png";
}

function generateItemElement(data = []) {
    let parent = $("#result-wrapper");
    let elEmptyWrapper = $('#nodata-wrapper');
    parent.empty();
    if (data.length > 0) {
        elEmptyWrapper.addClass('d-none')
        $.each(data, function (k, v) {
            parent.append(createElement(v));
        });
        registerEventChange();
    } else {
        elEmptyWrapper.removeClass('d-none')
    }
}

function registerEventChange() {
    $(".card-item").on("click", function (e) {
        e.preventDefault();
        let id = this.dataset.id;
        getDataDetailHandler(id);
        // modalDetail.show();
    });
    $(".btn-rent-trigger").on("click", function (e) {
        e.stopPropagation();
        e.preventDefault();
        let id = this.dataset.id;
        $("#txt-id").val(id);
        modalChangeOrder.show();
    });

    $(".btn-will-rent-trigger").on("click", function (e) {
        e.stopPropagation();
        e.preventDefault();
        let id = this.dataset.id;
        Swal.fire({
            title: "Konfirmasi!",
            text: "Apakah anda yakin merubah status?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.value) {
                changeStatusHandler(id, 2);
            }
        });
    });

    $(".btn-available-trigger").on("click", function (e) {
        e.stopPropagation();
        e.preventDefault();
        let id = this.dataset.id;
        Swal.fire({
            title: "Konfirmasi!",
            text: "Apakah anda yakin merubah status?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.value) {
                changeStatusHandler(id, 0);
            }
        });
    });
}

function saveOrderEvent() {
    $("#btn-save-order").on("click", function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Konfirmasi!",
            text: "Apakah anda yakin menyimpan data?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.value) {
                let id = $("#txt-id").val();
                let date = $("#endDate").val();
                changeStatusHandler(id, 1, date);
                // saveOrderHandler(id);
            }
        });
    });
}

async function changeStatusHandler(id, status, date = null) {
    try {
        let url = itemPath + "/" + id;
        let data = {
            status: status,
            date: date,
        };
        let response = await $.post(url, data);
        Swal.fire({
            title: "Success",
            text: "Berhasil Merubah Data Pemakaian...",
            icon: "success",
            timer: 1000,
        }).then(() => {
            window.location.reload();
        });
    } catch (e) {
        console.log(e);
    }
}

async function getDataDetailHandler(id) {
    try {
        let url = itemPath + "/" + id;
        let response = await $.get(url);
        let data = response["data"];
        generateDetailInformation(data);
        modalDetail.show();
    } catch (e) {
        let error_message = JSON.parse(e.responseText);
        alert(error_message.message);
    }
}

function generateDetailInformation(data) {
    $("#d-provinsi").val(data["city"]["province"]["name"]);
    $("#d-kota").val(data["city"]["name"]);
    $("#d-alamat").val(data["address"]);
    $("#d-lokasi").val(data["location"]);
    $("#d-urlstreetview").val(data["url"]);
    $("#d-tipe").val(data["type"]["name"]);
    $("#d-posisi").val(data["position"]);
    $("#d-panjang").val(data["height"]);
    $("#d-lebar").val(data["width"]);
    $("#d-sisi").val(data["side"]);
    $("#d-trafik").val(data["trafic"]);
    let latitude = data["latitude"];
    let longitude = data["longitude"];
    let streetViewWrapper = $("#streetview-wrapper");
    let imageWrapper = $("#vendor-image");
    streetViewWrapper.empty();
    streetViewWrapper.append(data["url"]);
    imageWrapper.attr(
        "src",
        "https://internal.yousee-indonesia.com/" + data["image1"]
    );

    const myLatLng = {
        lat: latitude,
        lng: longitude,
    };
    map_container = new google.maps.Map(document.getElementById("main-map"), {
        zoom: 15,
        center: myLatLng,
    });
    new google.maps.Marker({
        position: new google.maps.LatLng(latitude, longitude),
        map: map_container,
    });
}

async function eventSearchHandler() {
    $("#txt-search").keyup(
        debounce(function (e) {
            console.log(e.currentTarget.value);
            getItemsData();
        }, 1000)
    );
}

function eventFilterHandler() {
    $(".filter").on("change", function (e) {
        getItemsData(true);
    });
}

function debounce(fn, delay) {
    var timer = null;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            fn.apply(context, args);
        }, delay);
    };
}
