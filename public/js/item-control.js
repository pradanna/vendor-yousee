var path;

function createElement(value) {
    let image = value['image3'];
    let city = value['city']['name'];
    let address = value['address'];
    let id = value['id'];
    let statusRent = value['status_rent'];
    let statusClass = '';
    let statusString = '-';
    let rentUntilString = '';

    switch (statusRent) {
        case 0:
            statusClass = 'tersedia';
            statusString = 'Tersedia';
            break;
        case 1:
            statusClass = 'disewa';
            statusString = 'Disewa';
            let dateRentUntil = value['rent_until'];
            if (dateRentUntil !== null) {
                let date = new Date(dateRentUntil);
                let dateString = date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
                rentUntilString = '<p>Di sewa sampai tanggal ' + dateString + '</p>';
            }
            break;
        case 2:
            statusClass = 'akandiseway';
            statusString = 'Akan Disewa';
            break;
        default:
            break;
    }
    return '<div class="card">' +
        '<div class="card-content">' +
        '<img src="' + image + '" alt="img-item" />' +
        '<div>' +
        '<p class="fw-bold">' + city + '</p>' +
        '<p class="text-grey">' + address + '</p>' +
        '<span class="status ' + statusClass + '">' + statusString + '</span>' + rentUntilString +
        '</div>' +
        '</div>' +
        '<div class="btn-container">' +
        '<a href="#" class="btn sewa btn-rent-trigger" data-id="' + id + '">Disewa</a>' +
        '<a href="#" class="btn akandisewa btn-will-rent-trigger" data-id="' + id + '">Akan Disewa</a>' +
        '<a href="#" class="btn tersedia btn-available-trigger" data-id="' + id + '">Tersedia</a>' +
        '</div>' +
        '</div>'
}


function generateItemElement(data = []) {
    let parent = $('#result-wrapper');
    parent.empty();
    $.each(data, function (k, v) {
        parent.append(createElement(v));
    });
    registerEventChange();
}

function registerEventChange() {
    $('.btn-rent-trigger').on('click', function (e) {
        e.preventDefault();
        let id = this.dataset.id;
        Swal.fire({
            title: "Konfirmasi!",
            text: "Apakah anda yakin merubah status?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                console.log(path)
                // let id = $('#txt-id').val();
                // saveOrderHandler(id);
            }
        });
        console.log(id)
    });

    $('.btn-will-rent-trigger').on('click', function (e) {
        e.preventDefault();
        let id = this.dataset.id;
        Swal.fire({
            title: "Konfirmasi!",
            text: "Apakah anda yakin merubah status?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                console.log(path)
                // let id = $('#txt-id').val();
                // saveOrderHandler(id);
            }
        });
        console.log(id)
    });

    $('.btn-available-trigger').on('click', function (e) {
        e.preventDefault();
        let id = this.dataset.id;
        Swal.fire({
            title: "Konfirmasi!",
            text: "Apakah anda yakin merubah status?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                console.log(path)
                changeStatusHandler(id, 0);
                // let id = $('#txt-id').val();
                // saveOrderHandler(id);
            }
        });
        console.log(id)
    });
}

async function changeStatusHandler(id, status) {
    try {
        let url = path + '/' + id;
        let data = {
            status: status,
            date: null
        };
        let response = await $.post(url, data);
        console.log(response);
    } catch (e) {
        console.log(e)
    }
}
