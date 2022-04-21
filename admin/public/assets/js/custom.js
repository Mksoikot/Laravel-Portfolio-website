function getCoursesData() {
    axios({
            method: "get",
            url: "admin/CourseData",
            responseType: "json",
        })
        .then(function(response) {
            if (response.status == 200) {
                $("#MainDivCourse").removeClass("d-none");
                $("#loaderDivCourse").addClass("d-none");

                $("#courseDataTable").DataTable().destroy();
                $("#course_table").empty();

                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $("<tr>")
                        .html(
                            "<td>" + jsonData[i].course_name + " </td>" +
                            "<td>" + jsonData[i].course_fee + " </td>" +
                            "<td>" + jsonData[i].course_totalclass + " </td>" +
                            "<td>" + jsonData[i].course_totalenroll + " </td>" +
                            // "<td><a class='courseViewDetailsbtn' data-id=" +
                            // jsonData[i].id +
                            // " ><i class='fas fa-eye'></i></a> </td>" +
                            "<td><a class='courseEditbtn' data-id=" +
                            jsonData[i].id +
                            " ><i class='fas fa-edit'></i></a> </td>" +
                            "<td><a  class='courseDeletebtn' data-id=" +
                            jsonData[i].id +
                            "  ><i class='fas fa-trash-alt'></i></a> </td>"
                        )
                        .appendTo("#course_table");
                });

                $('.courseDeletebtn').click(function() {
                    var id = $(this).data("id");

                    $("#coursedeleteId").attr("data-id", id);
                    $('#deleteCourseModal').modal('show');
                })

                $('.courseEditbtn').click(function() {
                    var id = $(this).data("id");
                    CourseUpdateDetails(id);
                    $('#CourseEditId').html(id);
                    $('#updateCourseModal').modal('show');
                });

                // DataTable show
                $("#courseDataTable").DataTable();
                $(".dataTables_length").addClass("bs-select");

            } else {
                $("#loaderDivCourse").addClass("d-none");
                $("#wrongDivCourse").removeClass("d-none");
            }
        })
        .catch(function(error) {
            $("#loaderDivCourse").addClass("d-none");
            $("#wrongDivCourse").removeClass("d-none");
        });
}
$('#addNewCourseBtn').click(function() {
    $('#addCourseModal ').modal('show');
});
// courses add method
$('#CourseAddConfirmBtn').click(function() {
    var CourseName = $('#CourseNameId').val();
    var CourseDes = $('#CourseDesId').val();
    var CourseFee = $('#CourseFeeId').val();
    var CourseEnroll = $('#CourseEnrollId').val();
    var CourseClass = $('#CourseClassId').val();
    var CourseLink = $('#CourseLinkId').val();
    var CourseImg = $('#CourseImgId').val();
    CourseAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg);
});

function CourseAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg) {

    if (CourseName.length == 0) {
        toastr.error("Course Name is Empty !");
    } else if (CourseDes.length == 0) {
        toastr.error("Course Description is Empty !");
    } else if (CourseFee.length == 0) {
        toastr.error("Course Fee is Empty !");
    } else if (CourseEnroll.length == 0) {
        toastr.error("CourseEnroll is Empty !");
    } else if (CourseClass.length == 0) {
        toastr.error("CourseClass is Empty !");
    } else if (CourseLink.length == 0) {
        toastr.error("CourseLink is Empty !");
    } else if (CourseImg.length == 0) {
        toastr.error("CourseImg is Empty !");
    } else {
        $("#CourseAddConfirmBtn").html("<div class='spinner-border spinner-border-sm' role='status'></div>") //loading animatin
        axios
            .post("admin/CourseAdd", {
                course_name: CourseName,
                course_des: CourseDes,
                course_fee: CourseFee,
                course_totalenroll: CourseEnroll,
                course_totalclass: CourseClass,
                course_link: CourseLink,
                course_img: CourseImg
            })
            .then(function(response) {
                $("#CourseAddConfirmBtn").html("Save");
                if (response.status = 200) {
                    if (response.data == 1) {
                        $("#addCourseModal").modal("hide");
                        toastr.success("Save Data Successful.");
                        getCoursesData();
                    } else {
                        $("#addCourseModal").modal("hide");
                        toastr.error("Add Data Failed !");
                        getCoursesData();
                    }
                } else {
                    $("#addCourseModal").modal("hide");
                    toastr.error("Something Went Wrong");
                }

            })
            .catch(function(error) {
                $("#addCourseModal").modal("hide");
                toastr.error("Something Went Wrong");
            });
    }

}

//course Delete Modal yes Btn
$('#coursedeleteId').click(function() {
    var id = $(this).data("id");
    CourseDelete(id);
});

//Courses Delete
function CourseDelete(deleteId) {
    $("#coursedeleteId").html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios
        .post("admin/CourseDelete", {
            id: deleteId,
        })
        .then(function(response) {
            $("#coursedeleteId").html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    $("#deleteCourseModal").modal("hide");
                    toastr.success("Delete Successful.");
                    window.location.reload();
                } else {
                    $("#deleteCourseModal").modal("hide");
                    toastr.error("Delete Failed.");
                    getCoursesData();
                }
            } else {
                $("#deleteCourseModal").modal("hide");
                toastr.error("Something Went Wrong");

            }
        })
        .catch(function(error) {
            $("#deleteCourseModal").modal("hide");
            toastr.error("Something Went Wrong");
        });
}

//Each Course Update Details
function CourseUpdateDetails(detailsId) {
    axios
        .post("admin/CourseDetails", {
            id: detailsId,
        })
        .then(function(response) {
            if (response.status == 200) {
                $("#courseEditForm").removeClass("d-none");
                $("#courseEditLoader").addClass("d-none");

                var jsonData = response.data;
                $("#CourseNameUpdateId").val(jsonData[0].course_name);
                $("#CourseDesUpdateId").val(jsonData[0].course_des);
                $("#CourseFeeUpdateId").val(jsonData[0].course_fee);
                $("#CourseEnrollUpdateId").val(jsonData[0].course_totalenroll);
                $("#CourseClassUpdateId").val(jsonData[0].course_totalclass);
                $("#CourseLinkUpdateId").val(jsonData[0].course_link);
                $("#CourseImgUpdateId").val(jsonData[0].course_img);
            } else {
                $("#courseEditLoader").addClass("d-none");
                $("#courseEditWrong").removeClass("d-none");
            }
        })
        .catch(function(error) {
            $("#courseEditLoader").addClass("d-none");
            $("#courseEditWrong").removeClass("d-none");
        });
}

$("#CourseUpdateConfirmBtn").click(function() {
    var courseID = $('#CourseEditId').html();
    var courseName = $('#CourseNameUpdateId').val();
    var courseDes = $('#CourseDesUpdateId').val();
    var courseFee = $('#CourseFeeUpdateId').val();
    var courseTotalenroll = $('#CourseEnrollUpdateId').val();
    var courseTotalclass = $('#CourseClassUpdateId').val();
    var courseLink = $('#CourseLinkUpdateId').val();
    var courseImg = $('#CourseImgUpdateId').val();

    CourseUpdate(courseID, courseName, courseDes, courseFee, courseTotalenroll, courseTotalclass, courseLink, courseImg)
})

// Service Update
function CourseUpdate(courseID, courseName, courseDes, courseFee, courseTotalenroll, courseTotalclass, courseLink, courseImg) {

    if (courseName.length == 0) {
        toastr.error("Course Name is Empty !");
    } else if (courseDes.length == 0) {
        toastr.error("Course Description is Empty !");
    } else if (courseFee.length == 0) {
        toastr.error("Course Fee is Empty !");
    } else if (courseTotalenroll.length == 0) {
        toastr.error("Course Totalenroll is Empty !");
    } else if (courseTotalclass.length == 0) {
        toastr.error("Course Totalclass is Empty !");
    } else if (courseLink.length == 0) {
        toastr.error("Course Link is Empty !");
    } else if (courseImg.length == 0) {
        toastr.error("Course Image is Empty !");
    } else {
        $("#CourseUpdateConfirmBtn").html("<div class='spinner-border spinner-border-sm' role='status'></div>") //loading animatin
        axios
            .post("admin/CourseUpdate", {
                id: courseID,
                course_name: courseName,
                course_des: courseDes,
                course_fee: courseFee,
                course_totalenroll: courseTotalenroll,
                course_totalclass: courseTotalclass,
                course_link: courseLink,
                course_img: courseImg
            })
            .then(function(response) {
                $("#CourseUpdateConfirmBtn").html("Update");
                if (response.status = 200) {
                    if (response.data == 1) {
                        $("#updateCourseModal").modal("hide");
                        toastr.success("Update Successful.");
                        getCoursesData();
                    } else {
                        $("#updateCourseModal").modal("hide");
                        toastr.error("Update Failed !");
                        getCoursesData();
                    }
                } else {
                    $("#updateCourseModal").modal("hide");
                    toastr.error("Something Went Wrong");
                }

            })
            .catch(function(error) {
                $("#updateCourseModal").modal("hide");
                toastr.error("Something Went Wrong");
            });
    }

}
