var auth = [];
$(function () {
    $("#userName").bsSuggest('init', {
            url: url + "/Authority/GetUser",
            effectiveFields: ['mobileSystemAccount', 'nodeName', 'name'],
            searchFields: ['mobileSystemAccount', 'nodeName', 'name'],
            effectiveFieldsAlias:{mobileSystemAccount: '員工編號', nodeName: '單位', name: '姓名'},
            ignorecase: true,
            showHeader: true,
            showBtn: false,
            delayUntilKeyup: true, //获取数据的方式为 firstByUrl 时，延迟到有输入/获取到焦点时才请求数据
            idField: 'ID',
            keyField: 'name'
        }).on('onDataRequestSuccess', function (e, result) {
            console.log('onDataRequestSuccess: ', result);
            auth = result['side'];
        }).on('onSetSelectValue', function (e, keyword, data) {
            //console.log('onSetSelectValue: ', keyword, data);
            
            $('input:checkbox:checked[name="side"]').each( function () { 
                $(this).prop("checked", false);
            });
            
            $('#userID').val(keyword['id']);
            var side = auth.filter(function (value) {
                return value['userID'] == keyword['id'];
            });
            for (i = 0; i < side.length; i++) {
                var sid = side[i]['sideID'];
                $('#' + sid).prop("checked",true);
            }
        }).on('onUnsetSelectValue', function () {
            //console.log('onUnsetSelectValue');
            $('#userID').val(null);
    });
});

function doSave() {
    var userID = $('#userID').val();
    if (userID == '') {
        return;
    }
    var sides = [];
    $('input:checkbox:checked[name="side"]').each( function (i) { 
        sides[i] = this.value; 
    });
    
    var data = {
        'userID': userID,
        'sides': sides
    };
    $.ajax({
        url: url + '/Authority/SaveAuth/side',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: data,
        error: function(xhr) {
            swal("儲存失敗!", xhr.statusText, "error");
        },
        success: function(result) {
            if (result.success) {
                swal({
                        title: "儲存資料成功!",
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
                swal("儲存資料失敗!", result.msg, "error");
            }
        }
    });
}