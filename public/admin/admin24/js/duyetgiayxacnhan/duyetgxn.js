$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
var table = $('#duyetgxn_tb_danhsach').DataTable({
    ajax: {
        type: 'get',
        url: '/admin24/loaddata_table',
    },
    columns: [
        {
            title: "STT",
            data: 'stt',          
        },
        {
            title: "Mã giấy",
            data: 'magiay',
        },
        {
            title: "Họ tên sinh viên",
            data: 'hoten' ,
        },
        {
            title: "MSSV",
            data: 'mssv',
        },
        {
            title: "Ngày đăng ký",
            data: 'create_at',
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
        {
            title: "Chức năng",
            data: 'trangthai',
            render: function(data,type,row){
                var xoatt = '<small id = "xoatt_gxn'+row.id+'" onclick = "xoa_thongtin('+row.id+')" style = "cursor: pointer; font-size: 14px;" ><i class="fa-solid fa-trash"></i></small>'
                var trangthaid = '<input type = "checkbox" id = "duyetgxn_tb_duyet'+row.id+'" onchange = "duyetgxn_tb_duyet('+row.id+')" checked style = "height :14px"> '
                var trangthaicd = '<input type = "checkbox" id = "duyetgxn_tb_duyet'+row.id+'"  style = "height: 14px" onchange = "duyetgxn_tb_duyet('+row.id+')"> '
                var xemtruoc = '<small id = "xemtruoc_gxn'+row.id+'" onclick = "xemtruoc_gxn('+row.id+')" style = "cursor: pointer;font-size: 14px" ><i class="fa-regular fa-eye"></i></small>'
                if(data == 1){
                    return trangthaid + '&nbsp;&nbsp;&nbsp;'+ xemtruoc + '&nbsp;&nbsp;&nbsp;'+ xoatt;
                }
                return trangthaicd + '&nbsp;&nbsp;&nbsp;'+ xemtruoc + '&nbsp;&nbsp;&nbsp;'+ xoatt;
            },
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
        "emptyTable": "Không tìm thấy thông tin",
        "info": " _START_ / _END_ trên _TOTAL_ sinh viên",
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
    "info": true,
    "autoWidth": true,
    "responsive": true,
    scrollY: 300,
});
function duyetgxn_tb_duyet(id){
    $('#modal_event').show(); //Khóa màn h ình
    $('#duyetgxn_tb_duyet'+id).attr('disabled',true) // Khóa nút
    var check = $('#duyetgxn_tb_duyet'+id).prop('checked')   
    check == true ? check = 1 :  check = 0
    setTimeout(() => { // Delay 1s
        $.ajax({
            url: '/admin24/duyetgxn_tb_duyet',
            type: 'POST',
            data: {
                id: id,
                check: check
            },
            success: function (data) {
                if(data == 1){
                    toastr.success('Cập nhật thành công')
                    if(check == 1){
                        $('#duyetgxn_tb_trangthai'+id).html('<i class="fa-regular fa-circle-check"></i>&nbsp;&nbsp;&nbsp;Đã duyệt')
                        $('#duyetgxn_tb_trangthai'+id).removeClass('badge-warning')
                        $('#duyetgxn_tb_trangthai'+id).addClass('badge-primary')
                    } else {
                        $('#duyetgxn_tb_trangthai'+id).html('<i class="fa-solid fa-spinner"></i>&nbsp;&nbsp;&nbsp;Chưa duyệt')
                        $('#duyetgxn_tb_trangthai'+id).addClass('badge-warning')
                        $('#duyetgxn_tb_trangthai'+id).removeClass('badge-primary')
                    }
                } else {
                    toastr.error('Hệ thống đang bảo trì')
                }
                $('#duyetgxn_tb_duyet'+id).attr('disabled',false) // Mở nút khi xử lý xong
                $('#modal_event').hide(); // Mở màn hình khi xử lý xong
            }          
        })
    }, 500);  
}

function xemtruoc_gxn(id) {
    var pdf = $("#display_pdf");
    $('#modal_event').show();
    setTimeout(() => {  $('#modal_event').hide() },500);
    $.ajax({
        url: '/admin24/xemtruoc_gxn',
        type: 'GET',
        data: {
            id: id,           
        },
        success: function(response) {
            toastr.success('Bản xem trước in ra thành công')
            pdf.html(`<b>Họ tên sinh viên:</b> ${response.hoten}<br><br>
                <b>MSSV:</b> ${response.mssv}<br><br>
                <b>Mã giấy:</b> ${response.magiay}<br><br>
                <b>Ngày đăng kí:</b> ${response.create_at}<br><br>
                <b>Trạng thái:</b> ${response.trangthai}`);
        },
        error: function(xhr, status, error) {
            toastr.error('Hệ thống đang bảo trì')
        }
    });
}
function xoa_thongtin(id) {   
    if(confirm('Bạn có chắc chắn muốn xóa?')) {
        $('#modal_event').show();
        setTimeout(() => {  $('#modal_event').hide() },1000);
        $.ajax({
            url: '/admin24/xoa_thongtin',
            type: 'POST',
            data: {
                id: id,
            },
            success: function(data) {
                toastr.success('Xóa thành công');
                table.row($('#xoatt_gxn' + id).closest('tr')).remove();
                table.ajax.reload(null, false); // reload dữ liệu mà không reset lại trang
                // table.draw('page');                                   
            },
            error: function(xhr, status, error) {
                toastr.error('Hệ thống đang bảo trì');
            }
        });
    }
}


