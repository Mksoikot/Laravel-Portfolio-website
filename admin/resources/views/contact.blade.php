@extends('Layout.app')

@section('content')
    <div id="MainDivContact" class="container">
        <div class="row">
            <div class="col-md-12 p-5">
                <table id="contactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Mobile</th>
                            <th class="th-sm">Email</th>
                            <th class="th-sm">Message</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="contact_table">


                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div id="loaderDivcontact" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="m-5" src="{{ asset('images/Spinner-3.gif') }}">

            </div>
        </div>
    </div>

    <div id="wrongDivContact" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h3>Something Went Wrong !</h3>
            </div>
        </div>
    </div>
    <!--Delete Modal -->
    <div class="modal fade" id="deleteContactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h6 class="modal-title p-3 m-3 text-center">Do You Want To Delete?</h6>
                {{-- <h6 id="courseDeleteId" class="mt-4"></h6> --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                    <button data-id="" id="contactdeleteId" type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script type="text/javascript">
    getContactData();
        // Contact Table
    </script>
@endsection
