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
            <p class="loader__label">Mobile-Data</p>
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
                        <h3 class="text-themecolor">Settings</h3>
                        <!-- <button type="button" data-toggle="modal" data-target="#addusermodal" class="btn waves-effect waves-light btn-secondary ">+ Add User</button> -->
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">Settings</li>
                            </ol>
                            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-themecolor">Update Settings</h3>
                        <form class="form-horizontal" autocomplete="off" id="updatesettingform" method="post" >
                            @csrf
                            <input type="hidden" name="settingid" value="{{ $settingsdata->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <label>Reduce Percentage (%)</label>
                                        <input type="text" name="settingvalue" id="settingvalue" value="{{ $settingsdata->value }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <label>Reduce Percentage Actual Price (%)</label>
                                        <input type="text" name="settingactualvalue" id="settingactualvalue" value="{{ $settingsdata->actual_value }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label>PT</label>
                                        <input type="text" name="settingpt" id="settingpt" value="{{ $settingsdata->pt_price }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label>PD</label>
                                        <input type="text" name="settingpd" id="settingpd" value="{{ $settingsdata->pd_price }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label>RH</label>
                                        <input type="text" name="settingrh" id="settingrh" value="{{ $settingsdata->rh_price }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="Loader"></div>
                </div>
            </div>
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

        $("#updatesettingform").validate({
            rules: {
                "settingvalue": {required: true,number:true},
                "settingactualvalue": {required: true,number:true},
                "settingpt": {required: true,number:true},
                "settingpd": {required: true,number:true},
                "settingrh": {required: true,number:true},
            },
            messages: {
                "settingvalue": {required: "Please enter the percentage",number:"Please enter only number."},
                "settingactualvalue": {required: "Please enter the percentage",number:"Please enter only number."},
                "settingpt": {required: "Please enter the metal price of PT",number:"Please enter only number."},
                "settingpd": {required: "Please enter the metal price of PD",number:"Please enter only number."},
                "settingrh": {required: "Please enter the metal price of RH",number:"Please enter only number."},
            },
            submitHandler: function(){
                $(".Loader").show();
                var form = $('#updatesettingform')[0];
                var data = new FormData(form);
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    dataType:"json",
                    contentType: false,
                    processData: false,
                    type:"post",
                    data:data,
                    url:"{{ url('/settings/updatesetting')}}",
                    success: function(data)
                    {
                        if(data.success == "0"){
                            $.notify({
                                message: data.error 
                            },
                            {
                                type: 'danger',
                                placement: {
                                    from: "bottom",
                                    align: "left"
                                },
                                z_index: 9999999,
                                mouse_over: "pause",
                            });
                            $(".Loader").hide();
                        }
                        else if(data.success == "1")
                        {
                            $(".Loader").hide();
                            $.notify({
                                message: data.response 
                            },
                            {
                                type: 'success',
                                placement: {
                                    from: "bottom",
                                    align: "left"
                                },
                                z_index: 9999999,
                                mouse_over: "pause",
                            });
                            location.reload();
                        }
                    }
                });
            }
        });
</script>
</html>