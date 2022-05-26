$("#btn-add-obat").on("click", function () {
    $("#form-add-obat").clone(true).attr("id", "").appendTo("#list-obat");
});

$("#btn-remove-obat").on("click", function () {
    const children = $("#list-obat").children();
    if (children.length > 1) {
        children.last().remove();
    }
});

$("#type").on("change", function () {
    const selected = $("#type option:selected").val();

    if (selected == "racikan") {
        $("#list-racikan").addClass("show");
        $("#list-racikan").removeClass("d-none");
        $(".list-obat").addClass("d-none");
        $(".list-obat").removeClass("show");
    } else {
        $("#list-racikan").addClass("d-none");
        $("#list-racikan").removeClass("show");
        $(".list-obat").addClass("show");
        $(".list-obat").removeClass("d-none");
    }
});

// tambah prescription
var number = 1;
$("#btn-tambah-prescription").on("click", function () {
    const type = $("#type option:selected").val();
    const item_id = $(".show option:selected").val();
    const qty = $("#qty").val();
    var racikan = null;
    var obat = null;
    var signa = $("#signa option:selected").val();

    if (item_id == undefined || !item_id || item_id == "") {
        return;
    }

    if (signa == undefined || !signa || signa == "") {
        $("#signa-error").removeClass("d-none");
        return;
    }

    if (type == "racikan") {
        const r = getStokRacikan(item_id);
        if (!checkStokRacikan(r)) {
            return;
        }
        racikan = r;
    } else {
        if (qty <= 0) {
            $("#qty-error").removeClass("d-none");
            $("#qty-empty").removeClass("d-none");
            return;
        }

        if (getStokObat(item_id) - qty <= 0) {
            $("#qty-error").removeClass("d-none");
            $("#qty-offset").removeClass("d-none");
            $("#qty-empty").addClass("d-none");
            return;
        }

        obat = getObat(item_id);
    }

    const newData = {
        racikan: racikan,
        obat: obat,
        item_id: item_id,
        qty: obat != null ? qty : "-",
        signa_id: $("#signa option:selected").val(),
        signa: $("#signa option:selected").text(),
        id: number++,
    };
    addRowTablePreview(newData);
    addRowFormPreview(newData);
});

// check stok
const baseUrl = window.location.host;

function addRowTablePreview(row) {
    console.log(row);

    if (row.racikan != null) {
        var addedRow = "<tr>";
        addedRow += `<td> ${row.id}</td>`;
        addedRow += `<td> ${row.racikan.racikan.racikan_kode} - ${row.racikan.racikan.racikan_nama}</td>`;
        addedRow += `<td> ${row.qty}</td>`;
        addedRow += `<td> ${row.signa}</td>`;
        addedRow += "</tr>";

        row.racikan.listObat.forEach((obat) => {
            addedRow += "<tr>";
            addedRow += `<td> - </td>`;
            addedRow += `<td> ${obat.obatalkes_kode} - ${obat.obatalkes_nama}</td>`;
            addedRow += `<td> ${obat.pivot.qty}</td>`;
            addedRow += `<td> </td>`;
            addedRow += "</tr>";
        });
    } else {
        var addedRow = "<tr>";
        addedRow += `<td> ${row.id}</td>`;
        addedRow += `<td> ${row.obat.obatalkes_kode} - ${row.obat.obatalkes_nama}</td>`;
        addedRow += `<td> ${row.qty}</td>`;
        addedRow += `<td> ${row.signa}</td>`;
        addedRow += "</tr>";
    }
    $("#table-preview").append(addedRow);
}

function addRowFormPreview(row) {
    if (row.obat != null) {
        var addedForm = `<input type="hidden" value=0 name="list-racikan[]">`;
        addedForm += `<input type="hidden" value=${row.obat.obatalkes_id} name="list-obat[]">`;
        addedForm += `<input type="hidden" value=${row.qty} name="list-qty[]">`;
    } else {
        var addedForm = `<input type="hidden" value=${row.racikan.racikan.id} name="list-racikan[]">`;
        addedForm += `<input type="hidden" value=0 name="list-obat[]">`;
        addedForm += `<input type="hidden" value=0 name="list-qty[]">`;
    }

    addedForm += `<input type="hidden" value=${row.signa_id} name="signa[]">`;

    $("#form-submit-prescription").append(addedForm);
}

function getStokObat(obatalkes_id) {
    return $.ajax({
        type: "GET",
        headers: {
            "Content-Type": "application/json",
        },
        async: false,
        url: "/api/obatalkes/" + obatalkes_id,
    }).responseJSON.stok;
}

function getObat(obatalkes_id) {
    return $.ajax({
        type: "GET",
        headers: {
            "Content-Type": "application/json",
        },
        async: false,
        url: "/api/obatalkes/" + obatalkes_id,
    }).responseJSON;
}

function getStokRacikan(racikan_id) {
    return $.ajax({
        type: "GET",
        headers: {
            "Content-Type": "application/json",
        },
        async: false,
        url: "/api/racikan/" + racikan_id,
    }).responseJSON;
}

function checkStokObat(stok, qty) {
    return stok - qty <= 0;
}

function checkStokRacikan(racikan) {
    const listObat = racikan.listObat;
    var errorMessage = "";

    listObat.forEach((obat) => {
        const usage = getStokObat(obat.obatalkes_id) - obat.pivot.qty;
        if (usage <= 0) {
            errorMessage += `<br><small> ${obat.obatalkes_kode} - ${obat.obatalkes_nama} || qty: ${obat.stok} </small>`;
        }
    });

    if (errorMessage != "") {
        $("#racikan-error").removeClass("d-none");
        $("#racikan-error").append(errorMessage);

        return false;
    }

    return true;
}
