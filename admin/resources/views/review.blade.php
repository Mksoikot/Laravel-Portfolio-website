@extends('Layout.app')
@section('title','Review')
@section('content')
    <div id="mainDivReview" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <button id="addNewReviewBtnId" style="float: right;font-size: 12px;" class="btn my-2 btn-sm btn-danger"> <i
                        class="fas fa-plus"></i> Add New</button>
                <table id="reviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Image</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Description</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="review_table">



                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div id="loaderDivReview" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="m-5" src="{{ asset('images/Spinner-3.gif') }}">

            </div>
        </div>
    </div>

    <div id="wrongDivReview" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h3>Something Went Wrong !</h3>
            </div>
        </div>
    </div>




    <!--Delete Modal -->
    <div class="modal fade" id="deleteModalReview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h6 class="modal-title p-3 m-3 text-center">Do You Want To Delete?</h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                    <button data-id="" id="reviewdeleteId" type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!--Edit  Modal -->
    <div class="modal fade" id="editModalReview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4 text-center">
                    <h6 id="ReditId" class="mt-4 d-none"></h6>
                    <div id="reviewEditForm" class="d-none w-100">
                        <input type="text" id="reviewNameID" class="form-control mb-4" placeholder="Review Name" />
                        <input type="text" id="reviewDesID" class="form-control mb-4" placeholder="Review Des" />
                        <input type="text" id="reviewImgID" class="form-control mb-4" placeholder="Review Image Link" />
                    </div>
                    <img id="reviewEditLoader" class="m-5" src="{{ asset('images/Spinner-3.gif') }}">
                    <h6 id="reviewEditWrong" class="d-none">Something Went Wrong !</h6>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="reviewEditconfrimBtn" type="button" class="btn btn-sm btn-danger">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!--Add  Modal -->
    <div class="modal fade" id="addModalReview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                    <div id="reviewAddForm" class="w-100">
                        <h6 class="mb-4">Add New Service</h6>
                        <input type="text" id="reviewNameAddID" class="form-control mb-4" placeholder="Review Name" />
                        <input type="text" id="reviewDesAddID" class="form-control mb-4" placeholder="Review Des" />
                        <input type="text" id="reviewImgAddID" class="form-control mb-4"
                            placeholder="Review Image Link" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="addNewReviewBtnConfirmId" type="button" class="btn btn-sm btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')
    <script type="text/javascript">
        getReviewData();
        // To Review Page Table

        function getReviewData() {
            axios({
                    method: "get",
                    url: "admin/getreviewData",
                    responseType: "json",
                })
                .then(function(response) {
                    if (response.status == 200) {
                        $("#mainDivReview").removeClass("d-none");
                        $("#loaderDivReview").addClass("d-none");

                        $("#reviewDataTable").DataTable().destroy();
                        $("#review_table").empty();

                        var jsonData = response.data;

                        $.each(jsonData, function(i, item) {
                            $("<tr>")
                                .html(
                                    "<td><img class='table-img' src=" +
                                    jsonData[i].img +
                                    "></td>" +
                                    "<td>" +
                                    jsonData[i].name +
                                    "</td>" +
                                    "<td>" +
                                    jsonData[i].des +
                                    "</td>" +
                                    "<td><a class='reviewEditbtn' data-id=" +
                                    jsonData[i].id +
                                    " ><i class='fas fa-edit'></i></a> </td>" +
                                    "<td><a  class='reviewDeletebtn' data-id=" +
                                    jsonData[i].id +
                                    "  ><i class='fas fa-trash-alt'></i></a> </td>"
                                )
                                .appendTo("#review_table");
                        });

                        //review Table Delete Icon Click
                        $(".reviewDeletebtn").click(function() {
                            var id = $(this).data("id");

                            $("#reviewdeleteId").attr("data-id", id);
                            $("#deleteModalReview").modal("show");
                        });


                        //review Table Edit Icon Click
                        $(".reviewEditbtn").click(function() {
                            var id = $(this).data("id");
                            $("#ReditId").html(id);
                            ReviewUpdateDetails(id);
                            $("#editModalReview").modal("show");
                        });


                        // DataTable show
                        $("#reviewDataTable").DataTable({
                            'order': false
                        });
                        $(".dataTables_length").addClass("bs-select");

                    } else {
                        $("#loaderDivReview").addClass("d-none");
                        $("#wrongDivReview").removeClass("d-none");
                    }
                })
                .catch(function(error) {
                    $("#loaderDivReview").addClass("d-none");
                    $("#wrongDivReview").removeClass("d-none");
                });
        }

        //review Delete Modal yes Btn
        $("#reviewdeleteId").click(function() {
            var id = $(this).data("id");
            ReviewDelete(id);
        });

        //review Delete
        function ReviewDelete(deleteId) {
            $("#reviewdeleteId").html("<div class='spinner-border spinner-border-sm' role='status'></div>")
            axios
                .post("admin/ReviewDelete", {
                    id: deleteId,
                })
                .then(function(response) {
                    $("#reviewdeleteId").html("Yes");
                    if (response.status == 200) {
                        if (response.data == 1) {
                            $("#deleteModalReview").modal("hide");
                            toastr.success("Delete Successful.");
                            window.location.reload();
                        } else {
                            $("#deleteModalReview").modal("hide");
                            toastr.error("Delete Failed.");
                            getServiceData();
                        }
                    } else {
                        $("#deleteModalReview").modal("hide");
                        toastr.error("Something Went Wrong");
                    }
                })
                .catch(function(error) {
                    $("#deleteModalReview").modal("hide");
                    toastr.error("Something Went Wrong");
                });
        }

        //Each review Update Details
        function ReviewUpdateDetails(detailsId) {
            axios
                .post("admin/ReviewDetails", {
                    id: detailsId,
                })
                .then(function(response) {
                    if (response.status == 200) {
                        $("#reviewEditForm").removeClass("d-none");
                        $("#reviewEditLoader").addClass("d-none");

                        var jsonData = response.data;
                        $("#reviewNameID").val(jsonData[0].name);
                        $("#reviewDesID").val(jsonData[0].des);
                        $("#reviewImgID").val(jsonData[0].img);
                    } else {
                        $("#reviewEditLoader").addClass("d-none");
                        $("#reviewEditWrong").removeClass("d-none");
                    }
                })
                .catch(function(error) {
                    $("#reviewEditLoader").addClass("d-none");
                    $("#reviewEditWrong").removeClass("d-none");
                });
        }

        //review review Modal yes Btn
        $("#reviewEditconfrimBtn").click(function() {
            var id = $("#ReditId").html();
            var name = $("#reviewNameID").val();
            var des = $("#reviewDesID").val();
            var img = $("#reviewImgID").val();
            ReviewUpdate(id, name, des, img);
        });

        // review Update
        function ReviewUpdate(reviewID, reviewName, reviewDes, reviewImg) {

            if (reviewName.length == 0) {
                toastr.error("Review Name is Empty !");
            } else if (reviewDes.length == 0) {
                toastr.error("Review Description is Empty !");
            } else if (reviewImg.length == 0) {
                toastr.error("Review Image is Empty !");
            } else {
                $("#reviewEditconfrimBtn").html(
                    "<div class='spinner-border spinner-border-sm' role='status'></div>") //loading animatin
                axios
                    .post("admin/ReviewUpdate", {
                        id: reviewID,
                        name: reviewName,
                        des: reviewDes,
                        img: reviewImg
                    })
                    .then(function(response) {
                        $("#reviewEditconfrimBtn").html("Update");
                        if (response.status = 200) {
                            if (response.data == 1) {
                                $("#editModalReview").modal("hide");
                                toastr.success("Update Successful.");
                                getReviewData();
                            } else {
                                $("#editModalReview").modal("hide");
                                toastr.error("Update Failed !");
                                getReviewData();
                            }
                        } else {
                            $("#editModalReview").modal("hide");
                            toastr.error("Something Went Wrong");
                        }

                    })
                    .catch(function(error) {
                        $("#editModalReview").modal("hide");
                        toastr.error("Something Went Wrong");
                    });
            }

        }
        // review add new btn
        $('#addNewReviewBtnId').click(function() {
            $('#addModalReview').modal('show');
        });
        //Service Update Modal yes Btn
        $("#addNewReviewBtnConfirmId").click(function() {
            var name = $("#reviewNameAddID").val();
            var des = $("#reviewDesAddID").val();
            var img = $("#reviewImgAddID").val();
            ReviewAdd(name, des, img);
        });
        // review add method
        function ReviewAdd(reviewName, reviewDes, reviewImg) {

            if (reviewName.length == 0) {
                toastr.error("Review Name is Empty !");
            } else if (reviewDes.length == 0) {
                toastr.error("Review Description is Empty !");
            } else if (reviewImg.length == 0) {
                toastr.error("Review Image is Empty !");
            } else {
                $("#addNewReviewBtnConfirmId").html(
                    "<div class='spinner-border spinner-border-sm' role='status'></div>") //loading animatin
                axios
                    .post("admin/ReviewAdd", {
                        name: reviewName,
                        des: reviewDes,
                        img: reviewImg
                    })
                    .then(function(response) {
                        $("#addNewReviewBtnConfirmId").html("Save");
                        if (response.status = 200) {
                            if (response.data == 1) {
                                $("#addModalReview").modal("hide");
                                toastr.success("Save Data Successful.");
                                getReviewData();
                            } else {
                                $("#editModalReview").modal("hide");
                                toastr.error("Add Data Failed !");
                                getReviewData();
                            }
                        } else {
                            $("#addModalReview").modal("hide");
                            toastr.error("Something Went Wrong");
                        }

                    })
                    .catch(function(error) {
                        $("#addModalReview").modal("hide");
                        toastr.error("Something Went Wrong");
                    });
            }

        }
    </script>
@endsection
