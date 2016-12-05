$(function() {
    $("#addForm").ajaxForm({
        url: url + '/Authority/SaveData/role',
        beforeSubmit: function() {
            $('#btnSave').button('loading');
        },
        success: function(obj) {
            if (obj.success) {
                $('#addModal').modal('hide');
                swal({
                        title: "儲存成功!",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    },
                    function() {
                        //$("#searchForm").submit();
                        window.location.reload();
                    });
            } else {
                swal("儲存失敗!", obj.msg, "error");
                $('#btnSave').button('reset');
            }
        },
        error: function(xhr) {
            swal("發生異常錯誤!", xhr.statusText, "error");
            $('#btnSave').button('reset');
        }
    });
});

function doAdd(json) {
    if (json == undefined) {
        $('#modalTitle').html('新增系統角色資料');
        $('#btnSave').html('新增');
        $('#type').val('add');
        $('#id').val('');
        $('#name').val('');
        $("#sideID")[0].selectedIndex = 0;
    } else {
        json = JSON.parse(json);
        $('#modalTitle').html('編輯系統角色資料');
        $('#btnSave').html('更新');
        $('#type').val('edit');
        $('#id').val(json['ID']);
        $('#name').val(json['name']);
        $("#sideID").val(json['side']['sideID']);
    }
    $('#addModal').modal('show');
}

function doDelete(id) {
    swal({
            title: "刪除資料?",
            text: "此動作將會刪除資料!",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: '取消',
            confirmButtonClass: "btn-danger",
            confirmButtonText: "刪除",
            closeOnConfirm: false
        },
        function() {
            var data = {
                'type': 'delete',
                'id': id
            };
            $.ajax({
                url: url + '/Authority/SaveData/role',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                error: function(xhr) {
                    swal("刪除失敗!", xhr.statusText, "error");
                },
                success: function(result) {
                    if (result.success) {
                        swal({
                                title: "刪除資料成功!",
                                text: result.msg,
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "OK",
                                closeOnConfirm: false
                            },
                            function() {
                                //$("#searchForm").submit();
                                window.location.reload()
                            });
                    } else {
                        swal("刪除資料失敗!", result.msg, "error");
                    }
                }
            });
        }
    );
}