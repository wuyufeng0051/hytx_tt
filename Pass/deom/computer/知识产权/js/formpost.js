// layer.config({ skin: 'layer-ext-moon', extend: 'skin/moon/style.css' });
//表单提交验证
function formPost(info, url) {
    $("form").Validform({
        tiptype: 3,
        postonce: true,
        ajaxPost: true,
        ignoreHidden: true,
        callback: function (data) {
            if (data.status == "y") {
                layer.msg(info, { icon: 1, time: 2000 }, function () {
                    window.location.href = url
                });
            }
        }
    })
}
//表单提交验证
function formPostHidden(info, url) {
    $("form").Validform({
        tiptype: 3,
        postonce: true,
        ajaxPost: true,
        callback: function (data) {
            if (data.status == "y") {
                if (data.newinfo != null) {
                    layer.msg(data.newinfo, { icon: 1 });
                }
                else {
                    layer.msg(info, { icon: 1 });
                }

                if (data.newurl != null) {
                    setTimeout(function () { window.location.href = data.newurl }, 1000)
                }
                else {
                    setTimeout(function () { window.location.href = url }, 1000)
                }
            } else {
                layer.msg(data.info, { icon: 0 }); //自动抓取商标信息Kevin
            }

        }
    })
}

function reviewformPostHidden(info, url) {
    $("#form1").Validform({
        tiptype: 3,
        postonce: true,
        // ajaxPost: true,
        // callback: function (data) {
        //     if (data.status == "y") {
        //         if (data.newinfo != null) {
        //             layer.msg(data.newinfo, { icon: 1 });
        //         }
        //         else {
        //             layer.msg(info, { icon: 1 });
        //         }

        //         if (data.newurl != null) {
        //             setTimeout(function () { window.location.href = data.newurl }, 1000)
        //         }
        //         else {
        //             setTimeout(function () { window.location.href = url }, 1000)
        //         }
        //     }
        // }
    })
}

function formPostHiddenCF(info, url) {
    $("form").Validform({
        tiptype: 3,
        postonce: true,
        ajaxPost: true,
        callback: function (data) {
            if (data.status == "y") {
                if (data.newinfo != null) {
                    layer.msg(data.newinfo, { icon: 1 });
                }
                else {
                    layer.msg(info, 1, { icon: 1 });
                }

                //返回参数，添加到url后面
                var paraString = "";
                if (data.para != null) {
                    var json = eval(data.para);
                    paraString += "?";
                    for (var i = 0; i < json.length; i++) {
                        paraString += json[i].name + "=" + json[i].value + "&";
                    }
                    paraString = paraString.substring(0, paraString.length - 1) //去除最后一个"&"
                }

                if (data.newurl != null) {
                    setTimeout(function () { window.location.href = data.newurl + paraString }, 1000)
                }
                else {
                    setTimeout(function () { window.location.href = url + paraString }, 1000)
                }

            }
        }
    })
}

function AttachDelete(obj, id, hid) {
    $obj = $(obj);
    if ($obj.attr("data-SaveName") != "") {
        $.post('/Common/AttachmentDelete', { 'AttachmentID': $obj.attr("data-SaveName") }, function (data) {
            $obj.parents("div[class=fileBox]").prev().uploadify('cancel', id);
            if ($('#' + id).parent("div[class='fileBox']").find(".uploadify-queue-item").length == 1) {
                $("#" + hid).val("");
                $("#" + hid).blur();
            }
        });
    }
}


//支付表单提交验证方式
function formPostForPay(url) {
    $("form").Validform({
        tiptype: 3,
        beforeSubmit: function (curform) {
            //在验证成功后，表单提交前执行的函数，curform参数是当前表单对象。
            //这里明确return false的话表单将不会提交;
            layer.confirm('支付是否遇到问题？', {
                    icon: 3,
                    btn: ['支付成功', '遇到问题'],
                    yes: function () {
                        window.location.href = url;
                    }, no: function () {
                        window.location.href = url;
                    }
            });
        }
    })
}


//上传附件
function FormUpload(type, relationID, uploadPath) {
    if (type == "add") {
        $('#file_upload').uploadify({
            'auto': true,
            'swf': '../../Scripts/uploadify/uploadify.swf',
            'uploader': '/Common/Upload',
            'formData': { 'relationID': $("#" + relationID).val(), 'uploadPath': uploadPath },
            'buttonText': '上传附件',
            'removeCompleted': false,
            'removeTimeout': 1,
            'progressData': 'percentage',
            'queueID': 'UploadBox',
            'buttonClass': 'file',
            'multi': false,
            'fileSizeLimit': '10MB',
            'fileTypeExts': '*.zip;*.doc;*.docx;*.xls;*.xlsx;*.pdf',
            'onUploadSuccess': function (file, data, response) {
                eval('data=' + data);

                var fileUrl = data.Url;
                var formatLength = fileUrl.split(".").length;
                var format = fileUrl.split(".")[formatLength - 1]
                if (format == "jpg" || format == "gif" || format == "png") {
                    var fileImg = "<a href='" + fileUrl + "' data-lightbox='roadtrip3' target='_blank'><img src='" + fileUrl + "'></a>"
                } else {
                    var fileImg = "<a href='/Common/DownloadAttachment?AttachmentID=" + data.AttachmentID + "' target='_blank'><img src='/Images/File_" + format + ".png'></a>"
                }
                $("#" + file.id).prepend('<div class="pic">' + fileImg + '</div>')
                $("#" + file.id + " a").attr("data-SaveName", data.AttachmentID);
                //AttachmentDelete();
                $("#" + file.id + " .cancel a").click(function () {
                    $.post('/Common/AttachmentDelete', { 'AttachmentID': $(this).attr("data-SaveName") }, function (data) {
                        $('#file_upload').uploadify('disable', false);
                        $('#file_upload').uploadify('cancel', '*');
                    });
                })

                //                $("#" + file.id + " a").attr("data-SaveName", data.AttachmentID);
                //                $("#" + file.id + " a").bind("click", function () {
                //                    AttachmentDelete(this);
                //                    $('#file_upload').uploadify('cancel', '*');
                //                });
                $('#file_upload').uploadify('disable', true);
            }
        });
    }
    if (type == "edit") {
        $('#file_upload').uploadify({
            'auto': true,
            'swf': '../../Scripts/uploadify/uploadify.swf',
            'uploader': '/Common/Upload',
            'formData': { 'relationID': $("#" + relationID).val(), 'uploadPath': uploadPath },
            'buttonText': '上传附件',
            'removeCompleted': false,
            'removeTimeout': 1,
            'progressData': 'percentage',
            'queueID': 'UploadBox',
            'buttonClass': 'file',
            'multi': false,
            'fileSizeLimit': '10MB',
            'fileTypeExts': '*.zip;*.doc;*.docx;*.xls;*.xlsx;*.pdf',
            'onUploadSuccess': function (file, data, response) {
                eval('data=' + data);
                var fileUrl = data.Url;
                var formatLength = fileUrl.split(".").length;
                var format = fileUrl.split(".")[formatLength - 1]
                if (format == "jpg" || format == "gif" || format == "png") {
                    var fileImg = "<a href='" + fileUrl + "' data-lightbox='roadtrip3' target='_blank'><img src='" + fileUrl + "'></a>"
                } else {
                    var fileImg = "<a href='/Common/DownloadAttachment?AttachmentID=" + data.AttachmentID + "' target='_blank'><img src='/Images/File_" + format + ".png'></a>"
                }
                $("#" + file.id).prepend('<div class="pic">' + fileImg + '</div>')
                $("#" + file.id + " a").attr("data-SaveName", data.AttachmentID);
                //AttachmentDelete();
                $("#" + file.id + " .cancel a").click(function () {
                    $.post('/Common/AttachmentDelete', { 'AttachmentID': $(this).attr("data-SaveName") }, function (data) {
                        $('#file_upload').uploadify('disable', false);
                        $('#file_upload').uploadify('cancel', '*');
                    });
                })
                //                $("#" + file.id + " a").attr("data-SaveName", data.AttachmentID);
                //                $("#" + file.id + " a").bind("click", function () {
                //                    AttachmentDelete(this);
                //                });
                $('#file_upload').uploadify('disable', true);
            },
            'onSWFReady': function () {
                if ($(".fileBox .uploadify-queue-item").length > 0) {
                    $('#file_upload').uploadify('disable', true);
                }
            }
        });
    }
    if (type == "review") {
        $('#file_upload').uploadify({
            'auto': true,
            'swf': '../../Scripts/uploadify/uploadify.swf',
            'uploader': '/Common/Upload',
            'formData': { 'relationID': $("#" + relationID).val(), 'uploadPath': uploadPath },
            'buttonText': '上传附件',
            'removeCompleted': false,
            'removeTimeout': 1,
            'progressData': 'percentage',
            'queueID': 'UploadBox',
            'buttonClass': 'file',
            'multi': false,
            'fileSizeLimit': '10MB',
            'fileTypeExts': '*.zip;*.doc;*.docx;*.xls;*.xlsx;*.pdf',
            'onUploadSuccess': function (file, data, response) {
                eval('data=' + data);
                var fileUrl = data.Url;
                var formatLength = fileUrl.split(".").length;
                var format = fileUrl.split(".")[formatLength - 1]
                if (format == "jpg" || format == "gif" || format == "png") {
                    var fileImg = "<a href='" + fileUrl + "' data-lightbox='roadtrip3' target='_blank'><img src='" + fileUrl + "'></a>"
                } else {
                    var fileImg = "<a href='/Common/DownloadAttachment?AttachmentID=" + data.AttachmentID + "' target='_blank'><img src='/Images/File_" + format + ".png'></a>"
                }
                $("#" + file.id).prepend('<div class="pic">' + fileImg + '</div>')
                $("#" + file.id + " a").attr("data-SaveName", data.AttachmentID);
                //AttachmentDelete();
                $("#" + file.id + " .cancel a").click(function () {
                    $.post('/Common/AttachmentDelete', { 'AttachmentID': $(this).attr("data-SaveName") }, function (data) {
                        $('#file_upload').uploadify('disable', false);
                        $('#file_upload').uploadify('cancel', '*');
                    });
                })
                //                $("#" + file.id + " a").attr("data-SaveName", data.AttachmentID);
                //                $("#" + file.id + " a").bind("click", function () {
                //                    $("#hdAttachment").val("");
                //                    AttachmentDelete(this);
                //                    $('#file_upload').uploadify('cancel', '*');
                //                });
                $('#file_upload').uploadify('disable', true);
                $("#hdAttachment").val("11");
            }

        });
    }
};

//删除附件
function AttachmentDelete(obj) {
    $obj = $(obj);
    if ($obj.attr("data-SaveName") != "") {
        $.post('/Common/AttachmentDelete', { 'AttachmentID': $obj.attr("data-SaveName") }, function (data) {
            $('#file_upload').uploadify('disable', false);
        });
    }
};

function AttachmentAlsoDelete(obj, id) {
    $obj = $(obj);
    if ($obj.attr("data-SaveName") != "") {
        $.post('/Common/AttachmentDelete', { 'AttachmentID': $obj.attr("data-SaveName") }, function (data) {
            $('#file_upload').uploadify('cancel', id);
            $('#file_upload').uploadify('disable', false);
        });
    }
}

function AttachmentAlsoDelete(obj, id, fileId) {
    $obj = $(obj);
    if ($obj.attr("data-SaveName") != "") {
        $.post('/Common/AttachmentDelete', { 'AttachmentID': $obj.attr("data-SaveName") }, function (data) {
            $('#' + fileId).uploadify('cancel', id);
            $('#' + fileId).uploadify('disable', false);
        });
    }
}

function AttachmentDeleteOffer(obj, id, fileId) {
    $obj = $(obj);
    if ($obj.attr("data-SaveName") != "") {
        $.post('/Common/AttachmentDelete', { 'AttachmentID': $obj.attr("data-SaveName") }, function (data) {
            $('#' + fileId).uploadify('cancel', id);
            $('#' + fileId).uploadify('disable', false);
            $obj.parents("div[class=fileBox]").prev().val("");
            $obj.parents("div[class=fileBox]").prev().blur();
        });
    }
}