@extends('Layout.app')

@section('content')
    <div id="MainDivCourse" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <button id="addNewCourseBtn" style="float: right;font-size: 12px;" class="btn my-2 btn-sm btn-danger"> <i
                        class="fas fa-plus"></i> Add New</button>
                <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Fee</th>
                            <th class="th-sm">Class</th>
                            <th class="th-sm">Enroll</th>
                            <th class="th-sm">Details</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="course_table">


                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div id="loaderDivCourse" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="m-5" src="{{ asset('images/Spinner-3.gif') }}">

            </div>
        </div>
    </div>

    <div id="wrongDivCourse" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h3>Something Went Wrong !</h3>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="CourseNameId" type="text" id="" class="form-control mb-3"
                                    placeholder="Course Name">
                                <input id="CourseDesId" type="text" id="" class="form-control mb-3"
                                    placeholder="Course Description">
                                <input id="CourseFeeId" type="text" id="" class="form-control mb-3"
                                    placeholder="Course Fee">
                                <input id="CourseEnrollId" type="text" id="" class="form-control mb-3"
                                    placeholder="Total Enroll">
                            </div>
                            <div class="col-md-6">
                                <input id="CourseClassId" type="text" id="" class="form-control mb-3"
                                    placeholder="Total Class">
                                <input id="CourseLinkId" type="text" id="" class="form-control mb-3"
                                    placeholder="Course Link">
                                <input id="CourseImgId" type="text" id="" class="form-control mb-3"
                                    placeholder="Course Image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!--Delete Modal -->
    <div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h6 class="modal-title p-3 m-3 text-center">Do You Want To Delete?</h6>
                {{-- <h6 id="courseDeleteId" class="mt-4"></h6> --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                    <button data-id="" id="coursedeleteId" type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        getCoursesData();
    </script>
@endsection
