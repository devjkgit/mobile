<!DOCTYPE html>
<html lang="en">
@include('head')
<body class="skin-default fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Caremobile Portal</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('topnavigation')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('leftsidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Message Hub</h3>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Message Hub</li>
                            </ol>
                            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                            	<div align="right">
                                    <a href="/messagehub"><button class="btn btn-dark"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</button>
                                </div>
                                
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">All Messages</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                        <div class="p-20">

                                           
                                            <div class="row">
                                                <div class="col-12 table-responsive">
                                                    <table class="table table-bordered msgdata w-100 table-sm table-striped">
                                                        <thead class="bg-dark text-white">
                                                            <tr>
                                                                <th>CarerID</th>
                                                                <th>Title</th>
                                                                <th>Message</th>
                                                                <th>Replied Message</th>
                                                                <th>Created Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        	@foreach($mdata as $msgval)
                                                    		<tr>
                                                                <td>{{$msgval->name}}</td>
                                                                <td>{{$msgval->title}}</td>
                                                                <td>{{$msgval->message}}</td>
                                                                <td>@if($msgval->reply_message){{$msgval->reply_message}} @else - @endif</td>
                                                                <!-- <td>{{$msgval->created_at}}</td> -->
                                                                <td>{{ date('d/m/Y H:i:s', strtotime($msgval->created_at)) }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="Loader"></div>
                                            </div>

                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                
                

                <!-- <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered carersdata w-100">
                            <thead>
                                <tr>
                                    <th>CarerID</th>
                                    <th>Branch Name</th>
                                    <th>Name</th>
                                    <th>Contact No.</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="Loader"></div>
                </div> -->
            </div>
        </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        @include('footer')
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    @include('script')
</body>
<script type="text/javascript">
   

    var tbl = $('.msgdata').DataTable({
        "pageLength": 20,
        "responsive": true,
        "processing" : true,
        "destroy": true,
        "ordering": false,
        "autoWidth": false,
        "columnDefs": [
            {"className" : 'text-center', "targets" : '_all'},
            { "width": "10%", "targets": 0 },
            { "width": "20%", "targets": 1 },
            { "width": "25%", "targets": 2 },
            { "width": "25%", "targets": 3 },
            { "width": "20%", "targets": 4 },
        ],
        // "ajax": "{{ url('/messageview/{id}') }}",
        // "columns": [
        //     {data: 'CarerID', name: 'CarerID'},
        //     {data: 'title', name: 'title'},
        //     {data: 'title', name: 'title'},
        //     {data: 'title', name: 'title'},
        //     // {data: 'Title', name: 'Title'},
        //     // {
        //     //     "data": {Title:"Title",Forename:"Forename",Surname:"Surname"},
        //     //     "render": function (data, type, full, meta){
        //     //         return data.Title+" "+data.Forename+" "+data.Surname;
        //     //     }
        //     // },
        //     // {data: 'Telephone', name: 'Telephone'},
        // ],
    });
    
</script>
</html>