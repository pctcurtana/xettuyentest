<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    @include('user_24.admin24.include.header')
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/5.0.1/css/fixedColumns.dataTables.css"> -->
    <style>
        .card-footer {
            background-color: #fff;
        }

        th,
        td {
            white-space: nowrap;

        }

        .text-center {
            text-align: center;

        }

        .border-right {
            border-right: 1px solid rgba(0, 0, 0, 0.15)
        }


        table.dataTable>tbody>tr>th,
        table.dataTable>tbody>tr>td {
            padding: 0px 4px;
        }

        table.dataTable>thead>tr>th,
        table.dataTable>thead>tr>td {
            padding: 0px 4px;
        }

        table.dataTable>thead>tr>th:not(.sorting_disabled),
        table.dataTable>thead>tr>td:not(.sorting_disabled) {
            padding: 0px 4px;
        }

        div.dataTables_wrapper {
            /* width: 400px; */
            margin: 0 auto;
        }


        /* .equal-height {
            display: flex;
        }

        .equal-height .card {
            flex: 1;
        }
 */

        .test {

            border: 1px solid red;
            width: 300px;
            height: 10px
        }
    </style>
</head>

<body class="sidebar-mini sidebar-collapse">

    <div class="wrapper">
        <!-- Preloader -->

        <!-- Navbar -->
        @include('user_24.admin24.include.navbar')
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('user_24.admin24.include.sidebar')
        <!-- /.sidebar -->
        {{-- @yield('sidebar1') --}}
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 1302.12px;">
            @include('user_24.admin24.include.contentheader')
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col col-lg-3 col-md-3 col-sm-12" >
                            <div class="row">
                                <div class="col-12">
                                    <div class="card block-left">
                                        <div class="card-header ">
                                            <legend>Tìm kiếm</legend>
                                        </div>
                                        <div class="card-body">                                          
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <label for="selection" class="col-12" style="margin-top:5px;">Loại giấy:</label>
                                                    <select id = "slb_loaigiay" class="col-12"></select>                                                          
                                                </div>
                                                <div class="form-group row">
                                                    <label for="" class="col-12" style="margin-top:5px;">Ngày đăng kí:</label>
                                                    <input id="ngaydangky" class="col-12" style="height: 28px;" type="date"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="" class="col-12" style="margin-top:5px;">Duyệt/Chưa duyệt:</label>                                                    
                                                        <select id="trangthaiduyet" class="col-12">                                                          
                                                            <option value="2">Trạng thái</option>
                                                            <option value="1">Duyệt</option>
                                                            <option value="0">Chưa duyệt</option>
                                                        </select>                                                
                                                </div>
                                                <div class="form-group row ">
                                                    <label for="" class="col-12"style="margin-top:5px;">Khoá:</label>                                                   
                                                    <select id="slb_khoas" class="col-12"></select>                                                   
                                                </div>
                                                <div class="form-group row">
                                                    <label for="" class="col-12" style="margin-top:5px;">Lớp:</label>                                                   
                                                    <select id="slb_lop" class="col-12"></select>                                                    
                                                </div>
                                                <div class="form-group row">
                                                    <label for="" class="col-12"style="margin-top:5px;">MSSV:</label>
                                                    <input id="mssv" class="col-12" style="height: 28px;" type="text"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="" class="col-12" style="margin-top:5px;">Họ và Tên:</label>
                                                    <input id="hoten" class="col-12" style="height: 28px;" type="text"></input>
                                                </div>           
                                                    <div class="col-8"></div>
                                                    <div class="row">
                                                        <div class="col-2"></div>
                                                        <div class="col-5 " style="margin-top: 5px;">
                                                            <button id="refresh" onclick="refresh()" class="btn btn-block btn-primary btn-xs"><i class="fa-solid fa-arrows-rotate"></i> Làm mới</button>
                                                        </div>
                                                        <div class="col-5"style="margin-top: 5px;">
                                                            <button id="timkiem" onclick="timkiem()" class="btn btn-block btn-primary btn-xs"><i class="fa-solid fa-magnifying-glass" ></i> Tìm kiếm</button>
                                                        </div> 
                                                    </div>                                            
                                            </div>                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-9 col-md-9 col-sm-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card block-right">
                                        <div class="card-header p-1">
                                            <div class="row">
                                                <div class="col-5">
                                                    Danh sách đăng ký
                                                </div>
                                                <div class="col-7">
                                                    <div class="row">                                                                                                                                                                        
                                                        <div class="col-3"></div>
                                                        <div class="col-3"></div>
                                                        <div class="col-3 ">
                                                            <button class="btn btn-block btn-primary btn-xs "><i class="fa-regular fa-file-excel"> </i> Danh sách</button>
                                                        </div>
                                                        <div class="col-3 ">
                                                            <button class="btn btn-block btn-primary btn-xs"> <i class="fa fa-info-circle"> </i> Xem thêm</button>
                                                        </div>                                                                                                                 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table id="table_tkgxn"
                                                class="table table-bordered table-hover table-striped">                                           
                                            </table>                                                                                                 
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @include('user_24.admin24.include.preloader') --}}
            </section>
        </div>
        @include('user_24.admin24.include.footer')
    </div>
    @include('user_24.modalevent')
    <script>
//         $(document).ready(function() {
//     // Khởi tạo Select2 cho tất cả các phần tử select có class 'select2'
//     $('.select2').select2({
//  // Đặt chiều rộng là 100% của container
//         placeholder: 'Chọn một tùy chọn', // Placeholder text
//         allowClear: true // Cho phép xóa lựa chọn
//     });

//     // Khởi tạo cụ thể cho một số select nếu cần
//     $('#tcsv_khoahoc').select2({
//         placeholder: 'Chọn khóa học'
//     });

//     $('#tcsv_nganh').select2({
//         placeholder: 'Chọn ngành'
//     });

//     // Thêm các select khác nếu cần
// });
    </script>
</body>
{{-- <script src="/admin/admin24/js/quanlynhaphoc/tracuusinhvien.js"></script>
<script src="/swiper/swiper.js"></script> --}}
<script>

    function load_loaigiay(){
        $.ajax({
            url: '/admin24/loadloaigiay',
            type: 'GET',
            // dataType: 'json',
            success: function (data1) {
                $('#slb_loaigiay').select2({
                    data: data1
                });
            }
        })
    }
    function load_khoas(){
        $.ajax({
            url: '/admin24/loadkhoas',
            type: 'GET',
            // dataType: 'json',
            success: function (data2) {
                $('#slb_khoas').select2({
                    data: data2
                });
            }
        })
    }

    function load_lop(){
        $.ajax({
            url: '/admin24/loadlop',
            type: 'GET',
            // dataType: 'json',
            success: function (data3) {
                $('#slb_lop').select2({
                    data: data3
                });
            }
        })
    }
    function refresh(){   
        const refresh = $('#slb_lop, #slb_khoas, #slb_loaigiay');
        $('#trangthaiduyet').val(2).trigger('change');
        refresh.val(0).trigger('change');
        $('input[type="text"]').val('');
        $('input[type="date"]').val(''); 
    }
    
    var table = $('#table_tkgxn').DataTable({
        ajax: {
            type: 'get',
            url: '/admin24/loaddata_table',
        },
        columns: [
            {
                title: "MSSV",
                data: 'mssv',
            },
            {
                title: "Họ Tên",
                data: 'hoten' ,
            },
            {
                title: "Lớp",
                data: 'malop',
            },
            {
                title: "Khoá",
                data: 'namnhaphoc',
            },
            {
                title: "Ngày đăng ký",
                data: 'create_at',
            },
            {
                title: "Loại giấy",
                data: 'tengiay',
            },
            {
                title: "Trạng thái",
                data: 'trangthai',
                render: function(data,type,row){
                if(data == 1){
                    return '<small id = "duyetgxn_tb_trangthai'+row.id+'" class="badge badge-primary"><i class="fa-regular fa-circle-check"></i>&nbsp;&nbsp;&nbsp;Đã duyệt</small>'
                }
                return '<small id = "duyetgxn_tb_trangthai'+row.id+'" class="badge badge-warning"><i class="fa-solid fa-spinner"></i>&nbsp;&nbsp;&nbsp;Chưa duyệt</small>'
            }
            },
        ],
        columnDefs: [
            {
                targets: 0,
                className: 'dt-body-center',
            },
            {
                targets: 1,
                className: 'dt-body-center'
            },
            {
                targets: 2,
                className: 'dt-body-center'
            },
            {
                targets: 3,
                className: 'dt-body-center'
            },
            {
                targets: 4,
                className: 'dt-body-center'
            },
            {
                targets: 5,
                className: 'dt-body-center'
            },
            {
                targets: 6,
                className: 'dt-body-center'
            },
        ],

        "language": {
            "emptyTable": "Không tìm thấy thông tin sinh viên",
            "info": " _START_ / _END_ trên _TOTAL_ sinh vien",
            "paginate": {
                "first": "Trang đầu",
                "last": "Trang cuối",
                "next": "Trang kế tiếp",
                "previous": "Trang trước"
            },
            "search": "Tìm kiếm:",
            "loadingRecords": "Đang tìm kiếm ... ",
            "lengthMenu": "Hiện thị _MENU_ sv",
            "infoEmpty": "",
        },
        "retrieve": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": true,
        "responsive": true,
        scrollY: 370,
});

    $(document).ready(function() {
    $('#trangthaiduyet').select2({});
    load_loaigiay()
    load_khoas()
    load_lop()
    loaddata_table()   
    $('.select2').select2({
        width: '100%',
        allowClear: false
    });
    });
    function timkiem(id) {   
        const params = {
            id: id,
            slb_loaigiay: $('#slb_loaigiay').val(),
            slb_khoas: $('#slb_khoas').val(),
            slb_lop: $('#slb_lop').val(),
            hoten: $('#hoten').val(),
            mssv: $('#mssv').val(),
            ngaydangky: $('#ngaydangky').val(),
            trangthaiduyet: $('#trangthaiduyet').val()

            };
        $('#modal_event').show();
        setTimeout(() => {  $('#modal_event').hide() },1000);
        $.ajax({
            url: '/admin24/timkiem_sinhvien',
            type: 'GET',
            data: params,
            success: function(data) {
                console.log(trangthaiduyet);
                toastr.success('Hiện kq thành công');
                table.clear(); // xóa dữ liệu c��       
                table.rows.add(data).draw();                           
                // table.ajax.reload(null, false); // reload dữ liệu mà không reset lại trang
                table.draw('page');
                   
            },
            error: function(xhr, status, error) {
                toastr.error('Hệ thống đang bảo trì');
            }
        });
    }
</script>

</html>
