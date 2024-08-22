<html lang="en">

@include('head')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <body class="skin-default fixed-layout">    

        <div class="preloader">

            <div class="loader">

                <div class="loader__figure"></div>

                <p class="loader__label">Pricing Table</p>

            </div>

        </div>

        <div id="main-wrapper">

            <header class="topbar">

                <nav class="navbar top-navbar navbar-expand-md navbar-dark">

                    <div class="navbar-header" style="text-align: center; width: 220px; padding-left: 0;">

                        <a class="navbar-brand" href="{{ url('/') }}">

                            <div style="font-size: 20px;">

                                <font style="font-weight: 900">Products</font><font> Pricing</font>

                            </div>

                        </a>

                    </div>

                    <div class="navbar-collapse">

                        @if(Auth::user()->is_admin == 1)

                        <ul class="navbar-nav mr-auto">

                            <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>

                        </ul>

                        @endif

                        <ul class="navbar-nav my-lg-0">

                            <li class="nav-item dropdown u-pro">

                                <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    @if(Auth::user()->profileimage != "")
                                        <img src="public/assets/images/profileimage/{{ Auth::user()->profileimage }}" class="img-circle" width="30" height="30">
                                    @else
                                        <img src="{{ url('public/assets/images/profileimage/user2.png')}}" alt="user" class="" width="30" height="30">
                                    @endif

                                    <span class="hidden-md-down"> {{ Auth::user()->username }} &nbsp;<i class="fa fa-angle-down"></i></span>

                                </a>

                                <div class="dropdown-menu dropdown-menu-right animated flipInY">

                                    <a href="/users/profile" class="dropdown-item"><i class="ti-user"></i> My Profile</a>

                                    <a href="logout" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>

                                </div>

                            </li>

                        </ul>

                    </div>

                </nav>

            </header>

            <div class="page-wrapper pt-10 ml-0">

                <div class="container-fluid">

                    <div class="row page-titles">

                        <div class="col-md-5 align-self-center">

                            <h3 class="text-themecolor">Products</h3>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12 table-responsive">

                            <table class="table table-bordered clientsdata w-100 table-sm table-striped">

                                <thead class="bg-dark text-white">

                                    <tr>
                                        <th>Product Type</th>

                                        <th>Code</th>

                                        <th>Company</th>

                                        <th>PT</th>

                                        <th>PD</th>

                                        <th>RH</th>

                                        <th>Weight (KG)</th>

                                        <th>Price</th>

                                        <th>Image</th>

                                    </tr>

                                </thead>

                            </table>

                        </div>

                        <div class="Loader"></div>

                    </div>

                </div> 

            </div>

        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button"
                                class="close"
                                data-dismiss="modal" 
                                aria-label="Close">
                            <span aria-hidden="true">
                              ×
                          </span>
                        </button>
                    </div>
  
                    <!--Modal body with image-->
                    <div class="modal-body">
                        <img id="previewimagesrc" style="width: 100%;" src="" />
                    </div>
                </div>
            </div>
        </div>

    @include('script')

    </body>

    <script type="text/javascript">
            $(document).on("click",".previewimage",function(){
                var image = $(this).attr("src");
                $("#previewimagesrc").attr("src",image);
                $("#exampleModal").modal("show");
            });

        $(document).ready(function(){


            var tbl = $('.clientsdata').DataTable({

                "responsive": true,

                "processing" : true,

                "destroy": true,

                "ordering": false,

                "autoWidth": false,

                "columnDefs": [

                    {"className" : 'text-center', "targets" : '_all'},

                    { "width": "10%", "targets": 0 },

                    { "width": "10%", "targets": 1 },

                    { "width": "10%", "targets": 2 },

                    { "width": "10%", "targets": 3 },

                    { "width": "10%", "targets": 4 },

                    { "width": "10%", "targets": 5 },

                    { "width": "10%", "targets": 6 },

                    { "width": "10%", "targets": 7 },

                    { "width": "10%", "targets": 8 },

                ],

                "ajax": "{{ url('/products/getallproducts') }}",

                "columns": [


                    {data: 'producttype', name: 'producttype'},

                    {data: 'code', name: 'code'},

                    {data: 'company', name: 'company'},

                    {data: 'PT', name: 'PT'},

                    {data: 'PD', name: 'PD'},

                    {data: 'RH', name: 'RH'},

                    {data: 'weight', name: 'weight'},

                    {

                        "data": "price",

                        "render": function (data, type, full, meta){

                            return "USD $"+data;

                        }

                    },

                    {

                        "data": "image",

                        "render": function (data, type, full, meta){

                            if(data == "" || data === null){

                                return "N/A";

                            }

                            else{

                                return '<img src="public/assets/images/productimage/'+data+'" class="previewimage" width="50" height="50">';

                            }

                        }

                    },

                ],

            });

        });

    </script>

</html>