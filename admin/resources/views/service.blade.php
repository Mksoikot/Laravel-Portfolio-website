@extends('Layout.app')

@section('content')

<div id="mainDiv" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">
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
                <h6 id="SeditId" class="mt-4"> </h6>
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


@endsection



@section('script')
    <script type="text/javascript">
       getServiceData();
    </script>

@endsection
