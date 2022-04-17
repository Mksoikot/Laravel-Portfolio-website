@extends('Layout.app')

@section('content')

<div id="mainDiv" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">
        <button id="addNewBtnId" style="float: right;font-size: 12px;" class="btn my-2 btn-sm btn-danger"> <i class="fas fa-plus"></i> Add New</button>
    <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Image</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Description</th>
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="service_table">



      </tbody>
    </table>

    </div>
    </div>
    </div>

    <div id="loaderDiv" class="container">
    <div class="row">
    <div class="col-md-12 text-center p-5">
            <img class="m-5" src="{{asset('images/Spinner-3.gif')}}">

    </div>
    </div>
    </div>

    <div id="wrongDiv" class="container d-none">
        <div class="row">
        <div class="col-md-12 text-center p-5">
                <h3>Something Went Wrong !</h3>
        </div>
        </div>
        </div>




                <!--Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <h6 class="modal-title p-3 m-3 text-center">Do You Want To Delete?</h6>
                <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                <button data-id="" id="servicedeleteId" type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
            </div>
        </div>
        <!--Edit  Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-body p-4 text-center">
                <h6 id="SeditId" class="mt-4"></h6>
                <div id="serviceEditForm" class="d-none w-100">
                <input type="text" id="serviceNameID" class="form-control mb-4" placeholder="Service Name"/>
                <input type="text" id="serviceDesID" class="form-control mb-4" placeholder="Service Des"/>
                <input type="text" id="serviceImgID" class="form-control mb-4" placeholder="Service Image Link"/>
                </div>
                <img id="serviceEditLoader" class="m-5" src="{{asset('images/Spinner-3.gif')}}">
                <h6 id="serviceEditWrong" class="d-none">Something Went Wrong !</h6>

               </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                <button id="serviceEditconfrimBtn" type="button" class="btn btn-sm btn-danger">Update</button>
                </div>
            </div>
            </div>
        </div>

                <!--Add  Modal -->
                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                       <div class="modal-body p-4 text-center">
                        <div id="serviceAddForm" class="w-100">
                            <h6 class="mb-4">Add New Service</h6>
                        <input type="text" id="serviceNameAddID" class="form-control mb-4" placeholder="Service Name"/>
                        <input type="text" id="serviceDesAddID" class="form-control mb-4" placeholder="Service Des"/>
                        <input type="text" id="serviceImgAddID" class="form-control mb-4" placeholder="Service Image Link"/>
                        </div>

                       </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                        <button id="addNewBtnConfirmId" type="button" class="btn btn-sm btn-danger">Save</button>
                        </div>
                    </div>
                    </div>
                </div>


@endsection



@section('script')
    <script type="text/javascript">
       getServiceData();
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
    $("#servicedeleteId").html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios
        .post("admin/ServiceDelete", {
            id: deleteId,
        })
        .then(function(response) {
            $("#servicedeleteId").html("Yes");
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
        toastr.error("Service Image is Empty !");
    } else {
        $("#serviceEditconfrimBtn").html("<div class='spinner-border spinner-border-sm' role='status'></div>") //loading animatin
        axios
            .post("admin/ServiceUpdate", {
                id: serviceID,
                name: serviceName,
                des: serviceDes,
                img: serviceImg
            })
            .then(function(response) {
                $("#serviceEditconfrimBtn").html("Update");
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
// service add new btn
$('#addNewBtnId').click(function() {
    $('#addModal').modal('show');
});
//Service Update Modal yes Btn
$("#addNewBtnConfirmId").click(function() {
        var name = $("#serviceNameAddID").val();
        var des = $("#serviceDesAddID").val();
        var img = $("#serviceImgAddID").val();
        ServiceAdd(name, des, img);
    })
    // service add method
function ServiceAdd(serviceName, serviceDes, serviceImg) {

    if (serviceName.length == 0) {
        toastr.error("Service Name is Empty !");
    } else if (serviceDes.length == 0) {
        toastr.error("Service Description is Empty !");
    } else if (serviceImg.length == 0) {
        toastr.error("Service Image is Empty !");
    } else {
        $("#addNewBtnConfirmId").html("<div class='spinner-border spinner-border-sm' role='status'></div>") //loading animatin
        axios
            .post("admin/ServiceAdd", {
                name: serviceName,
                des: serviceDes,
                img: serviceImg
            })
            .then(function(response) {
                $("#addNewBtnConfirmId").html("Save");
                if (response.status = 200) {
                    if (response.data == 1) {
                        $("#addModal").modal("hide");
                        toastr.success("Save Data Successful.");
                        getServiceData();
                    } else {
                        $("#editModal").modal("hide");
                        toastr.error("Add Data Failed !");
                        getServiceData();
                    }
                } else {
                    $("#addModal").modal("hide");
                    toastr.error("Something Went Wrong");
                }

            })
            .catch(function(error) {
                $("#addModal").modal("hide");
                toastr.error("Something Went Wrong");
            });
    }

}
    </script>

@endsection
