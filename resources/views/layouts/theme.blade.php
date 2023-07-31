<!doctype html>
<html lang="en">

<head>
    <title>CRM Church Manager | Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/linearicons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/chartist/css/chartist-custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/jquery-ui/jquery-ui.min.css') }}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="{{ asset('image/png" sizes="96x96" href="assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-multiselect.css') }}">



    <style>
        .brand {
            padding: 10px 5px 5px 10px !important;
            width: 25%;
        }

        p[data-f-id="pbf"] {
            visibility: hidden;
            display: none;
            height: 0px;
            background-color: none !important;
        }


        @media screen and (max-width: 600px) {
            .page-title {
            margin-top: -70px;
            margin-bottom:5px;
        }
        }

        .panel{
            overflow-x: scroll;

        }
    </style>
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">

            <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth"><i
                            class="lnr lnr-menu"></i></button>
                </div>
                <div class="brand">
                    <div class="col-sm-3">
                        <a href="/home"> <img src="/images/{{ $settings->logo }}" class="img-responsive logo"
                                style="height: auto !important; position: relative; padding: 0px;"></a>
                    </div>
                    <div class="col-lg-9">
                        <a href="/home"><b
                                style="color: {{ $settings->color }};">{{ $settings->ministry_name }}</b></a><br>
                        <small>{{ $settings->motto }}</small>
                    </div>
                </div>

                @if (Auth()->user()->role == 'Admin' || Auth()->user()->role == 'Super'  || Auth()->user()->role == 'Followup')
                    <form class="navbar-form navbar-left" action="{{ route('searchmembers') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" value="" name="keyword" class="form-control"
                                placeholder="Search Members...">
                            <span class="input-group-btn"><button type="submit"
                                    class="btn btn-primary">Go</button></span>
                        </div>
                    </form>

                    <div class="navbar-btn navbar-btn-right">
                        <a class="btn btn-success update-pro" href="/add-new" title="New Member" target="_blank"><span
                                class="fa fa-user-plus"></span> <span>New Member</span></a>
                    </div>
                @endif

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="lnr lnr-alarm"></i>
                                @if ($mytasks->count() > 0)
                                    <span class="badge bg-danger">{{ $mytasks->count() }}
                                        <!-- Some Laravel Counter -->
                                    </span>
                                @endif
                            </a>


                            <ul class="dropdown-menu notifications">
                                @foreach ($mytasks as $ts)
                                    <li><a href="/tasks" class="notification-item"><span
                                                class="dot bg-warning"></span>{{ $ts->title }} | <i
                                                class="lnr lnr-clock"></i>{{ $ts->date }}</a></li>
                                @endforeach
                                <li><a href="/tasks" class="more">See all notifications</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                                    class="lnr lnr-user"></i> <span>@auth {{ Auth::user()->name }} @endauth </span> <i
                                    class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="/member/{{ $login_user->id }}"><i class="lnr lnr-user"></i> <span>My
                                            Profile</span></a></li>
                                <li><a href="/tasks"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
                                @if (Auth()->user()->role == 'Admin' || Auth()->user()->role == 'Super')
                                    <li><a href="#" data-toggle="modal" data-target="#settings"><i
                                                class="lnr lnr-cog"></i> <span>Settings</span></a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#switchministry"><i
                                                class="lnr lnr-sync"></i> <span>Switch Ministry/Church</span></a></li>
                                    <li><a href="/audits"><i class="lnr lnr-list"></i> <span>Audit Trails</span></a>
                                    </li>
                                @endif
                                <li><a href="/help"><i class="lnr lnr-heart"></i> <span>Help</span></a></li>
                                <li><a href="/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>

                    </ul>

            </div>
        </nav>
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar" style="margin-top: 10px">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        <li><a href="/home" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
                        </li>

                        <li class="roledlink Worker Admin Followup Pastor Finance Super"
                            style="visibility:hidden !important;">
                            <a href="#subPages1" data-toggle="collapse" class="collapsed"><i
                                    class="lnr lnr-calendar-full"></i> <span>Tasks/ To Do</span> <i
                                    class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages1" class="collapse ">
                                <ul class="nav">
                                    <li><a href="/tasks" class="">Manage Tasks/TODOs</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="roledlink Worker Admin Followup Pastor Finance Super" style="visibility:hidden;">
                            <a href="#subPages2" data-toggle="collapse" class="collapsed"><i
                                    class="lnr lnr-users"></i> <span>Members</span> <i
                                    class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages2" class="collapse ">
                                <ul class="nav">
                                    <li><a href="/members" class="">View Members</a></li>
                                    <li><a href="/add-new" class="roledlink Worker,Admin,Followup,Pastor,Super">Add
                                            New</a></li>

                                </ul>
                            </div>
                        </li>
                        <li class="roledlink Admin Super Pastor" style="visibility:hidden;">
                            <a href="#subPages3" data-toggle="collapse" class="collapsed"><i
                                    class="lnr lnr-briefcase"></i> <span>Ministries</span> <i
                                    class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages3" class="collapse ">
                                <ul class="nav">
                                    <li><a href="/ministries" class="roledlink Admin Super Pastor">Manage
                                            Ministries</a></li>

                                </ul>
                            </div>
                        </li>
                        <li class="roledlink Admin Super Pastor" style="visibility:hidden;">
                            <a href="#subPages4" data-toggle="collapse" class="collapsed"><i
                                    class="lnr lnr-home"></i> <span>House Fellowships</span> <i
                                    class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages4" class="collapse ">
                                <ul class="nav">
                                    <li><a href="/house-fellowships" class="">Manage House Fellowships</a></li>


                                </ul>
                            </div>
                        </li>
                        <li class="roledlink Admin Super Pastor" style="visibility:hidden;">
                            <a href="#subPages5" data-toggle="collapse" class="collapsed"><i
                                    class="lnr lnr-flag"></i> <span>Programs/Activities</span> <i
                                    class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages5" class="collapse ">
                                <ul class="nav">
                                    <li><a href="/programmes" class="">Manage Programmes</a></li>

                                </ul>
                            </div>
                        </li>
                        <li class="roledlink Admin Super Pastor Usher" style="visibility:hidden;">
                            <a href="#subPages6" data-toggle="collapse" class="collapsed"><i
                                    class="lnr lnr-checkmark-circle"></i> <span>Attendance</span> <i
                                    class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages6" class="collapse ">
                                <ul class="nav">
                                    <li><a href="/attendance" class="">Manage Attendance</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="roledlink Admin Super Super" style="visibility:hidden;">
                            <a href="#subPages7" data-toggle="collapse" class="collapsed"><i
                                    class="lnr lnr-list"></i> <span>Finance</span> <i
                                    class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages7" class="collapse ">
                                <ul class="nav">
                                    <li><a href="/transactions" class="">Financial Records</a></li>
                                    <li><a href="/account-heads" class="">Manage Account Heads</a></li>

                                </ul>
                            </div>
                        </li>
                        <li class="roledlink Admin Super Pastor" style="visibility:hidden;">
                            <a href="#subPages8" data-toggle="collapse" class="collapsed"><i
                                    class="lnr lnr-envelope"></i> <span>Communication</span> <i
                                    class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages8" class="collapse ">
                                <ul class="nav">
                                    <li><a href="/communications" class="">Send Bulk SMS</a></li>
                                    <li><a href="/sentmessages" class="">Sent Messages</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <!-----------------------------START YIELD PAGE CONTENT -->
                    @if (Session::get('message'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <i class="fa fa-check-circle"></i> {!! Session::get('message') !!}
                        </div>
                    @endif
                    @yield('content')

                    <!----------------------------END YIELD PAGE CONTENT -->
                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">&copy; {{ date('Y') }} <a href="https://www.ministrymanager.org"
                        target="_blank">{{ $settings->name }}</a>. All Rights Reserved.</p>
            </div>
        </footer>
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

    <script src="{{ asset('/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('/assets/scripts/klorofil-common.js') }}"></script>
    <script src="{{ asset('/assets/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/assets/scripts/select2.js') }}"></script>

    <script src="{{ asset('/assets/scripts/bootstrap-multiselect.js') }}"></script>
    <script>
        $(function(){
            $('.multiselect').multiselect();
        });
    </script>



</body>

</html>

<!-- The Settings Modal -->
<div class="modal" id="settings">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Application Settings</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-check">
                    <input type="checkbox" name="create_new_ministry" id="create_new_ministry"
                        class="form-check-input">
                    <label class="form-check-label"><small style="color: {{ $settings->color }}"><i>Click Here to
                                Create New Ministry/Church</i></small></label>
                </div>

                <form method="POST" action="{{ route('settings') }}" id="settingsform"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $settings->id }}">

                    <input type="hidden" name="oldlogo" value="{{ $settings->logo }}">

                    <input type="hidden" name="oldbackground" value="{{ $settings->background }}">

                    <input type="hidden" name="newministry" id="newministry" value="">

                    <div class="form-group">
                        <label for="ministrygroup_id" class="control-label ">Ministry Group/Headquarter</label>
                        <select class="form-control" name="ministrygroup_id" id="ministrygroup_id">
                            <option value="{{ $settings->ministrygroup_id }}" selected>
                                {{ $ministrygroups->where('id', $settings->ministrygroup_id)->first()->ministry_group_name }}
                            </option>
                            @foreach ($ministrygroups as $mg)
                                <option value="{{ $mg->id }}">{{ $mg->ministry_group_name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ministry_name">Ministry / Church Name</label>
                        <input type="text" name="ministry_name" id="ministry_name" class="form-control"
                            value="{{ $settings->ministry_name }}">
                    </div>

                    <div class="form-group">
                        <label for="motto">Motto</label>
                        <input type="text" name="motto" id="motto" class="form-control"
                            value="{{ $settings->motto }}">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control"
                            value="{{ $settings->address }}">
                    </div>




                    <div class="form-group">
                        <label for="logo">Upload Logo Image</label>
                        <input type="file" name="logo" id="logo" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="background">Upload Background Image</label>
                        <input type="file" name="background" id="background" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="color">Choose System Colour</label>
                        <input type="color" name="color" id="color" class="form-control"
                            value="{{ $settings->color }}">
                    </div>

                    <div class="form-group">
                        <label for="user_id" class="control-label ">Admin User</label>
                        <select class="form-control" name="user_id" id="user_id">
                            <option value="{{ $settings->user_id }}" selected>{{ $settings->user->name }}</option>
                            @foreach ($hmembers as $hm)
                                <option value="{{ $hm->id }}">{{ $hm->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mode">Mode</label>
                        <select class="form-control" name="mode" id="mode">
                            <option value="{{ $settings->mode }}">{{ $settings->mode }}</option>
                            <option value="Active" selected>Active</option>
                            <option value="Maintenance">Maintenance</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save Settings') }}
                        </button>
                    </div>


                </form>


            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal" id="switchministry">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Switch Ministry/Church</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form method="POST" action="{{ route('switchministry') }}" enctype="multipart/form-data">
                    @csrf

                    @if (isset($userministries) && $userministries->count() > 0)
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <select class="form-control" name="settings_id" id="settings_id">

                                    <option value="{{ $login_user->settings_id }}" selected>
                                        {{ $login_user->settings->ministry_name }}</option>
                                    @foreach ($ministrygroups as $ministrygroup)
                                        @if (Auth()->user()->role == 'Super')
                                            @foreach ($ministrygroup->settings as $usrmin)
                                                <option value="{{ $usrmin->id }}">{{ $usrmin->ministry_name }}
                                                </option>
                                            @endforeach
                                        @else
                                            @foreach ($ministrygroup->settings->where('user_id', Auth()->user()->id) as $usrmin)
                                                <option value="{{ $usrmin->id }}">{{ $usrmin->ministry_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    @endforeach


                                </select>

                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Switch') }}
                                    </button>
                                </div>
                            </div>

                        </div>
                    @endif





                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

@if (isset($pagename) && $pagename == 'dashboard')
    <script src="{{ asset('/js/highcharts.js') }}"></script>


    <script>
        $(function() {

            var dates = [<?php echo $dates; ?>];
            var totals = [<?php echo $totals; ?>];
            var midweek = [<?php echo $midweek; ?>];
            var midweektotals = [<?php echo $midweektotals; ?>];


            console.log(dates);
            $('#attendance-chart').highcharts({
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Sunday Service Attendance Chart'
                },
                xAxis: {
                    categories: dates,
                    midweek
                },
                yAxis: {
                    title: {
                        text: 'Attendance'
                    }
                },
                series: [{
                        name: 'Sunday Services',
                        data: totals
                    },
                    {
                        name: 'Midweek Services',
                        data: midweektotals
                    }
                ]
            });
        });

        /*

        series: [{
        		name: 'Dates',
        		data: dates
        		},
        		{
        		name: 'Totals',
        		data: totals
        		}]
        	*/
    </script>
@endif
@if (isset($pagetype) && $pagetype == 'report')
    <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('/js/dataTables.fixedHeader.min.js') }}"></script>

    <script src="{{ asset('/js/dataTables.select.min.js') }}"></script>

    <script src="{{ asset('/js/dataTables.searchPanes.min.js') }}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js" />
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js" />
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js" />
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js" />
    </script>

    <script>
        // TABLES WITH FILTERS
        $('#products thead tr').clone(true).appendTo('#products thead');
        $('#products thead tr:eq(1) th:not(:last)').each(function(i) {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" value="" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });


        var table = $('#products').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            "order": [
                [0, "asc"]
            ],
            "paging": false,
            "pageLength": 50,
            "filter": true,
            "ordering": true,
            deferRender: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    </script>
@endif
@if (isset($pagename) && $pagename == 'programmes')
    <link href="{{ asset('node_modules/froala-editor/css/froala_editor.pkgd.min.css') }}" rel="stylesheet"
        type="text/css" />
    <script type="text/javascript" src="{{ asset('node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
    <script>
        var editor = new FroalaEditor('.richtext');
    </script>
    <style>
        .fr-wrapper div a {
            visibility: hidden;
            display: none;
            height: 0px;
            background-color: none !important;
        }
    </style>
@endif


<script>
    $('.select2').select2({
        theme: "classic"
    });

    var usrRole = "{{ $login_user->role }}";

    $(".roledlink").hide();

    function protect() {
        $("." + usrRole).css("visibility", "visible");
        $("." + usrRole).show();
    }
    protect();

    $(".datepicker").datepicker({
        yearRange: "-10:+   10",
        changeYear: true,
        dateFormat: 'yy-mm-dd',
    });

    $("#create_new_ministry").click(function() {
        var token = $("input[name=_token]").val();
        $('#settingsform')[0].reset();
        $(':input').val('');
        // $(':select').val('');
        $('#newministry').val('Yes');
        $("input[name=_token]").val(token);
    });

    $(function() {
        $(".fr-wrapper div a").hide();
    });

    $(".modaldismiss,.close").click(function() {
        // $('#programmesform')[0].reset();
        var token = $("input[name=_token]").val();
        $('#newministry').val('Yes');
        $(':input').val('');
        $("input[name=_token]").val(token);
        editor.html.set("");
    })
</script>
