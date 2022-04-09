// Visitor Page Table
$(document).ready(function() {
    $("#VisitorDt").DataTable();
    $(".dataTables_length").addClass("bs-select");
});

// To Service Page Table

function getServiceData() {
    axios({
            method: "get",
            url: "admin/getServiceData",
            responseType: "json",
        })
        .then(function(response) {
            if (response.status == 200) {
                $("#mainDiv").removeClass("d-none");
                $("#loaderDiv").addClass("d-none");

                $("#service_table").empty();

                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $("<tr>")
                        .html(
                            "<td><img class='table-img' src=" +
                            jsonData[i].service_img +
                            "></td>" +
                            "<td>" +
                            jsonData[i].service_name +
                            "</td>" +
                            "<td>" +
                            jsonData[i].service_des +
                            "</td>" +
                            "<td><a class='serviceEditbtn' data-id=" +
                            jsonData[i].id +
                            " ><i class='fas fa-edit'></i></a> </td>" +
                            "<td><a  class='serviceDeletebtn' data-id=" +
                            jsonData[i].id +
                            "  ><i class='fas fa-trash-alt'></i></a> </td>"
                        )
                        .appendTo("#service_table");
                });

                //Service Table Delete Icon Click
                $(".serviceDeletebtn").click(function() {
                    var id = $(this).data("id");

                    $("#servicedeleteId").attr("data-id", id);
                    $("#deleteModal").modal("show");
                });


                //Service Table Edit Icon Click
                $(".serviceEditbtn").click(function() {
                    var id = $(this).data("id");
                    $("#SeditId").html(id);
                    ServiceUpdateDetails(id);
                    $("#editModal").modal("show");
                });
            } else {
                $("#loaderDiv").addClass("d-none");
                $("#wrongDiv").removeClass("d-none");
            }
        })
        .catch(function(error) {
            $("#loaderDiv").addClass("d-none");
            $("#wrongDiv").removeClass("d-none");
        });
}

//Service Delete Modal yes Btn
$("#servicedeleteId").click(function() {
    var id = $(this).data("id");
    ServiceDelete(id);
});
//Service Delete
function ServiceDelete(deleteId) {
    axios
        .post("admin/ServiceDelete", {
            id: deleteId,
        })
        .then(function(response) {
            if (response.status == 200) {
                if (response.data == 1) {
                    $("#deleteModal").modal("hide");
                    toastr.success("Delete Successful.");
                    window.location.reload();
                } else {
                    $("#deleteModal").modal("hide");
                    toastr.error("Delete Failed.");
                    getServiceData();
                }
            } else {
                $("#deleteModal").modal("hide");
                toastr.error("Something Went Wrong");
            }
        })
        .catch(function(error) {
            $("#deleteModal").modal("hide");
            toastr.error("Something Went Wrong");
        });
}

//Each Service Update Details
function ServiceUpdateDetails(detailsId) {
    axios
        .post("admin/ServiceDetails", {
            id: detailsId,
        })
        .then(function(response) {
            if (response.status == 200) {
                $("#serviceEditForm").removeClass("d-none");
                $("#serviceEditLoader").addClass("d-none");

                var jsonData = response.data;
                $("#serviceNameID").val(jsonData[0].service_name);
                $("#serviceDesID").val(jsonData[0].service_des);
                $("#serviceImgID").val(jsonData[0].service_img);
            } else {
                $("#serviceEditLoader").addClass("d-none");
                $("#serviceEditWrong").removeClass("d-none");
            }
        })
        .catch(function(error) {
            $("#serviceEditLoader").addClass("d-none");
            $("#serviceEditWrong").removeClass("d-none");
        });
}

//Service Update Modal yes Btn
$("#serviceEditconfrimBtn").click(function() {
    var id = $("#SeditId").html();
    var name = $("#serviceNameID").val();
    var des = $("#serviceDesID").val();
    var img = $("#serviceImgID").val();
    ServiceUpdate(id, name, des, img);
});

// Service Update
function ServiceUpdate(serviceID, serviceName, serviceDes, serviceImg) {

    if (serviceName.length == 0) {
        toastr.error("Service Name is Empty !");
    } else if (serviceDes.length == 0) {
        toastr.error("Service Description is Empty !");
    } else if (serviceImg.length == 0) {
        toastr.error("Service Iamge is Empty !");
    } else {
        axios
            .post("admin/ServiceUpdate", {
                id: serviceID,
                name: serviceName,
                des: serviceDes,
                img: serviceImg
            })
            .then(function(response) {

                if (response.status = 200) {
                    if (response.data == 1) {
                        $("#editModal").modal("hide");
                        toastr.success("Update Successful.");
                        getServiceData();
                    } else {
                        $("#editModal").modal("hide");
                        toastr.error("Update Failed !");
                        getServiceData();
                    }
                } else {
                    $("#editModal").modal("hide");
                    toastr.error("Something Went Wrong");
                }

            })
            .catch(function(error) {
                $("#editModal").modal("hide");
                toastr.error("Something Went Wrong");
            });
    }

}
