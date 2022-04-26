function getContactData() {
    axios({
            method: "get",
            url: "admin/contactData",
            responseType: "json",
        })
        .then(function(response) {
            if (response.status == 200) {
                $("#MainDivcontact").removeClass("d-none");
                $("#loaderDivcontact").addClass("d-none");

                $("#contactDataTable").DataTable().destroy();
                $("#contact_table").empty();

                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $("<tr>")
                        .html(
                            "<td>" + jsonData[i].contact_name + " </td>" +
                            "<td>" + jsonData[i].contact_mobile + " </td>" +
                            "<td>" + jsonData[i].contact_email + " </td>" +
                            "<td>" + jsonData[i].contact_msg + " </td>" +

                            "<td><a  class='contactDeletebtn' data-id=" +
                            jsonData[i].id +
                            "  ><i class='fas fa-trash-alt'></i></a> </td>"
                        )
                        .appendTo("#contact_table");
                });
                $('.contactDeletebtn').click(function() {
                    var id = $(this).data("id");

                    $("#contactdeleteId").attr("data-id", id);
                    $('#deleteContactModal').modal('show');
                })

                // DataTable show
                $("#contactDataTable").DataTable({ 'order': false });
                $(".dataTables_length").addClass("bs-select");

            } else {
                $("#loaderDivcontact").addClass("d-none");
                $("#wrongDivContact").removeClass("d-none");
            }
        })
        .catch(function(error) {
            $("#loaderDivcontact").addClass("d-none");
            $("#wrongDivContact").removeClass("d-none");
        });
}
//contact Delete Modal yes Btn
$('#contactdeleteId').click(function() {
    var id = $(this).data("id");
    ContactDelete(id);
});

//contact Delete
function ContactDelete(deleteId) {
    $("#contactdeleteId").html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios
        .post("admin/contactDelete", {
            id: deleteId,
        })
        .then(function(response) {
            $("#contactdeleteId").html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    $("#deleteContactModal").modal("hide");
                    toastr.success("Delete Successful.");
                    window.location.reload();
                } else {
                    $("#deleteContactModal").modal("hide");
                    toastr.error("Delete Failed.");
                    getCoursesData();
                }
            } else {
                $("#deleteContactModal").modal("hide");
                toastr.error("Something Went Wrong");

            }
        })
        .catch(function(error) {
            $("#deleteContactModal").modal("hide");
            toastr.error("Something Went Wrong");
        });
}