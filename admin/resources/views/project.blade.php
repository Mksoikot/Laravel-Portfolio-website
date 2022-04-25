@extends('Layout.app')

@section('content')
    <div id="mainDivProject" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <button id="addNewBtnProjectId" style="float: right;font-size: 12px;" class="btn my-2 btn-sm btn-danger"> <i
                        class="fas fa-plus"></i> Add New</button>
                <table id="projectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Image</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Description</th>
                            <th class="th-sm">Link</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="project_table">



                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div id="loaderDivProject" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="m-5" src="{{ asset('images/Spinner-3.gif') }}">

            </div>
        </div>
    </div>

    <div id="wrongDivProject" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h3>Something Went Wrong !</h3>
            </div>
        </div>
    </div>

    <!--Delete Modal -->
    <div class="modal fade" id="deleteModalProject" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h6 class="modal-title p-3 m-3 text-center">Do You Want To Delete?</h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                    <button data-id=" " id="projectdeleteId" type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!--Edit  Modal -->
    <div class="modal fade" id="editModalProject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4 text-center">
                    <h6 id="PeditId" class="mt-2 "></h6>
                    <div id="projectEditForm" class="d-none w-100">
                        <input type="text" id="projectNameID" class="form-control mb-4" placeholder="Project Name" />
                        <input type="text" id="projectDesID" class="form-control mb-4" placeholder="Project Des" />
                        <input type="text" id="projectImgID" class="form-control mb-4" placeholder="Project Image Link" />
                        <input type="text" id="projectLinkID" class="form-control mb-4" placeholder="Project Link" />
                    </div>
                    <img id="projectEditLoader" class="m-5" src="{{ asset('images/Spinner-3.gif') }}">
                    <h6 id="projectEditWrong" class="d-none">Something Went Wrong !</h6>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="projectEditconfrimBtn" type="button" class="btn btn-sm btn-danger">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!--Add  Modal -->
    <div class="modal fade" id="addModalProject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                    <div id="projectAddForm" class="w-100">
                        <h6 class="mb-4">Add New Project</h6>
                        <input type="text" id="projectNameAddID" class="form-control mb-4" placeholder="Project Name" />
                        <input type="text" id="projectDesAddID" class="form-control mb-4" placeholder="Project Des" />
                        <input type="text" id="projectImgAddID" class="form-control mb-4"
                            placeholder="Project Image Link" />
                        <input type="text" id="projectIinkAddID" class="form-control mb-4" placeholder="Project Link" />
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
        getProjectData();

        // Project Table
        function getProjectData() {
            axios.get('admin/projectData')

                .then(function(response) {

                    if (response.status == 200) {

                        $('#mainDivProject').removeClass('d-none');
                        $('#loaderDivProject').addClass('d-none');

                        $("#projectDataTable").DataTable().destroy();
                        $('#project_table').empty();
                        var jsonData = response.data;

                        $.each(jsonData, function(i, item) {
                            $('<tr>').html(
                                "<td><img class='table-img' src=" +
                                jsonData[i].project_img + "></td>" +
                                "<td>" +
                                jsonData[i].project_name + "</td>" +
                                "<td>" +
                                jsonData[i].project_des + "</td>" +
                                "<td>" +
                                jsonData[i].project_link + "</td>" +
                                "<td><a class='projectEditbtn' data-id=" +
                                jsonData[i].id +
                                " ><i class='fas fa-edit'></i></a> </td>" +
                                "<td><a  class='projectDeletebtn' data-id=" +
                                jsonData[i].id +
                                "  ><i class='fas fa-trash-alt'></i></a> </td>"
                            ).appendTo('#project_table');
                        })
                        // project table delete icon click
                        $('.projectDeletebtn').click(function() {
                            var id = $(this).data('id');
                            $('#projectdeleteId').attr('data-id', id);
                            $('#deleteModalProject').modal('show');
                        });

                        //project Table Edit Icon Click
                        $(".projectEditbtn").click(function() {
                            var id = $(this).data('id');
                            $('#PeditId').html(id);
                            ProjectUpdateDetails(id);
                            $("#editModalProject").modal("show");
                        });

                        // DataTable show
                        $("#projectDataTable").DataTable({
                            'order': false
                        });
                        $(".dataTables_length").addClass("bs-select");
                    } else {
                        $('#loaderDivProject').addClass('d-none');
                        $('#wrongDivProject').removeClass('d-none');
                    }
                })

                .catch(function(error) {
                    $('#loaderDivProject').addClass('d-none');
                    $('#wrongDivProject').removeClass('d-none');
                });
        }
        // project delete modal yes Btn
        $('#projectdeleteId').click(function() {
            var id = $(this).data('id');
            ProjectDelete(id);
        });
        // Project Table data delete

        function ProjectDelete(deleteID) {
            $("#projectdeleteId").html(
                "<div class='spinner-border spinner-border-sm' role='status'></div>") //loading animatin
            axios.post('admin/projectDelete', {
                    id: deleteID
                })
                .then(function(response) {
                    $("#projectdeleteId").html('Yes');
                    if (response.status == 200) {
                        if (response.data == 1) {
                            $('#deleteModalProject').modal('hide');
                            toastr.success("Delete Successful.");
                            window.location.reload();
                        } else {
                            $('#deleteModalProject').modal('hide');
                            toastr.error("Delete Failed.");
                            getProjectData();
                        }
                    } else {
                        $('#deleteModalProject').modal('hide');
                        toastr.error("Something Went Wrong");
                    }
                })
                .catch(function(error) {
                    $('#deleteModalProject').modal('hide');
                    toastr.error("Something Went Wrong");
                });
        }

        //Each Project Update Details

        function ProjectUpdateDetails(detailsID) {
            axios.post('admin/projectDetails', {
                    id: detailsID
                })
                .then(function(response) {
                    if (response.status == 200) {

                        $('#projectEditForm').removeClass('d-none');
                        $('#projectEditLoader').addClass('d-none');

                        var jsonData = response.data;
                        $('#projectNameID').val(jsonData[0].project_name);
                        $('#projectDesID').val(jsonData[0].project_des);
                        $('#projectImgID').val(jsonData[0].project_img);
                        $('#projectLinkID').val(jsonData[0].project_link);

                    } else {
                        $('#projectEditLoader').addClass('d-none');
                        $('#projectEditWrong').removeClass('d-none');
                    }
                })
                .catch(function(error) {
                    $('#projectEditLoader').addClass('d-none');
                    $('#projectEditWrong').removeClass('d-none');
                });
        }

        //Project Update Modal yes Btn
        $("#projectEditconfrimBtn").click(function() {
            var projectID = $("#PeditId").html();
            var projectName = $("#projectNameID").val();
            var projectDes = $("#projectDesID").val();
            var projectImg = $("#projectImgID").val();
            var projectLink = $("#projectLinkID").val();
            ProjectUpdate(projectID, projectName, projectDes, projectImg, projectLink);
        });

        // Project Update
        function ProjectUpdate(projectID, projectName, projectDes, projectImg, projectLink) {

            if (projectName.length == 0) {
                toastr.error("Project Name is Empty !");
            } else if (projectDes.length == 0) {
                toastr.error("Project Description is Empty !");
            } else if (projectImg.length == 0) {
                toastr.error("Project Image is Empty !");
            } else if (projectLink.length == 0) {
                toastr.error("Project Link is Empty !");
            } else {
                $("#projectEditconfrimBtn").html(
                    "<div class='spinner-border spinner-border-sm' role='status'></div>") //loading animatin
                axios
                    .post("admin/projectUpdate", {
                        id: projectID,
                        name: projectName,
                        des: projectDes,
                        img: projectImg,
                        link: projectLink
                    })
                    .then(function(response) {
                        $("#projectEditconfrimBtn").html("Update");
                        if (response.status = 200) {
                            if (response.data == 1) {
                                $("#editModalProject").modal("hide");
                                toastr.success("Update Successful.");
                                getProjectData();
                            } else {
                                $("#editModalProject").modal("hide");
                                toastr.error("Update Failed !");
                                getProjectData();
                            }
                        } else {
                            $("#editModalProject").modal("hide");
                            toastr.error("Something Went Wrong");
                        }

                    })
                    .catch(function(error) {
                        $("#editModalProject").modal("hide");
                        toastr.error("Something Went Wrong");
                    });
            }

        }
        // Project add new btn
        $('#addNewBtnProjectId').click(function() {
            $('#addModalProject').modal('show');
        });
        //Project add Modal yes Btn
        $("#addNewBtnConfirmId").click(function() {
            var name = $("#projectNameAddID").val();
            var des = $("#projectDesAddID").val();
            var img = $("#projectImgAddID").val();
            var link = $("#projectIinkAddID").val();
            ProjectAdd(name, des, img, link);
        });
        // Project add method
        function ProjectAdd(projectName, projectDes, projectImg, projectLink) {

            if (projectName.length == 0) {
                toastr.error("Project Name is Empty !");
            } else if (projectDes.length == 0) {
                toastr.error("Project Description is Empty !");
            } else if (projectImg.length == 0) {
                toastr.error("Project Image is Empty !");
            } else if (projectLink.length == 0) {
                toastr.error("Project Link is Empty !");
            } else {
                $("#addNewBtnConfirmId").html(
                    "<div class='spinner-border spinner-border-sm' role='status'></div>") //loading animatin
                axios
                    .post("admin/projectAdd", {
                        name: projectName,
                        des: projectDes,
                        img: projectImg,
                        link: projectLink
                    })
                    .then(function(response) {
                        $("#addNewBtnConfirmId").html("Save");
                        if (response.status = 200) {
                            if (response.data == 1) {
                                $("#addModalProject").modal("hide");
                                toastr.success("Save Data Successful.");
                                getProjectData();
                            } else {
                                $("#addModalProject").modal("hide");
                                toastr.error("Add Data Failed !");
                                getProjectData();
                            }
                        } else {
                            $("#addModalProject").modal("hide");
                            toastr.error("Something Went Wrong");
                        }

                    })
                    .catch(function(error) {
                        $("#addModalProject").modal("hide");
                        toastr.error("Something Went Wrong");
                    });
            }

        }
    </script>
@endsection
