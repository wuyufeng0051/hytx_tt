/**
 * Created by tanytree on 2016/7/13.
 * 注意：此文件中的js方法，添加和修改中千万注意，即使是少个逗号，也会引起执行途中报错//20160910
 */
var dlMain = {};
dlMain.localHost = window.location.protocol + '//' + window.location.host + '/';
//新增组件的时候，需要在这里添加所需编辑的功能
dlMain.editMap = {
    'id_singleline': ['form_edit_title', 'form_edit_instruct', 'form_edit_required', 'form_edit_texttype'],
    'id_number': ['form_edit_title', 'form_edit_instruct', 'form_edit_required'],
    'id_multiple': ['form_edit_title', 'form_edit_instruct', 'form_edit_required', 'form_edit_texttype'],
    'id_dropdown': ['form_edit_title', 'form_edit_instruct', 'form_edit_required', 'form_edit_selectset', 'form_edit_selecttype'],
    'id_radio': ['form_edit_title', 'form_edit_instruct', 'form_edit_required', 'form_edit_radioset', 'form_edit_selecttype', 'form_edit_selectlayout'],
    'id_checkbox': ['form_edit_title', 'form_edit_instruct', 'form_edit_required', 'form_edit_checkboxset', 'form_edit_selecttype', 'form_edit_checkboxlogicset', 'form_edit_selectlayout'],
    'id_section': ['form_edit_title', 'form_edit_instruct', 'form_edit_titlealign', 'form_edit_textalign'],
    'id_picture': ['form_edit_instruct', 'form_edit_picture', 'form_edit_textalign', 'form_edit_picture_link', 'form_edit_pictureShow'],
    'id_fileupload': ['form_edit_title', 'form_edit_required', 'form_edit_instruct', 'form_edit_filetype'],
    'id_date': ['form_edit_title', 'form_edit_instruct', 'form_edit_required', 'form_edit_datetype'],
    'id_picturecheckbox': ['form_edit_title', 'form_edit_instruct', 'form_edit_required', 'form_edit_pic_checkboxset', 'form_edit_checkboxlogicset', 'form_edit_picselecttype'],
    'id_pictureradio': ['form_edit_title', 'form_edit_instruct', 'form_edit_required', 'form_edit_pic_radioset', 'form_edit_picselecttype'],
    'id_email': ['form_edit_title', 'form_edit_instruct', 'form_edit_required'],
    'id_code': ['form_edit_title', 'form_edit_instruct'],
    'id_city': ['form_edit_title', 'form_edit_instruct', 'form_edit_required'],
    'id_id': ['form_edit_title', 'form_edit_instruct', 'form_edit_required'],
	'id_phone': ['form_edit_title', 'form_edit_instruct', 'form_edit_required']
};
// 这个部分是 绑定的时候调用函数的列表
dlMain.editFunctionMap = {
    'id_singleline': ['settingTitle', 'settingInstruct', 'settingRequired', 'settingTextType'],
    'id_number': ['settingTitle', 'settingInstruct', 'settingRequired'],
    'id_multiple': ['settingTitle', 'settingInstruct', 'settingRequired', 'settingTextType'],
    'id_dropdown': ['settingTitle', 'settingSelectField', 'settingInstruct', 'settingRequired', 'settingChooseType'],
    'id_radio': ['settingTitle', 'settingRadioField', 'settingInstruct', 'settingRequired', 'settingChooseType', 'settingSelectLayout'],
    'id_checkbox': ['settingTitle', 'settingCheckboxField', 'settingInstruct', 'settingRequired', 'settingChooseType', 'settingCheckboxSelectLogic', 'settingSelectLayout'],
    'id_section': ['settingTitle', 'settingInstruct', 'settingTitleAlign', 'settingSubTitleAlign'],
    'id_picture': ['settingInstruct', 'settingSubTitleAlign', 'settingPicture', 'settingPictureLink', 'settingPictureShow'],
    'id_date': ['settingTitle', 'settingInstruct', 'settingRequired', 'settingDateType'],
    'id_fileupload': ['settingTitle', 'settingRequired', 'settingInstruct', 'settingFileType'],
    'id_picturecheckbox': ['settingTitle', 'settingPictureCheckboxField', 'settingInstruct', 'settingRequired', 'settingCheckboxSelectLogic', 'settingPicChooseType'],
    'id_pictureradio': ['settingTitle', 'settingPictureRadioField', 'settingInstruct', 'settingRequired', 'settingPicChooseType'],
    'id_email': ['settingTitle', 'settingInstruct', 'settingRequired'],
    'id_code': ['settingTitle', 'settingInstruct'],
    'id_city': ['settingTitle', 'settingInstruct', 'settingRequired'],
    'id_id': ['settingTitle', 'settingInstruct', 'settingRequired'],
	'id_phone': ['settingTitle', 'settingInstruct', 'settingRequired']


};
dlMain.currentComponent = ''; // 记录id
dlMain.currentChanged = true; // 记录完 id 要来修改一下这个 这个用来判断需不需要重新绑定事件
dlMain.editManager = function(currentType) {
    if (currentType) {
        $('.form_componentEdit_tips').hide();
    } else {
        $('.form_componentEdit_tips').show();
    }
    $('.form_edit').each(function(i) {
        var editId = $(this).attr('id');
        if ($.inArray(editId, dlMain.editMap[currentType]) < 0) {
            $(this).hide();
        } else {
            $(this).show();
        }
    });

}; // 判断元素是否已经显示，显示的
/*****************todo 插件处理集合****************/
$(function() {
    //表单时效插件件处理
    var startDateTextBox = $('#term-start');
    var endDateTextBox = $('#term-end');

    $.timepicker.datetimeRange(startDateTextBox, endDateTextBox, {
        minInterval: (1000 * 60 * 60),
        // 1hr
        dateFormat: 'yy-m-dd',
        timeFormat: 'HH:mm',
        start: {},
        // start picker options
        end: {} // end picker options
    });


});
/****表单右侧基本控制****/
$(function() {
    //表单的focus操作
    $("input[type=text],textarea,select").focus(function() {
        $(this).addClass('focusOn');
    }).blur(function() {
        $(this).removeClass('focusOn');
    });

    //右侧切换控制
    tab(".rightEditwrap .formEditHd ul li", ".rightEditwrap .formEditBd .row", "on");
});
dlMain.tabs = {
    /*右侧编辑区域，子选项卡*/
    "subTab": (function() {
        var tabObj = $(".subTab");
        function pigBind() {
            tabObj.each(function() {
                var len = $(this).find('.subTab-hd ul li');
                var row = $(this).find('.subTab-row');
                var i = 0;
                len.bind("click",
                    function() {
                        $(this).addClass('on').siblings().removeClass('on');
                        i = len.index(this);
                        row.eq(i).fadeIn(500).siblings().hide();
                        return false
                    }).eq(0).trigger("click");
            });
        }
        return {
            bind: function() {
                return pigBind();
            }
        };
    })(),
	   "swiperImg": (function() {
        var tabObj = $(".swiperImg");
        function pigBind() {
            tabObj.each(function() {
                var len = $(this).find('.buttle i');
                var row = $(this).find('.imgList img');
                var i = 0;
                len.bind("click",
                    function() {
                        $(this).addClass('on').siblings().removeClass('on');
                        i = len.index(this);
                        row.eq(i).fadeIn(500).siblings().hide();
                        return false
                    }).eq(0).trigger("click");
            });
        }
        return {
            bind: function() {
                return pigBind();
            }
        };
    })()
}
dlMain.clickFn = {
    "JSaddModBtn": (function() {
        $(".JSaddModBtn").on('click',
            function() {
                $(".rightEditwrap .formEditHd ul li").eq(1).trigger("click");
                $(this).parent().remove();
            })
    })(),
}
// todo 这里的tab方法是根据参数长短调用不同的方法
var tab = function(a, b, c) {
    if (arguments.length < 2) {
        var tabObj = $(a);
        tabObj.each(function() {
            var len = $(this).find('.hd ul li');
            var row = $(this).find('.row');
            len.bind("click",
                function() {
                    var index = 0;
                    $(this).addClass('on').siblings().removeClass('on');
                    index = len.index(this);
                    row.eq(index).fadeIn(500).siblings(".row").hide();
                    return false
                }).eq(0).trigger("click");
        })
    } else {
        var len = $(a);
        len.bind("click",
            function() {
                var index = 0;
                $(this).addClass(c).siblings().removeClass(c);
                index = len.index(this);
                $(b).eq(index).show().siblings().hide();
                return false
            }).eq(0).trigger("click")

    }
}
dlMain.componentSetting = {
    /* 编辑标题 */
    'settingTitle': (function() {
        var $editField = $('#form_edit_title'),
        // 获取title 对象
            $selectedCom,
            $titleField,
            oldValue;
        // 对当前的组件进行事件的绑定
        function pigBind() {
            var titleVal;
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent); //获取当前组件id
                $titleField = $selectedCom.find('.title'); //获取当前组件需要编辑的输入区域
                titleVal = $titleField.html().replace(/<br(\/)*>/igm, "\n").replace(/&nbsp;/g, ' ');
                oldValue = $titleField.html().replace(/<br(\/)*>/igm, "\n").replace(/&nbsp;/g, ' ');
                $editField.find('.title_textarea').val(titleVal).unbind('input keyup').bind('input keyup',
                    function() {
                        $titleField.html($(this).val().replace(/[\r\n]/igm, '<br/>').replace(/\s/g, '&nbsp;')); // 回车转义保存
                    });
            }
        }
        return {
            redo: function() {
                // 组件默认值
                return $titleField.text(oldValue.replace(/[\r\n]/igm, '<br/>'));
            },
            bind: function() {
                return pigBind();
            }
        };
    })(),
    /* 描述文字 */
    'settingInstruct': (function() {
        var $editField = $('#form_edit_instruct'),
            $selectedCom;
        function pigBind() {
            var $instructField;
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                $instructField = $selectedCom.find('.instruct');
                $editField.find('.instruct_textarea').val('');
                if ($instructField.length > 0) {
                    $editField.find('.instruct_textarea').val(dlMain.formUtility.HtmlString($instructField.html().replace(/<br(\/)*>/igm, "\n").replace(/&nbsp;/g, ' ')));
                }
                $editField.find('.instruct_textarea').unbind('input keyup').bind('input keyup',
                    function() {
                        if ($.trim($(this).val()) !== '') {
                            $instructField = $selectedCom.find('.instruct');
                        } else {
                            //$instructField.remove();
                            $instructField = $selectedCom.find('.instruct');
                        }
                        $instructField.html(this.value);
                    });
            }
        }
        return {
            bind: function() {
                return pigBind();
            }
        };
    })(),
    /* 必填项 */
    'settingRequired': (function() {
        var $editField = $('#form_edit_required'),
            $selectedCom;
        function pigBind() {
            var $requiredField;
            var showRequired;
            if (dlMain.currentComponent) {
                $('#editrequired').removeAttr('disabled');
                $selectedCom = $('#' + dlMain.currentComponent);
                $requiredField = $selectedCom.find('.com_required'); // 找到红点标识
                if ($requiredField.text() !== '') { //判断是否为空
                    $editField.find('input:checkbox').prop('checked', true);
                } else {
                    $editField.find('input:checkbox').prop('checked', false);
                }
                $editField.find('input:checkbox').unbind('change').bind('change',
                    function() {
                        showRequired = '*';
                        if (!$(this).is(":checked")) {
                            showRequired = '';
                        }
                        $requiredField.text(showRequired); //塞入星号
                    });
            }
        }
        return {
            bind: function() {
                return pigBind();
            }
        };
    })(),
    /* 文本类型 */
    'settingTextType': (function() {
        var $editField = $('#form_edit_texttype'),
            $selectedCom;
        function pigBind() {
            var currentType;
            // -- 判断当前的组件的类型，进行渲染啊，更换啊，等等等的
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                currentType = $selectedCom.attr('name');
                if (currentType === 'id_singleline') {
                    $('#textfieldstyle_single').prop('checked', true);
                } else if (currentType === 'id_multiple') {
                    $('#textfieldstyle_multi').prop('checked', true);
                }
            }
            $editField.find('input:radio').unbind('change').bind('change',
                function() {
                    var type = $(this).attr('id'),
                        changeMap = {
                            'textfieldstyle_multi': {
                                'name': 'id_multiple',
                                'componentType': '<textarea class="textarea" disabled="disabled"></textarea>'
                            },
                            'textfieldstyle_single': {
                                'name': 'id_singleline',
                                'componentType': '<input type="text" class="input" disabled="disabled"/>'
                            }
                        },
                        newInfo;
                    newInfo = changeMap[type];
                    $selectedCom.attr('name', newInfo.name).find('.modCell').not('.deleteButton').html(newInfo.componentType);
                    renderFormComponent($selectedCom);
                });
        }
        return {
            bind: function() {
                return pigBind();
            }
        };
    })(),
    /*标题对齐 */
    'settingTitleAlign': (function() {
        // 分割线标题居中
        var $editField = $('#form_edit_titlealign'),
            $selectedCom;
        function pigBind() {
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                var $titleField = $selectedCom.find('.title_field');
                $titleField.addClass("title_field_block");
                var currentAlign = $titleField.css('text-align');
                $editField.find('#titlealignstyle_' + currentAlign).prop('checked', true);
                $editField.find('input[type="radio"]').unbind('click').bind('click',
                    function() {
                        var selectedAlign = $(this).val();
                        $titleField.css('text-align', selectedAlign);
                    });
            }
        }
        return {
            bind: function() {
                return pigBind();
            }
        };
    })(),
    /*副标题对齐 */
    'settingSubTitleAlign': (function() {
        // 分割线、 图片的说明文字的居中
        var $editField = $('#form_edit_textalign'),
            $selectedCom;
        function pigBind() {
            var $subtitleField;
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                $subtitleField = $selectedCom.find('.subtitle');
                var currentAlign = $subtitleField.css('text-align');
                $editField.find('#textalignstyle_' + currentAlign).prop('checked', true);
                $editField.find('input[type="radio"]').unbind('click').bind('click',
                    function() {
                        var selectedAlign = $(this).val();
                        $subtitleField.css('text-align', selectedAlign);
                    });
            }
        }
        return {
            bind: function() {
                return pigBind();
            }
        };
    })(),
    /*单张大图显示样式设置 */
    'settingPictureShow': (function() {
        var $editField = $('#form_edit_pictureShow'),
            $selectedCom;
        function pigBind() {
            var $imgField;
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                $imgField = $selectedCom.find('img');
                var styleData = $imgField.data('style');
                if (styleData === 'normal' || styleData === undefined) {
                    $editField.find('#pictureshow_tensile').prop('checked', true);
                } else {
                    $editField.find('#pictureshow_middle').prop('checked', true);
                }
                $editField.find('input[type="radio"]').unbind('click').bind('click',
                    function() {
                        var selectedStyle = $(this).val();
                        $imgField.data('style', selectedStyle);
                        if (selectedStyle === 'normal') {
                            $imgField.attr('style', 'width:100%');
                        } else {
                            $imgField.attr('style', 'max-width:100%');
                        }
                    });
            }
        }
        return {
            bind: function() {
                return pigBind();
            }
        };
    })(),
    /*单张大图资源设置 */
    'settingPicture': (function() {
        // 图片组件的图片上传
        var $editField = $('#form_edit_picture'),
            $selectedCom;
        function checkimg($ui) {
            $ui.error(function() {
                $(this).hide();
                $ui.empty();
            });
        }
        function pigBind() {
            var $picField;
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                $picField = $selectedCom.find('.title_field');
                var inputFile = $editField.find('.upload_file p');
                inputFile.removeAttr('style').text('请选择小于2M的jpg、png、jpeg、gif文件进行上传');
                $editField.find('.uploadImageFromUrl').find('input').val('').blur();
                // 上传图片的设置
                dlMain.formUtility.formImgUpload($selectedCom.find('.in_pic_upload'), (function(selectedCom) {
                    var $_selectedCom = $(selectedCom),
                        $_picField = $_selectedCom.find('.title_field');
                    return function(e, data) {
                        var imgPath = data.result.url.replace(/[\\]/g, '/'),
                            $img;
                        if ($_picField.find('img').length > 0) {
                            $img = $_picField.find('img');
                            checkimg($img);
                            $img.attr('src',imgPath);
                        } else {
                            $img = $('<img>').attr('src',imgPath).css('width', '100%');
                            checkimg($img);
                            $picField.empty().append($img);
                        }
                    };
                })('#' + dlMain.currentComponent), inputFile);
                 //绑定上传部分事件
                // $editField.find('.input_file').fileupload({
                //     dataType: "json",
                //     pasteZone: null,
                //     url: uploadurl,
                //     drop: function(e) {
                //         return false;
                //     },
                //     add: function(e, data) {
                //         $selectedCom.find('.in_pic_upload').fileupload('add', data);
                    // }
                // });
                // 上传方式切换
                $('input[name="picturefileshow"]').off('change.showType').on('change.showType',
                    function() {
                        var $this = $(this),
                            local = $editField.find('.uploadImageFromLocal'),
                            link = $editField.find('.uploadImageFromUrl');
                        if ($this.val() === 'link') {
                            local.hide();
                            link.show().find('input').val('').blur();
                        } else {
                            link.hide();
                            local.show();
                            inputFile.removeAttr('style').text('请选择小于2M的jpg、png、jpeg、gif文件进行上传');
                        }
                    });

                // 外链地址
                $editField.find('.uploadImageFromUrl .edit_input').unbind('input keyup paste').bind('input keyup paste',
                    function() {
                        var $_picField = $selectedCom.find('.title_field'),
                            checkScript = function(str) {
                                var p = (str || "").split(':');
                                if (p[0] && (p[0] === 'javascript' || p[0] === 'vbscript')) {
                                    return "";
                                } else {
                                    return str;
                                }
                            };
                        var imgPath = checkScript($.trim($(this).val())) || (siteurl + '../images/bigImg.png'),
                            $img;
                        if ($_picField.find('img').length > 0) {
                            $img = $_picField.find('img');
                            checkimg($img);
                            $img.attr('src', imgPath).show();
                        } else {
                            $img = $('<img>').attr('src', imgPath).css('width', '100%');
                            checkimg($img);
                            $_picField.empty().append($img);
                        }
                    });
            }
        }
        return {
            bind: function() {
                return pigBind();
            }
        };
    })(),
    /*单张大图跳转链接设置 */
    'settingPictureLink': (function() {
        var $editField = $('#form_edit_picture_link'),
        // 获取title 对象
            $selectedCom,
            $pictureField;
        // 对当前的组件进行事件的绑定
        function pigBind() {
            var pictureLink;
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                $pictureField = $selectedCom.find('.title_field');
                var link = $pictureField.attr('img-link');
                if (link == 'false') {
                    link = '';
                }
                pictureLink = decodeURIComponent(link || '');
                $editField.find('.edit_input').val(pictureLink).unbind('input keyup').bind('input keyup',
                    function() {
                        $pictureField.attr('img-link', encodeURIComponent($.trim($(this).val()))); // 回车转义保存
                    }).unbind('paste').bind('paste',
                    function() {
                        $pictureField.attr('img-link', encodeURIComponent($.trim($(this).val()))); // 回车转义保存
                    }).trigger('keyup');
            }
        }
        return {
            bind: function() {
                return pigBind();
            }
        };
    })(),
    /*用户图片上传数量设置 */
    'settingFileType': (function() {
        var $editField = $('#form_edit_filetype'),
            $selectedCom;
        function pigBind() {
            var add, reduce, picNum, picNumVal;
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
				if($selectedCom.data("imgnum")){
                    $editField.find('#picNum').val($selectedCom.data("imgnum"));
                }
                picNum = $editField.find('#picNum');
                picNumVal = $.trim(picNum.val());
                add = $editField.find('.numCtrl .add');
                reduce = $editField.find('.numCtrl .reduce');

                add.on("click",
                    function() {
                        if (picNumVal > 8) {
                            return false;
                        }
                        picNumVal++;
                        picNum.val(picNumVal);
                        $selectedCom.data("imgnum",picNumVal);
                    });
                reduce.on("click",
                    function() {
                        if (picNumVal < 2) {
                            return false;
                        }
                        picNumVal--;
                        picNum.val(picNumVal);
                        $selectedCom.data("imgnum",picNumVal);
                    });
            }
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    //下拉
    'settingSelectField': (function() {
        // 选项设置
        var selectItemList = [],
            $editField = $('#form_edit_selectset'),
            maxNoForName = 0,
            $selectedCom;
        function _addLine() {
            $editField.find('.addButton').unbind('click').bind('click',
                function() {
                    // 新增一条
                    var listNum = selectItemList.length,
                        optionTemplate = '<option>选项' + (listNum + 1) + '</option>',
                        editTemplate = '<li class="editselect_item" lineNum="' + listNum + '"><input class="editstatus" type="radio" name="select_' + $selectedCom.attr('id') + '"><textarea class="edittext textarea input_textarea">选项' + (listNum + 1) + '</textarea><p class="removeButton"></p></li>';
                    $(optionTemplate).attr({
                        'name': ++maxNoForName,
                        'listfield': listNum
                    }).appendTo($selectedCom.find('select'));
                    var $editLine = $(editTemplate);
                    $editField.find('.editselect_item').last().after($editLine);
                    $editLine.find('.edittext').select().focus();
                    $editField.find('.addButton').remove();
                    $editField.find('.editselect_item').last().append('<p class="addButton"></p>');
                    selectItemList.push('选项' + (listNum + 1));
                    _removeLine();
                    _addLine();
                    _editLine();
                });
        }
        function _removeLine() {
            $editField.find('.removeButton').unbind('click').bind('click',
                function() {
                    // 删掉选中的
                    var num = $(this).parent().attr('lineNum'),
                        $corElem = $selectedCom.find('option[listField="' + $(this).parent().attr('lineNum') + '"]');
                    if ($editField.find('.editselect_item').length > 1) {
                        var currentNum = $(this).attr('lineNum');
                        delete selectItemList[currentNum];
                        $corElem.remove();
                        $(this).parent().remove();
                        $editField.find('.addButton').remove();
                        $editField.find('.editselect_item').last().append('<p class="addButton"></p>');
                        if ($editField.find('.editstatus[checked="checked"]').length === 0) {
                            $editField.find('.editstatus').first().prop('checked', true);
                            $selectedCom.find('select').find('option').first().attr('selected', 'selected');
                        }
                        _addLine();
                    } else {
                        $(this).siblings('.edittext').val('');
                        $corElem.text('');
                        selectItemList[num] = '';
                    }
                });
        }
        function _editLine() {
            $editField.find('.edittext').unbind('input keyup').bind('input keyup',
                function(e) {
                    var $this = $(this),
                        num = $this.parent().attr('lineNum'),
                        $corElem = $selectedCom.find('option[listField="' + $this.parent().attr('lineNum') + '"]'),
                        keyCode = e.keyCode || e.which,
                        val_text = ($this.val() || '').replace(/[\r\n]/igm, '');
                    $corElem.text(val_text);
                    selectItemList[num] = val_text;
                    if (val_text.length && val_text.length > 12) {
                        if (!$this.hasClass('much_words')) {
                            $this.addClass('much_words');
                        }
                    } else {
                        $this.removeClass('much_words');
                    }
                    if (keyCode == 13) { //回车新增一行
                        $this.val(val_text).trigger('blur');
                        if ($this.parent().find('.addButton').length > 0) {
                            $this.parent().find('.addButton').trigger('click');
                            return false;
                        }
                    }
                });
            $editField.find('.editstatus').unbind('change').bind('change',
                function() {
                    var $corElem = $selectedCom.find('option[listField="' + $(this).parent().attr('lineNum') + '"]');
                    $corElem.attr('selected', 'selected').siblings().removeAttr('selected');
                });
        }
        /* 进入编辑模式 */
        function _enterBatchMode() {
            var $area = $editField.find('.batch_items');
            var content = '';
            // 1. 获取当前的选项
            // 2. 填充入 textarea
            $editField.find('.form_edit_batch').off('click.batch').on('click.batch',
                function(e) {
                    var items = _getBatchItems();
                    content = items.join('');
                    $area.val(content);
                    _changeMode('batch');
                });
            $editField.find('.btn_save').off('click.batch').on('click.batch',
                function(e) {
                    var newContent = $area.val();
                    var items = newContent.split('\n');
                    _renderLine(items);
                    _changeMode();
                    //重新绑定事件
                    _addLine();
                    _removeLine();
                    _editLine();
                });
            $editField.find('.btn_cancel').off('click.batch').on('click.batch',
                function(e) {
                    _changeMode();
                });
        }
        /* 获取选项的行 */
        function _getBatchItems() {
            var $editText = $editField.find('.edittext');
            var n = $editText.length - 1;
            var items = [];
            $editText.each(function(idx, item) {
                var text = $.trim(item.value);
                var content = '';
                if (idx < n) {
                    content = text + '\n';
                } else {
                    content = text;
                }
                items.push(content);
            });
            return items;
        }
        /* 编辑动画交互 */
        function _changeMode(type) {
            var $select = $editField.find('.editChoiceSelect'),
                $batch = $editField.find('.editBatch'),
                $batchBtn = $editField.find('.form_edit_batch');
            if (type === 'batch') {
                $batchBtn.hide();
                $select.hide();
                $batch.addClass('on');
                $editField.find('.batch_items').focus();
            } else {
                $batchBtn.css('display', 'block');
                $select.css('display', 'block');
                $batch.removeClass('on');
            }
        }
        function _renderLine(items) {
            // 组件 id
            var id = $selectedCom.attr('id');
            // 数据
            selectItemList = [];
            var n = items && items.length;
            var editTemplate = [];
            var optionTemplate = [];
            var isChecked = '';
            // 之后判断批量编辑的情况
            var firstItemText = $.trim(items[0]);
            /* 全部删除，显示默认项 */
            if (n === 1 && firstItemText === '') {
                var text = firstItemText;
                selectItemList.push(text);
                editTemplate.push(_renderEditTemplate({
                    id: id,
                    text: text,
                    isChecked: ''
                }));
                optionTemplate.push(_renderOptionTemplate({
                    checkboxName: ++maxNoForName,
                    text: text
                }));
            } else {
                for (var i = 0; i < n; ++i) {
                    var text = items[i];
                    selectItemList.push(text);

                    if (i === 0) {
                        isChecked = 'checked';
                    } else {
                        isChecked = '';
                    }
                    editTemplate.push(_renderEditTemplate({
                        i: i,
                        id: id,
                        text: text,
                        isChecked: isChecked
                    }));
                    if (i === 0) {
                        optionTemplate.push(_renderOptionTemplate({
                            i: i,
                            checkboxName: ++maxNoForName,
                            text: text,
                            isSelected: 'selected'
                        }));
                    } else {
                        optionTemplate.push(_renderOptionTemplate({
                            i: i,
                            checkboxName: ++maxNoForName,
                            text: text
                        }));
                    }
                }
            }
            $editField.find('.editselect_list').html(editTemplate.join(''));
            $editField.find('.editselect_item').last().append('<p class="addButton"></p>');
            $selectedCom.find('select').html(optionTemplate);
        }
        function _renderEditTemplate(config) {
            var i = config.i || 0,
                id = config.id,
                text = config.text || '',
                isChecked = config.isChecked || '',
                isReadOnly = config.isReadOnly || '';

            /* 需要的组件类型，不要提取，避免提取不断 */
            var type = 'radio';

            return ['<li class="editselect_item" lineNum="' + i + '">', '<input class="editstatus" ' + isChecked + ' type="' + type + '" name="' + type + '_' + id + '">', '<textarea ' + isReadOnly + ' class="edittext textarea input_textarea" >' + text + '</textarea>', '<p class="removeButton"></p></li>'].join('');
        }
        function _renderOptionTemplate(config) {
            var i = config.i || 0,
                text = config.text,
                checkboxName = config.checkboxName,
                isSelected = config.isSelected;
            if (isSelected) {
                return '<option name="' + checkboxName + '" listfield="' + i + '" selected="' + isSelected + '">' + text + '</option>';
            }
            return '<option name="' + checkboxName + '" listfield="' + i + '">' + text + '</option>';
        }
        function pigBind() {
            var tempListHTML = '';
            maxNoForName = 0;
            selectItemList = [];
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                if ($selectedCom.find('option[selected="selected"]').length === 0) {
                    $selectedCom.find('option').first().attr('selected', 'selected');
                }
                $selectedCom.find('option').each(function(i) {
                    if ($(this).attr("name") == "-1") {
                        $selectedCom.find('select').attr('defaultTip', true);
                        var tmpVal = $(this).attr('listField', "-1").text();
                        tempListHTML += '<li class="editselect_item" lineNum="-1"><input class="editstatus" type="radio" name="select_' + $selectedCom.attr('id') + '" ' + ($(this).attr('selected') ? 'checked="checked"': '') + '><textarea class="edittext textarea input_textarea' + ((tmpVal.length && tmpVal.length > 12) ? ' much_words': '') + '" readonly="readonly">' + tmpVal + '</textarea><p class="removeButton"></p></li>';
                    } else {
                        var listNum = selectItemList.length,
                            tmpVal = $(this).attr('listField', listNum).text();
                        var curNoForName = parseInt($(this).attr('name'));
                        if (curNoForName > maxNoForName) {
                            maxNoForName = curNoForName;
                        }
                        selectItemList.push(tmpVal);
                        tempListHTML += '<li class="editselect_item" lineNum="' + listNum + '"><input class="editstatus" type="radio" name="select_' + $selectedCom.attr('id') + '" ' + ($(this).attr('selected') ? 'checked="checked"': '') + '><textarea class="edittext textarea input_textarea' + ((tmpVal.length && tmpVal.length > 12) ? ' much_words': '') + '">' + tmpVal + '</textarea><p class="removeButton"></p></li>';
                    }
                });
                $editField.find('.editselect_list').empty().append(tempListHTML);
                $editField.find('.editselect_item').last().append('<p class="addButton"></p>');
                $selectedCom.unbind('getItemList').bind('getItemList',
                    function(event, list) {
                        function _dataInfo() {
                            var _res = {
                                data: []
                            };
                            $selectedCom.find('option').each(function() {
                                if ($(this).attr('name') !== '-1') {
                                    _res.data.push($(this).text());
                                }
                            });
                            return _res;
                        }
                        list.dataInfo = _dataInfo();
                    });
                _removeLine();
                _addLine();
                _editLine();
                _enterBatchMode();
            }
        }

        return {
            bind: function() {
                return pigBind();
            },
            getItemList: function() {
                return selectItemList;
            }
        };
    })(),
    //多选
    'settingCheckboxField': (function() {
        // 多选框设置
        var selectItemList = [],
            $editField = $('#form_edit_checkboxset'),
            $selectedCom,
            checkboxName;
        function _addLine() {
            $editField.find('.addButton').unbind('click').bind('click',
                function() {
                    var listNum = selectItemList.length,
                        optionTemplate = '<li class="optionsLine medium"><label><input type="checkbox" name="' + checkboxName + '" value="0" disabled="disabled"><span class="optionValue">选项' + (listNum + 1) + '</span></label></li>',
                        editTemplate = '<li class="editcheckbox_item" lineNum="' + listNum + '"><input class="editstatus" type="checkbox" name="checkbox_' + $selectedCom.attr('id') + '"><textarea class="edittext textarea input_textarea">选项' + (listNum + 1) + '</textarea><p class="removeButton"></p></li>';
                    $(optionTemplate).insertAfter($selectedCom.find('.optionsLine').last()).attr('listfield', listNum).find('input:checkbox').attr({
                        'name': checkboxName,
                        'value': listNum
                    });
                    var $editLine = $(editTemplate);
                    $editField.find('.editcheckbox_item').last().after($editLine);
                    $editLine.find('.edittext').select().focus();
                    $editField.find('.addButton').remove();
                    $editField.find('.editcheckbox_item').last().append('<p class="addButton"></p>');
                    selectItemList.push('选项' + (listNum + 1));
                    _removeLine();
                    _addLine();
                    _editLine();
                });
        }
        function _removeLine() {
            $editField.find('.removeButton').unbind('click').bind('click',
                function() {
                    // 删掉选中的
                    var num = $(this).parent().attr('lineNum'),
                        $corElem = $selectedCom.find('.optionsLine[listField="' + $(this).parent().attr('lineNum') + '"]');
                    if ($editField.find('.editcheckbox_item').length > 1) {
                        var currentNum = $(this).attr('lineNum');
                        delete selectItemList[currentNum];
                        $corElem.remove();
                        $(this).parent().remove();
                        $editField.find('.addButton').remove();
                        $editField.find('.editcheckbox_item').last().append('<p class="addButton"></p>');
                        _addLine();
                    } else {
                        $(this).siblings('.edittext').val('');
                        $corElem.find('.optionValue').text('');
                        selectItemList[num] = '';
                    }
                });
        }
        function _editLine() {
            $editField.find('.edittext').unbind('input keyup').bind('input keyup',
                function(e) {
                    var $this = $(this),
                        num = $this.parent().attr('lineNum'),
                        $corElem = $selectedCom.find('.optionsLine[listField="' + $this.parent().attr('lineNum') + '"]'),
                        keyCode = e.keyCode || e.which,
                        val_text = ($this.val() || '').replace(/[\r\n]/igm, '');
                    $corElem.find('.optionValue').text(val_text);
                    selectItemList[num] = val_text;
                    if (val_text.length && val_text.length > 12) {
                        if (!$this.hasClass('much_words')) {
                            $this.addClass('much_words');
                        }
                    } else {
                        $this.removeClass('much_words');
                    }
                    if (keyCode == 13) {
                        $this.val(val_text).trigger('blur');
                        if ($this.parent().find('.addButton').length > 0) {
                            $this.parent().find('.addButton').trigger('click');
                            return false;
                        }
                    }
                });
            $editField.find('.editstatus').unbind('change').bind('change',
                function() {
                    var $corElem = $selectedCom.find('.optionsLine[listField="' + $(this).parent().attr('lineNum') + '"]');
                    $corElem.find('input:checkbox').attr('checked', ($(this).attr('checked') === 'checked'));
                });
        }
        /* 进入编辑模式 */
        function _enterBatchMode() {
            var $area = $editField.find('.batch_items');
            var content = '';
            // 1. 获取当前的选项
            // 2. 填充入 textarea
            $editField.find('.form_edit_batch').off('click.batch').on('click.batch',
                function(e) {
                    var items = _getBatchItems();
                    content = items.join('');
                    $area.val(content);
                    _changeMode('batch');
                });
            $editField.find('.btn_save').off('click.batch').on('click.batch',
                function(e) {
                    var newContent = $area.val();
                    var items = newContent.split('\n');
                    _renderLine(items);
                    _changeMode();
                    _addLine();
                    _removeLine();
                    _editLine();
                });
            $editField.find('.btn_cancel').off('click.batch').on('click.batch',
                function(e) {
                    _changeMode();
                });
        }
        /* 获取选项的行 */
        function _getBatchItems() {
            var $editText = $editField.find('.edittext');
            var n = $editText.length - 1;
            var items = [];
            $editText.each(function(idx, item) {
                var text = $.trim(item.value);
                var content = '';
                if (idx < n) {
                    content = text + '\n';
                } else {
                    content = text;
                }
                items.push(content);
            });
            return items;
        }
        /* 编辑动画交互 */
        function _changeMode(type) {
            var $checkbox = $editField.find('.editChoiceCheckbox'),
                $batch = $editField.find('.editBatch'),
                $batchBtn = $editField.find('.form_edit_batch');
            if (type === 'batch') {
                $batchBtn.hide();
                $checkbox.hide();
                $batch.addClass('on');
                $editField.find('.batch_items').focus();
            } else {
                $batchBtn.css('display', 'block');
                $checkbox.css('display', 'block');
                $batch.removeClass('on');
            }
        }
        function _renderLine(items) {
            // 组件 id
            var id = $selectedCom.attr('id');
            // 数据
            selectItemList = [];
            var n = items && items.length;
            var editTemplate = [];
            var optionTemplate = [];
            // 默认要保留一个空值的选项
            if (n === 1 && items[0] === '') {
                var text = items[0];
                selectItemList.push(text);
                editTemplate.push('<li class="editcheckbox_item" lineNum="0">', '<input class="editstatus" type="checkbox" name="checkbox_' + id + '">', '<textarea class="edittext textarea input_textarea" >' + text + '</textarea>', '<p class="removeButton"></p></li>');
                optionTemplate.push('<li class="optionsLine medium" listfield="0"><label><input type="checkbox" name="' + checkboxName + '" value=' + i + ' disabled="disabled"><span class="optionValue">' + text + '</span></label></li>');
            } else {
                for (var i = 0; i < n; ++i) {
                    var text = items[i];
                    selectItemList.push(text);
                    editTemplate.push('<li class="editcheckbox_item" lineNum="' + i + '">', '<input class="editstatus" type="checkbox" name="checkbox_' + id + '">', '<textarea class="edittext textarea input_textarea" >' + text + '</textarea>', '<p class="removeButton"></p></li>');
                    optionTemplate.push('<li class="optionsLine medium" listfield="' + i + '"><label><input type="checkbox" name="' + checkboxName + '" value=' + i + ' disabled="disabled"><span class="optionValue">' + text + '</span></label></li>');
                }
            }
            $editField.find('.editcheckbox_list').html(editTemplate.join(''));
            $editField.find('.editcheckbox_item').last().append('<p class="addButton"></p>');
            $selectedCom.find('.optionGarden').html(optionTemplate);
        }
        function pigBind() {
            var tempListHTML = '';
            selectItemList = [];
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                checkboxName = $selectedCom.find('.optionsLine').first().find('input:checkbox').attr('name');
                $selectedCom.find('.optionsLine').each(function(i) {
                    var listNum, tmpVal = $(this).find('.optionValue').text();
                    if ($(this).find('input:checkbox').val()) {
                        var _tmpKey = parseInt($(this).find('input:checkbox').val(), 0);
                        if (selectItemList[_tmpKey]) {
                            selectItemList.push(tmpVal);
                            $(this).find('input:checkbox').val(selectItemList.length - 1);
                        } else {
                            selectItemList[_tmpKey] = tmpVal;
                        }
                    } else {
                        selectItemList.push(tmpVal);
                    }
                    listNum = $(this).find('input:checkbox').val();
                    $(this).attr('listField', listNum);
                    tempListHTML += '<li class="editcheckbox_item" lineNum="' + listNum + '"><input class="editstatus" type="checkbox" name="checkbox_' + $selectedCom.attr('id') + '" ' + ($(this).find('input:checkbox').attr('checked') == 'checked' ? 'checked="checked"': '') + '/><textarea class="edittext textarea input_textarea' + ((tmpVal.length && tmpVal.length > 12) ? ' much_words': '') + '">' + tmpVal + '</textarea><p class="removeButton"></p></li>';
                });
                $editField.find('.editcheckbox_list').empty().append(tempListHTML);
                $editField.find('.editcheckbox_item').last().append('<p class="addButton"></p>');
                $selectedCom.unbind('getItemList').bind('getItemList',
                    function(event, list) {
                        function _dataInfo() {
                            var _res = {
                                data: []
                            };
                            $selectedCom.find('.optionsLine').each(function() {
                                var option = $(this).find('.optionValue');
                                _res.data.push(option.text());
                            });
                            return _res;
                        }
                        list.dataInfo = _dataInfo();
                    });
                _removeLine();
                _addLine();
                _editLine();
                _enterBatchMode();
            }
        }
        return {
            bind: function() {
                return pigBind();
            },
            getItemList: function() {
                return selectItemList;
            }
        };
    })(),
    //单选
    'settingRadioField': (function() {
        var selectItemList = [],
            $editField = $('#form_edit_radioset'),
            $selectedCom,
            radioName;
        function _addLine() {
            $editField.find('.addButton').unbind('click').bind('click',
                function() {
                    var listNum = selectItemList.length,
                        optionTemplate = '<li class="optionsLine"><label><input type="radio" name="' + radioName + '" value="0" disabled="disabled"><span class="optionValue">选项' + (listNum + 1) + '</span></label></li>',
                        editTemplate = '<li class="editradio_item" lineNum="' + listNum + '"><input class="editstatus" type="radio" name="radio_' + $selectedCom.attr('id') + '"><textarea class="edittext textarea input_textarea" >选项' + (listNum + 1) + '</textarea><p class="removeButton"></p></li>';
                    $(optionTemplate).insertAfter($selectedCom.find('.optionsLine').not('.other').last()).attr('listfield', listNum).find('input:radio').attr({
                        'name': radioName,
                        'value': listNum
                    });
                    var $editLine = $(editTemplate);
                    $editField.find('.editradio_item').last().after($editLine);
                    $editLine.find('.edittext').select().focus();
                    $editField.find('.addButton').remove();
                    $editField.find('.editradio_item').last().append('<p class="addButton"></p>');

                    selectItemList.push('选项' + (listNum + 1));
                    _removeLine();
                    _addLine();
                    _editLine();
                });
        }
        function _removeLine() {
            $editField.find('.removeButton').unbind('click').bind('click',
                function() {
                    var num = $(this).parent().attr('lineNum'),
                        $corElem = $selectedCom.find('.optionsLine[listField="' + $(this).parent().attr('lineNum') + '"]');
                    if ($editField.find('.editradio_item').length > 1) {
                        var currentNum = $(this).attr('lineNum');
                        delete selectItemList[currentNum];
                        $corElem.remove();
                        $(this).parent().remove();
                        $editField.find('.addButton').remove();
                        $editField.find('.editradio_item').last().append('<p class="addButton"></p>');
                        _addLine();
                    } else {
                        $(this).siblings('.edittext').val('');
                        $corElem.find('.optionValue').text('');
                        selectItemList[num] = '';
                    }
                });
        }
        function _editLine() {
            $editField.find('.edittext').unbind('input keyup').bind('input keyup',
                function(e) {
                    var $this = $(this),
                        num = $this.parent().attr('lineNum'),
                        $corElem = $selectedCom.find('.optionsLine[listField="' + $this.parent().attr('lineNum') + '"]'),
                        keyCode = e.keyCode || e.which,
                        val_text = ($this.val() || '').replace(/[\r\n]/igm, '');
                    $corElem.find('.optionValue').text(val_text);
                    selectItemList[num] = val_text;
                    if (val_text.length && val_text.length > 12) {
                        if (!$this.hasClass('much_words')) {
                            $this.addClass('much_words');
                        }
                    } else {
                        $this.removeClass('much_words');
                    }
                    if (keyCode == 13) {
                        $this.val(val_text).trigger('blur');
                        if ($this.parent().find('.addButton').length > 0) {
                            $this.parent().find('.addButton').trigger('click');
                            return false;
                        }
                    }
                });
            $editField.find('.editstatus').unbind('click').bind('click',
                function() {
                    var $corElem = $selectedCom.find('.optionsLine[listField="' + $(this).parent().attr('lineNum') + '"]');
                    if ($corElem.find('input:radio').attr('checked') === 'checked') {
                        $selectedCom.find('input:radio').prop('checked', false);
                        $(this).prop('checked', false);
                    } else {
                        $selectedCom.find('input:radio').prop('checked', false);
                        $corElem.find('input:radio').prop('checked', true);
                    }
                });
        }
        /* 进入编辑模式 */
        function _enterBatchMode() {
            var $area = $editField.find('.batch_items');
            var content = '';
            // 1. 获取当前的选项
            // 2. 填充入 textarea
            $editField.find('.form_edit_batch').off('click.batch').on('click.batch',
                function(e) {
                    var items = _getBatchItems();
                    content = items.join('');
                    $area.val(content);
                    _changeMode('batch');
                });
            $editField.find('.btn_save').off('click.batch').on('click.batch',
                function(e) {
                    var newContent = $area.val();
                    var items = newContent.split('\n');
                    _renderLine(items);
                    _changeMode();
                    //重新绑定事件
                    _addLine();
                    _removeLine();
                    _editLine();
                });
            $editField.find('.btn_cancel').off('click.batch').on('click.batch',
                function(e) {
                    _changeMode();
                });
        }
        /* 获取选项的行 */
        function _getBatchItems() {
            var $editText = $editField.find('.edittext');
            var n = $editText.length - 1;
            var items = [];
            $editText.each(function(idx, item) {
                var text = $.trim(item.value);
                var content = '';
                if (idx < n) {
                    content = text + '\n';
                } else {
                    content = text;
                }
                items.push(content);
            });
            return items;
        }
        /* 编辑动画交互 */
        function _changeMode(type) {
            var $radios = $editField.find('.editChoiceRadio'),
                $batch = $editField.find('.editBatch'),
                $batchBtn = $editField.find('.form_edit_batch');
            if (type === 'batch') {
                $batchBtn.hide();
                $radios.hide();
                $batch.addClass('on');
                $editField.find('.batch_items').focus();
            } else {
                $batchBtn.css('display', 'block');
                $radios.css('display', 'block');
                $batch.removeClass('on');
            }
        }
        function _renderLine(items) {
            // 组件 id
            var id = $selectedCom.attr('id');
            // 数据
            selectItemList = [];
            var n = items && items.length;
            var editTemplate = [];
            var optionTemplate = [];
            /* 全部删除，显示默认项 */
            if (n === 1 && items[0] === '') {
                var text = items[0];
                selectItemList.push(text);
                editTemplate.push('<li class="editradio_item" lineNum="0">', '<input class="editstatus" type="radio" name="radio_' + id + '">', '<textarea class="edittext textarea input_textarea" >' + text + '</textarea>', '<p class="removeButton"></p></li>');
                optionTemplate.push('<li class="optionsLine medium" listfield="0"><label><input type="radio" name="' + radioName + '" value=' + i +' disabled="disabled"><span class="optionValue">' + text + '</span></label></li>');
            } else {
                for (var i = 0; i < n; ++i) {
                    var text = items[i];
                    selectItemList.push(text);
                    editTemplate.push('<li class="editradio_item" lineNum="' + i + '">', '<input class="editstatus" type="radio" name="radio_' + id + '">', '<textarea class="edittext textarea input_textarea" >' + text + '</textarea>', '<p class="removeButton"></p></li>');
                    optionTemplate.push('<li class="optionsLine medium" listfield="' + i + '"><label><input type="radio" name="' + radioName + '" value=' + i + ' disabled="disabled"><span class="optionValue">' + text + '</span></label></li>');
                }
            }
            $editField.find('.editradio_list').html(editTemplate.join(''));
            $editField.find('.editradio_item').last().append('<p class="addButton"></p>');
            $selectedCom.find('.optionGarden').html(optionTemplate);
        }
        function pigBind() {
            var tempListHTML = '';
            selectItemList = [];
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                radioName = $selectedCom.find('.optionsLine').first().find('input:radio').attr('name');
                $selectedCom.find('.optionsLine:not(.other)').each(function(i) {
                    var listNum, tmpVal = $(this).find('.optionValue').text();
                    if ($(this).find('input:radio').val()) {
                        var _tmpKey = parseInt($(this).find('input:radio').val(), 0);
                        if (selectItemList[_tmpKey]) {
                            selectItemList.push(tmpVal);
                            $(this).find('input:radio').val(selectItemList.length - 1);
                        } else {
                            selectItemList[_tmpKey] = tmpVal;
                        }
                    } else {
                        selectItemList.push(tmpVal);
                    }
                    listNum = $(this).find('input:radio').val();
                    $(this).attr('listField', listNum);
                    tempListHTML += '<li class="editradio_item" lineNum="' + listNum + '"><input class="editstatus" type="radio" name="radio_' + $selectedCom.attr('id') + '" ' + ($(this).find('input:radio').attr('checked') == 'checked' ? 'checked="checked"': '') + '><textarea class="edittext textarea input_textarea' + ((tmpVal.length && tmpVal.length > 12) ? ' much_words': '') + '">' + tmpVal + '</textarea><p class="removeButton"></p></li>';
                });
                $editField.find('.editradio_list').empty().append(tempListHTML);
                $editField.find('.editradio_item').last().append('<p class="addButton"></p>');
                $selectedCom.unbind('getItemList').bind('getItemList',
                    function(event, list) {
                        function _dataInfo() {
                            var _res = {
                                data: []
                            };
                            $selectedCom.find('.optionsLine').not('.other').each(function() {
                                var option = $(this).find('.optionValue');
                                _res.data.push(option.text());
                            });
                            return _res;
                        }
                        list.dataInfo = _dataInfo();
                    });
                _removeLine();
                _addLine();
                _editLine();
                /* 编辑模式 */
                _enterBatchMode();
            }
        }
        return {
            bind: function() {
                return pigBind();
            },
            getItemList: function() {
                return selectItemList;
            }
        };
    })(),
    //单选，下拉，多选类型切换设置
    'settingChooseType': (function() {
        // 这个是选择 选择组件的类型 多选 单选 下拉 互相切换
        // 记得选择完成以后调用重新渲染
        // 记得修改当前的组件的类型
        // 修改后再重新渲染
        var $editField = $('#form_edit_selecttype'),
            $selectedCom,
            _typeMap = {
                'id_checkbox': 'editsize_checkbox',
                'id_radio': 'editsize_radio',
                'id_dropdown': 'editsize_select'
            },
            _map = {
                'id_checkbox': 'checkbox',
                'id_radio': 'radio',
                'id_dropdown': 'select'
            },
            _comMap = {
                'checkbox': 'id_checkbox',
                'radio': 'id_radio',
                'select': 'id_dropdown'
            };

        function generateHTML(type, id, obj, layout) {
            var _r = '',
                _layoutType = '';
            if (layout) {
                _layoutType = 'column-' + layout;
            }
            if (type === 'checkbox') {

                $.each(obj.dataInfo.data,
                    function(k, v) {
                        _r += '<li class="optionsLine medium" listfield="' + k + '"><label><input type="checkbox" name="checkbox' + id + '" value="' + k + '" disabled="true"><span class="optionValue">' + v + '</span></label></li>';
                    });
                _r = '<ul class="optionGarden ui-sortable clearfix  ' + _layoutType + '" >' + _r + '</ul>';
            } else if (type === 'radio') {
                $.each(obj.dataInfo.data,
                    function(k, v) {
                        _r += '<li class="optionsLine" listfield="' + k + '"><label><input type="radio" name="radio' + id + '" value="' + k + '"disabled="true"><span class="optionValue">' + v + '</span></label></li>';
                    });
                _r = '<ul class="optionGarden ui-sortable clearfix  ' + _layoutType + '">' + _r + '</ul>';
            } else if (type === 'select') {
                $.each(obj.dataInfo.data,
                    function(k, v) {
                        _r += '<option name="' + k + '">' + v + '</option>';
                    });
                _r = '<select disabled="true"><option name="-1">请选择</option>' + _r + '</select>';
            }
            return _r;
        }

        function pigBind() {
            var currentType, currentId_Num;
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                currentId_Num = $selectedCom.attr('id').replace('com', '');
                currentType = _typeMap[$selectedCom.attr('name')];
                $editField.find('#' + currentType).prop('checked', true);
                $editField.find('input:radio').unbind('change').bind('change',
                    function() {
                        var selectedType = $(this).val(),
                            selectVal = {
                                'dataInfo': []
                            },
                            tmpHTML = '';
                        $selectedCom.trigger('getItemList', [selectVal]);
                        $selectedCom.find('.' + _map[$selectedCom.attr('name')]).attr('class', selectedType).html(generateHTML(selectedType, currentId_Num, selectVal, $selectedCom.data('layoutType')));
						if(selectedType=='radio'){
							$selectedCom.find('.redTip').hide();
						}
						
                        $selectedCom.attr('name', _comMap[selectedType]);
                        renderFormComponent($selectedCom);
                        addOptionDrag();
                    });
            }
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    //排版分栏数量
    'settingSelectLayout': (function() {
        var $editField = $('#form_edit_selectlayout'),
            $selectedCom,
            typeMap = {
                'column-1': 1,
                'column-2': 2,
                'column-3': 3,
                'column-4': 4
            },
            layoutClass = "column"; //前缀
        function pigBind() {
            var _layout = "1";
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                // --- set val
                $editField.find('input:radio').prop('checked', false);
                if ($selectedCom.data('layoutType')) {
                    _layout = $selectedCom.data('layoutType');
                }
                $selectedCom.data('layoutType', _layout);
                $editField.find('#editlayout_' + _layout).prop('checked', true);
                $editField.find('input:radio').unbind('change').bind('change',
                    function() {
                        var selectedType = $(this).val(),
                            $optionGarden = $selectedCom.find('.optionGarden');
                        $selectedCom.data('layoutType', selectedType);
                        $optionGarden.attr('class', 'optionGarden ui-sortable clearfix ' + layoutClass + '-' + selectedType);
                        if (typeMap[selectedType] !== 1) {
                            var tmpList = [];
                            $optionGarden.find('.optionsLine').each(function(i) {
                                if ((i + 1) % (typeMap[selectedType]) === 0 && i !== 0) {
                                    tmpList.push($(this));
                                }
                            });
                        }
                    });
            }
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    //多选用户选择数量设置
    'settingCheckboxSelectLogic': (function() {
        var $editField = $('#form_edit_checkboxlogicset'),
            $selectedCom;
        function pigBind() {
            var componentData;
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                componentData = $selectedCom.data('__MGComponentSelect');
                if (!componentData) {
                    $selectedCom.data('__MGComponentSelect', {
                        enable: false,
                        number: '',
                        type: 1
                    });
                    componentData = {
                        enable: false,
                        number: '',
                        type: 1
                    };
                }
                $editField.find('.errorinfo').hide();
                if (componentData.enable) {
                    $selectedCom.find(".redTip").show();
                    $editField.find('.select-number-enable').prop('checked', true);
                    $editField.find('.edit-select-number').removeAttr('disabled');
                    $editField.find('.select-number-type').removeAttr('disabled');
                } else {
                    $selectedCom.find(".redTip").hide();
                    $editField.find('.select-number-enable').removeAttr('checked');
                    $editField.find('.edit-select-number').attr('disabled', 'disabled').val('');
                    $editField.find('.select-number-type').attr('disabled', 'disabled');
                }
                $editField.find('.select-number-type').find('option').each(function() {
                    if (parseInt($(this).val(), 0) == componentData.type) {
                        $(this).attr('selected', 'selected');
                    } else {
                        $(this).removeAttr('selected');
                    }
                });
                $editField.find('.edit-select-number').val(componentData.number);
                $editField.find('.select-number-enable').unbind('change').bind('change',
                    function() {
                        var typeValue = $(this).prop('checked');
                        $selectedCom.data('__MGComponentSelect').enable = (typeValue ==true);
                        componentData.enable = (typeValue == true);

                        if (typeValue == true) {
                            $editField.find('.edit-select-number').removeAttr('disabled').val($selectedCom.data('__MGComponentSelect').number).select().focus();
                            $editField.find('.select-number-type').removeAttr('disabled');
                            $selectedCom.find(".redTip").show();
                        } else {
                            $editField.find('.edit-select-number').attr('disabled', 'disabled').val('');
                            $editField.find('.select-number-type').attr('disabled', 'disabled');
                            $selectedCom.find(".redTip").hide();
                        }
                    });
                $editField.find('.select-number-type').unbind('change').bind('change',
                    function() {
                        var typeValue = parseInt($(this).val(), 0);
                        $selectedCom.data('__MGComponentSelect').type = typeValue;
                        componentData.type = typeValue;
                        $selectedCom.find(".redTip").find("b").text($(this).find("option:selected").text());
                    });
                $editField.find('.edit-select-number').unbind('input keyup').bind('input keyup',
                    function() {
                        var number = $(this).val().replace(/[^\d]/g, ''),
                            check = statusCheck();
                        if (!check.status) {
                            number = check.num;
                        }
                        $(this).val(number);
                        $selectedCom.data('__MGComponentSelect').number = number;
                        componentData.number = number;
                        $selectedCom.find(".haederText h2 s").text(number);
                    });
            }
        }
        function statusCheck() {
            var choiceInfo = {},
                currentType = $selectedCom.data('__MGComponentSelect').type,
                choiceLength,
                _rStatus = true,
                _rNum,
                _errorInfo = false,
                $numberinput = $editField.find('.edit-select-number');
            $selectedCom.trigger('getItemList', [choiceInfo]);
            choiceLength = choiceInfo.dataInfo.length + ((choiceInfo.hasOther) ? 1 : 0);
            if (parseInt(currentType) === 1) {
                if (choiceLength < parseInt($numberinput.val()) || parseInt($numberinput.val()) <= 0) {
                    _rStatus = false;
                    _rNum = choiceLength;
                    _errorInfo = true;
                } else {
                    _rNum = parseInt($numberinput.val().replace(/[^\d]/g, ''));
                }
            } else if (parseInt(currentType) === 2) {
                if (choiceLength < parseInt($numberinput.val()) || parseInt($numberinput.val()) <= 0) {
                    _rStatus = false;
                    _rNum = 2;
                    _errorInfo = true;
                } else {
                    _rNum = parseInt($numberinput.val().replace(/[^\d]/g, ''));
                }
            } else if (parseInt(currentType) === 3) {
                if (choiceLength < parseInt($numberinput.val()) || parseInt($numberinput.val()) <= 0) {
                    _rStatus = false;
                    _rNum = 2;
                    _errorInfo = true;
                } else {
                    _rNum = parseInt($numberinput.val().replace(/[^\d]/g, ''));
                }
            }
            return {
                status: _rStatus,
                num: _rNum
            };
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    //设置日期
    'settingDateType': (function() {
        var $editField = $('#form_edit_datetype'),
            $selectedCom;
        function pigBind() {
            var dateType;
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                dateType = $selectedCom.find('.date').attr('datetype');
                $editField.find('input[value="' + dateType + '"]').prop('checked', true);
                $editField.find('input:radio').unbind('change').bind('change',
                    function() {
                        var dateType = $(this).val();
                        $selectedCom.find('.date').attr('datetype', dateType);
                    });
            }
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    //多图选项设置
    'settingPictureCheckboxField': (function(){
        var selectItemList = [],
            $editField = $('#form_edit_pic_checkboxset'),
            $selectedCom, checkboxName;
        function _addLine(){
            $editField.find('.addButton').off('click').on('click',function(){
                var listNum = selectItemList.length,
                    option = '<li class="picturecheckbox-item"><div class="piccheckbox_img i-pic"> <img class="picc_img" src="'+siteurl+'../images/holder.png"> </div><input type="checkbox" name="' + checkboxName + '" value="0" disabled="disabled"><span class="optionValue">选项'+(listNum+1)+'</span></li>',
                    editTemplate = '<li class="editpicturecheckbox_item" lineNum="' + listNum + '"><input class="editstatus" type="checkbox" name="piccheckbox_' + $selectedCom.attr('id') + '"><div class="pictextcontect"><div class="imgcontect"><img src="" alt="" class="choicePicture"><div class="upload_choiceimg"><input type="file" size="1" class="uploadimg" name="_FILE_"/> <span class="upload_btn">上传图片<br/>(限2MB)</span> </div></div><input type="text" class="imgedittext" value="选项"><p class="removeButton"></p></div></li>';
                $(option).appendTo($selectedCom.find('.pictureCheckboxList')).attr('listfield', listNum).find('input:checkbox').attr({
                    'name': checkboxName,
                    'value': listNum
                });
                var $editLine = $(editTemplate);
                $editField.find('.editpicturecheckbox_item').last().after($editLine);
                $editField.find('.addButton').remove();
                $editField.find('.pictextcontect').last().append('<p class="addButton"></p>');
                selectItemList.push({name:'选项',img:''});
                _removeLine();
                _addLine();
                _editLine();
            });
        }
        function _removeLine(){
            $editField.find('.removeButton').off('click').on('click',function(){
                var $_editField = $(this).closest('.editpicturecheckbox_item'),
                    num = parseInt($_editField.attr('lineNum')),
                    $corElem = $selectedCom.find('.picturecheckbox-item[listField="' + $_editField.attr('lineNum') + '"]'),
                    $editLine = $editField.find('.editpicturecheckbox_item');
                if ($editLine.length > 1) {
                    delete selectItemList[num];
                    $corElem.remove();
                    $_editField.remove();
                    $editField.find('.addButton').remove();
                    $editField.find('.pictextcontect').last().append('<p class="addButton"></p>');
                    _addLine();
                } else {
                    $_editField.find('.imgedittext').val('选项');
                    $_editField.find('.upload_btn').show();
                    $_editField.find('.imgcontect img').hide();
                    $corElem.find('.optionValue').text('选项');
                    $corElem.find('.picc_img').remove();
                    $corElem.find('.piccheckbox_img').removeAttr('style');
                    selectItemList[num].name = '选项';
                    selectItemList[num].img = '';
                }
            });
        }

        function _editLine(){
            $editField.off('keyup.editLine input.editLine').on('keyup.editLine input.editLine', '.imgedittext', function (e){
                var $_editField = $(this).closest('.editpicturecheckbox_item'),
                    num = $_editField.attr('lineNum'),
                    $corElem = $selectedCom.find('.picturecheckbox-item[listField="' + num + '"]'),
                    value = $.trim($(this).val());
                $corElem.find('.optionValue').text(value);
                selectItemList[num].name = value;

                if($_editField.find('.addButton').length > 0){
                    // 最后一行， 按回车创建新的一个
                    if(e.which == 13){
                        $_editField.find('.addButton').trigger('click');
                    }
                }
            });
            $editField.off('change.changeStatus').on('change.changeStatus','.editstatus',function (e){
                var $corElem = $selectedCom.find('.picturecheckbox-item[listField="' + $(this).closest('.editpicturecheckbox_item').attr('lineNum') + '"]');
                $corElem.find('input:checkbox').attr('checked', ($(this).attr('checked') === 'checked'));
            });
            dlMain.formUtility.formSelectImgUpload($editField.find('.uploadimg'), function (e, data) {
                var imgPath = data.result.url.replace(/[\\]/g, '/'),
                    $this = $(e.target),
                    $currentField = $this.closest('.editpicturecheckbox_item');
                $this.siblings('.upload_btn').hide();
                $currentField.find('.choicePicture').attr('src',imgPath).show().error(function () {
                    $(this).hide();
                    imgPath = '';
                    $this.siblings('.upload_btn').show();
                });
                var $imgF = $selectedCom.find('.picturecheckbox-item[listField="' + $currentField.attr('linenum') + '"]').find('.piccheckbox_img');
                if($imgF.find('.picc_img').length===0){
                    $imgF.show().append('<img class="picc_img" src="{pigcms:$staticPath}../images/holder.png" />');
                }
                selectItemList[$currentField.attr('linenum')].img = imgPath;
                $imgF.find('.picc_img').attr('src',imgPath);
            });
        }
        function pigBind(){
            var tempListHTML = [];
            selectItemList = [];
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                checkboxName = $selectedCom.find('.piccheckbox_contect input[type="checkbox"]').attr('name');
                // 显示编辑项目
                var $items = $selectedCom.find('.picturecheckbox-item').not('.empty');
                if($items.length > 0){
                    $items.each(function(){
                        var listNum = selectItemList.length,
                            tmpVal = $(this).attr('listField', listNum).find('.optionValue').text();
                        selectItemList.push({
                            img: $(this).find('.picc_img').attr('src')||'',
                            name: tmpVal
                        });
                        var $imgInfo = $(this).find('.picc_img'),
                            __img = '<img src="" alt="" class="choicePicture"><div class="upload_choiceimg"><input type="file" size="1" class="uploadimg" name="_FILE_"/><span class="upload_btn">上传图片<br/>(限2MB)</span>';
                        if($imgInfo.length>0){
                            __img = '<img src="'+$imgInfo.attr('src')+'" alt="" class="choicePicture" style="display: inline;"><div class="upload_choiceimg"><input type="file" size="1" class="uploadimg" name="_FILE_"/><span class="upload_btn" style="display:none">上传图片<br/>(限2MB)</span>';
                        }
                        tempListHTML.push('<li class="editpicturecheckbox_item" lineNum="' + listNum + '"><input class="editstatus" type="checkbox" name="piccheckbox_' + $selectedCom.attr('id') + '" ' + ($(this).find('input:checkbox').attr('checked')=='checked'? 'checked="checked"' : '') + '><div class="pictextcontect"><div class="imgcontect">'+__img+'</div></div><input type="text" class="imgedittext" value="' + tmpVal + '"><p class="removeButton"></p>');

                    });
                    tempListHTML[tempListHTML.length-1] += '<p class="addButton"></p></div>';
                }
                tempListHTML = tempListHTML.join('</li>');
                $editField.find('.editpiccheckbox_list').empty().append(tempListHTML);
                $selectedCom.unbind('getItemList').bind('getItemList', function (event, list) {
                    list.dataInfo = selectItemList;
                });
                _addLine();
                _editLine();
                _removeLine();
            }
        }
        return {
            bind: pigBind,
            getItemList: function(){
                return selectItemList;
            }
        };
    })(),

    'settingPictureRadioField': (function() {
        var selectItemList = [],
            $editField = $('#form_edit_pic_radioset'),
            $selectedCom,
            radioName;
        function _addLine() {
            $editField.find('.addButton').off('click').on('click',
                function() {
                    var listNum = selectItemList.length,
                        option = '<li class="pictureradio-item"><div class="picradio_img i-pic"> <img src="'+siteurl+'../images/holder.png"> </div><input type="radio" name="' + radioName + '" value="0" disabled="disabled"><span class="optionValue">选项' + (listNum + 1) + '</span></li>',
                        editTemplate = '<li class="editpictureradio_item" lineNum="' + listNum + '"><input class="editstatus" type="radio" name="picradio_' + $selectedCom.attr('id') + '"><div class="pictextcontect"><div class="imgcontect"><img src="" alt="" class="choicePicture"><div class="upload_choiceimg"><input type="file" size="1" class="uploadimg" name="_FILE_"/> <span class="upload_btn">上传图片<br/>(限2MB)</span> </div></div><input type="text" class="imgedittext" value="选项' + (listNum + 1) + '"><p class="removeButton"></p></div></li>';
                    $(option).appendTo($selectedCom.find('.pictureRadioList')).attr('listfield', listNum).find('input:radio').attr({
                        'name': radioName,
                        'value': listNum
                    });

                    var $editLine = $(editTemplate);
                    $editField.find('.editpictureradio_item').last().after($editLine);
                    $editField.find('.addButton').remove();
                    $editField.find('.pictextcontect').last().append('<p class="addButton"></p>');
                    selectItemList.push({
                        name: '选项',
                        img: ''
                    });
                    _removeLine();
                    _addLine();
                    _editLine();
                });
        }

        function _removeLine() {
            $editField.find('.removeButton').off('click').on('click',
                function() {
                    // remove 自己
                    var $_editField = $(this).closest('.editpictureradio_item'),
                        num = parseInt($_editField.attr('lineNum')),
                        $corElem = $selectedCom.find('.pictureradio-item[listField="' + $_editField.attr('lineNum') + '"]'),
                        $editLine = $editField.find('.editpictureradio_item');
                    if ($editLine.length > 1) {
                        delete selectItemList[num];
                        $corElem.remove();
                        $_editField.remove();
                        $editField.find('.addButton').remove();
                        $editField.find('.pictextcontect').last().append('<p class="addButton"></p>');
                        _addLine();
                    } else {
                        $_editField.find('.imgedittext').val('选项');
                        $_editField.find('.upload_btn').show();
                        $_editField.find('.imgcontect img').hide();
                        $corElem.find('.optionValue').text('选项');
                        $corElem.find('.picc_img').remove();
                        $corElem.find('.picradio_img').removeAttr('style');
                        selectItemList[num].name = '选项';
                        selectItemList[num].img = '';
                    }
                });
        }
        function _editLine() {
            // text edit
            $editField.off('keyup.editLine input.editLine').on('keyup.editLine input.editLine', '.imgedittext',
                function(e) {
                    var $_editField = $(this).closest('.editpictureradio_item'),
                        num = $_editField.attr('lineNum'),
                        $corElem = $selectedCom.find('.pictureradio-item[listField="' + num + '"]'),
                        value = $.trim($(this).val());
                    $corElem.find('.optionValue').text(value);
                    selectItemList[num].name = value;
                    if ($_editField.find('.addButton').length > 0) {
                        // 最后一行， 按回车创建新的一个
                        if (e.which == 13) {
                            $_editField.find('.addButton').trigger('click');
                        }
                    }
                });
            // status edit
            $editField.off('click.changeStatus').on('click.changeStatus', '.editstatus',
                function(e) {
                    var $corElem = $selectedCom.find('.pictureradio-item[listField="' + $(this).closest('.editpictureradio_item').attr('lineNum') + '"]');
                    if ($corElem.find('input:radio').attr('checked') === 'checked') {
                        $selectedCom.find('input:radio').removeAttr('checked');
                        $(this).removeAttr('checked');
                    } else {
                        $selectedCom.find('input:radio').removeAttr('checked');
                        $corElem.find('input:radio').prop('checked', true);
                    }
                });
            dlMain.formUtility.formSelectImgUpload($editField.find('.uploadimg'),
                function(e, data) {
                    var imgPath = data.result.url.replace(/[\\]/g, '/'),
                        $this = $(e.target),
                        $currentField = $this.closest('.editpictureradio_item');
                    $this.siblings('.upload_btn').hide();
                    $currentField.find('.choicePicture').attr('src', imgPath).show().error(function() {
                        $(this).hide();
                        imgPath = '';
                        $this.siblings('.upload_btn').show();
                    });
                    var $imgF = $selectedCom.find('.pictureradio-item[listField="' + $currentField.attr('linenum') + '"]').find('.picradio_img');
                    if ($imgF.find('.picc_img').length === 0) {
                        $imgF.show().append('<img class="picc_img"/>');
                    }
                    selectItemList[$currentField.attr('linenum')].img = imgPath;
                    $imgF.find('.picc_img').attr('src',imgPath);
                });
        }

        function pigBind() {
            var tempListHTML = [];
            selectItemList = [];
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                radioName = $selectedCom.find('.picradio_contect input[type="radio"]').attr('name');
                // 显示编辑项目
                var $items = $selectedCom.find('.pictureradio-item').not('.empty');
                if ($items.length > 0) {
                    $items.each(function() {
                        var listNum = selectItemList.length,
                            tmpVal = $(this).attr('listField', listNum).find('.optionValue').text();

                        selectItemList.push({
                            img: $(this).find('.picc_img').attr('src') || '',
                            name: tmpVal
                        });
                        var $imgInfo = $(this).find('.picc_img'),
                            __img = '<img src="" alt="" class="choicePicture"><div class="upload_choiceimg"><input type="file" size="1" class="uploadimg" name="_FILE_"/><span class="upload_btn">上传图片<br/>(限2MB)</span>';
                        if ($imgInfo.length > 0) {
                            __img = '<img src="' + $imgInfo.attr('src') + '" alt="" class="choicePicture" style="display: inline;"><div class="upload_choiceimg"><input type="file" size="1" class="uploadimg" name="_FILE_"/><span class="upload_btn" style="display:none">上传图片<br/>(限2MB)</span>';
                        }
                        tempListHTML.push('<li class="editpictureradio_item" lineNum="' + listNum + '"><input class="editstatus" type="radio" name="picradio_' + $selectedCom.attr('id') + '" ' + ($(this).find('input:radio').attr('checked') == 'checked' ? 'checked="checked"': '') + '><div class="pictextcontect"><div class="imgcontect">' + __img + '</div></div><input type="text" class="imgedittext" value="' + tmpVal + '"><p class="removeButton"></p>');

                    });
                    tempListHTML[tempListHTML.length - 1] += '<p class="addButton"></p></div>';
                }

                tempListHTML = tempListHTML.join('</li>');

                $editField.find('.editpicradio_list').empty().append(tempListHTML);

                $selectedCom.unbind('getItemList').bind('getItemList',
                    function(event, list) {
                        list.dataInfo = selectItemList;
                    });
                _addLine();
                _editLine();
                _removeLine();
            }
        }
        return {
            bind: pigBind,
            getItemList: function() {
                return selectItemList;
            }
        };
    })(),

    //多图选项类型设置
    //多图选项类型设置
    'settingPicChooseType': (function() {
        // 这个是选择 选择组件的类型 多选 单选 下拉 互相切换
        // 记得选择完成以后调用重新渲染
        // 记得修改当前的组件的类型
        // 修改后再重新渲染
        var $editField = $('#form_edit_picselecttype'),
            $selectedCom,
            _typeMap = {
                'id_picturecheckbox': 'piceditsize_checkbox',
                'id_pictureradio': 'piceditsize_radio'
            },
            _map = {
                'id_picturecheckbox': 'checkbox',
                'id_pictureradio': 'radio'
            },
            _comMap = {
                'checkbox': 'id_picturecheckbox',
                'radio': 'id_pictureradio'
            };

        function generateHTML(type, id, obj) {
            var _r = '',
                m = 0;
            if (type === 'checkbox') {
                $.each(obj.dataInfo,
                    function(n, v) {
                        if (typeof(v) === 'undefined') return;
                        var _img = '<img class="picc_img" src="'+siteurl+'../images/holder.png">';
                        if (v.img) {
                            _img = '<img class="picc_img" src="' + decodeURIComponent(v.img) + '">';
                        }
                        _r += '<li class="picturecheckbox-item" listfield="' + n + '"><div class="piccheckbox_img i-pic" >' + _img + '</div><input type="checkbox" name="picturecheckbox' + id + '" value="' + n + '" disabled="disabled"><span class="optionValue" >' + v.name + '</span></li>';
                        m++;
                    });
                _r = '<ul class="pictureCheckboxList clearfix">' + _r + '</ul>';
            } else if (type === 'radio') {
                $.each(obj.dataInfo,
                    function(n, v) {
                        if (typeof(v) === 'undefined') return;
                        var _img = '<img class="picc_img" src="'+siteurl+'../images/holder.png">';
                        if (v.img) {
                            _img = '<img class="picc_img" src="' + decodeURIComponent(v.img) + '">';
                        }
                        _r += '<li class="pictureradio-item" listfield="' + n + '"><div class="picradio_img  i-pic" >' + _img + '</div><input type="radio" name="pictureradio' + id + '" value="' + n + '" disabled="disabled"><span class="optionValue">' + v.name + '</span></li>';
                        m++;
                    });
                _r = '<ul class="pictureRadioList clearfix">' + _r + '</ul>';
            }
            return _r;
        }

        function pigBind() {
            var currentType, currentId_Num;
            if (dlMain.currentComponent) {
                $selectedCom = $('#' + dlMain.currentComponent);
                currentId_Num = $selectedCom.attr('id').replace('com', '');
                currentType = _typeMap[$selectedCom.attr('name')];
                // show current state
                $editField.find('#' + currentType).prop('checked', true);

                $editField.find('input:radio').unbind('change').bind('change',
                    function() {
                        // ----
                        var selectedType = $(this).val(),
                            selectVal = {
                                'dataInfo': []
                            },
                            tmpHTML = '';
                        $selectedCom.trigger('getItemList', [selectVal]);

                        $selectedCom.find('.picture_' + _map[$selectedCom.attr('name')]).attr('class', 'picture_' + selectedType).html(generateHTML(selectedType, currentId_Num, selectVal));
                        $selectedCom.attr('name', _comMap[selectedType]);
                        renderFormComponent($selectedCom);
                    });
            }
        }

        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    'settingHoverDelete': (function() {
        var $hoverCom;
        function pigBind(id) {
            $hoverCom = $('#' + id);
            if ($hoverCom.find('.deleteButton').length < 1) {
                $('.deleteButton').each(function() {
                    if (!$(this).parent().hasClass('clicked')) {
                        $(this).remove();
                    }
                });
                $hoverCom.prepend('<div class="deleteButton"></div>');
                $hoverCom.find('.deleteButton').unbind('click').bind('click',
                    function() {
                        removeComponent();
                        function removeComponent() {
                            var $componentField = $('.formEditHd ul li').eq(1);
                            dlMain.currentComponent = '';
                            $hoverCom.remove();
                            // 只有当第3个的时候切回第二栏的组件选择
                            if ($('.formEditHd ul li.on ').index() === 2) {
                                $componentField.trigger('click');
                            }
                            renderFormComponent();
                        }
                    });
            }
        }
        return {
            bind: function(id) {
                pigBind(id);
            }
        };
    })(),
    'settingDeleteSelf': (function() {
        var $selectCom;
        function pigBind() {
            if (dlMain.currentComponent) {
                $selectCom = $('#' + dlMain.currentComponent);
                $('.deleteButton').remove();
                $selectCom.prepend('<div class="deleteButton"></div>');
                $selectCom.find('.deleteButton').unbind('click').bind('click',
                    function() {
                        removeComponent();
                        function removeComponent() {
                            var $componentField = $('.formEditHd ul li').eq(1);
                            dlMain.currentComponent = '';
                            $selectCom.remove();
                            // 只有当第3个的时候切回第二栏的组件选择
                            if ($('.formEditHd ul li.on').index() === 2) {
                                $componentField.trigger('click');
                            }
                            renderFormComponent();
                        }
                    });
            }
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
};
dlMain.serialCount = (function() {
    var count = 0;
    return {
        _getCount: function() {
            return count;
        },
        _setCount: function(newCount) {
            count = newCount;
        },
        _selfAdd: function() {
            count++;
        }
    };
})();
function serialSet() {
    var serialArray = [];
    // 获取所有会统计元素的 id 列表
    dlMain.formAnalysisList = [];
    // - 算出最大的一个值
    $(".ui-draggable").each(function() {
        var $this = $(this);
        if ($.inArray($this.attr('name'), ['id_checkbox', 'id_radio', 'id_code', 'id_number', 'id_pictureradio', 'id_fileupload', 'id_picturecheckbox', 'id_dropdown', 'id_city', 'id_picture', 'id_date', 'id_email', 'id_singleline', 'id_multiple', 'id_section', 'id_id','id_phone']) >= 0) {
            dlMain.formAnalysisList.push($this.attr("id"));
        }
        serialArray.push($this.attr("id").replace(/[^\d]/g, ''));
    });
    serialArray.sort(function(a, b) {
        return (a - b);
    });
    // 赋值最大值
    if (serialArray.length > 0) {
        dlMain.serialCount._setCount(serialArray[serialArray.length - 1]);
    }
}
function utilityDrag() {
    var htmlMap = {
        id_checkbox: function(name) {
            var options = '',
                count = 0,
                defaults = ["选项1", "选项2", "选项3", "选项4"];
            $.each(defaults,
                function(n) {
                    options += '<li class="optionsLine"><label><input type="checkbox" disabled="true" name="checkbox' + dlMain.serialCount._getCount() + '" value="' + count + '"><span class="optionValue">' + defaults[n] + '</span></label></li>';
                    count++;
                });
            return '<div class="activeFormMod checkBoxAndRadio checkboxMod"> <div class="formWrap"><div class="haederText"><h2><span class="title">' + name + '</span><i class="com_required"></i><i class="redTip">［请<b>至少</b>选择<s></s>项]</i></h2><p class="instruct">请填写简短描述文字</p></div><div class="modCell tl"><div class="checkbox"> <ul class="column-1 optionGarden clearfix">' + options + '</ul></div></div></div></div>';
        },
        id_dropdown: function(name) {
            var options = '',
                count = 0,
                defaults = ["选项1", "选项2", "选项3", "选项4"];
            $.each(defaults,
                function(n) {
                    options += '<option name="' + count + '">' + defaults[n] + '</option>';
                    count++;
                });
            return '<div class="activeFormMod selectMod"><div class="formWrap"><div class="haederText"><h2><span class="title">' + name + '</span><i class="com_required"></i></h2><p class="instruct">请填写简短描述文字</p></div><div class="modCell"><div class="select"><select disabled="true">' + options + '</select></div></div></div></div>';
        },
        id_multiple: function(name) {
            return '<div class="activeFormMod textMod"><div class="formWrap"><div class="haederText"><h2><span class="title">' + name + '</span><i class="com_required"></i></h2><p class="instruct">请填写简短描述文字</p></div><div class="modCell"><textarea  disabled="true"></textarea></div></div></div>';
        },
        id_number: function(name) {
            return this.id_singleline(name);
        },
        id_radio: function(name) {
            var options = '',
                count = 0,
                defaults = ["选项1", "选项2", "选项3", "选项4"];
            $.each(defaults,
                function(n) {
                    options += '<li class="optionsLine"><label><input type="radio" disabled="true" name="radio' + dlMain.serialCount._getCount() + '" value="' + count + '"><span class="optionValue">' + defaults[n] + '</span></label></li>';
                    count++;
                });
            return '<div class="activeFormMod checkBoxAndRadio radioMod"> <div class="formWrap"><div class="haederText"><h2><span class="title">' + name + '</span><i class="com_required"></i><i class="redTip">［请<b>至少</b>选择<s></s>项]</i></h2><p class="instruct">请填写简短描述文字</p></div><div class="modCell tl"><div class="radio"><ul class="column-1 optionGarden clearfix">' + options + '</ul></div></div></div></div>';
        },
        id_singleline: function(name) {
            return '<div class="activeFormMod textMod"><div class="formWrap"><div class="haederText"><h2><span class="title">' + name + '</span><i class="com_required"></i></h2><p class="instruct">请填写简短描述文字</p></div><div class="modCell"><input type="text"  disabled="true"></div></div></div>';
        },
        id_section: function(name) {
            var defaultSubtitle = "这里填写你的描述";
            return '<div class="activeFormMod sectionMod"><div class="formWrap"><div class="modCell"><h3 class="title title_field">' + name + '</h3><p class="instruct subtitle">' + defaultSubtitle + '</p></div></div></div>';
        },
        id_fileupload: function(name) {
            return '<div class="activeFormMod fileUploadMod"> <div class="formWrap"> <div class="haederText"> <h2><span class="title">' + name + '</span><i class="com_required"></i></h2> <p class="instruct">部分手机无法上传，请换个设备试试</p> </div> <div class="modCell"> <ul class="clearfix imgList"> <li> <img src="'+siteurl+'../images/midImg.png"> <i class="delete"></i> </li> <li> <img src="'+siteurl+'../images/midImg.png"> <i class="delete"></i> </li> <li> <img src="'+siteurl+'../images/midImg.png"> <i class="delete"></i> </li> <li> <img src="'+siteurl+'../images/midImg.png" > <i class="delete"></i> </li> </ul> <ul class="btn clearfix"> <li class="pr add"> <input type="file" accept="image" name="file" disabled="true" class="pa"> <a href="javascript:;"></a> </li> <li class="reduce"> <a href="javascript:;"></a> </li> <li class="cancel"> <a href="javascript:;">取消</a> </li> </ul> </div> </div> </div>';
        },
        id_date: function(name) {
            return '<div class="activeFormMod textMod"><div class="formWrap"><div class="haederText"><h2><span class="title">' + name + '</span><i class="com_required"></i></h2><p class="instruct">请填写简短描述文字</p></div><div class="modCell"><input type="text" class="date" datetype="d"  disabled="true"></div></div></div>';
        },
        id_picture: function(name) {
            var defaultSubtitle = "这里是" + name + ",写下你对它的描述";
            return '<div class="activeFormMod imgMod"> <div class="formWrap"> <div class="modCell"> <div class="i-pic title_field img_title"> <img src="'+siteurl+'../images/bigImg.png"><input type="file" class="in_pic_upload" name="_FILE_"> </div> <p class="instruct subtitle">' + defaultSubtitle + '</p> </div> </div> </div>';
        },
        id_picturecheckbox: function(name) {
            var options = '',
                count = 0,
                defaults = ["选项1", "选项2", "选项3", "选项4"];
            $.each(defaults,
                function(n) {
                    options += '<li class="picturecheckbox-item"> <div class="piccheckbox_img i-pic"> <img src="'+siteurl+'../images/holder.png" class="picc_img"> </div> <input type="checkbox" disabled="true" name="checkboxImg' + dlMain.serialCount._getCount() + '" value="' + count + '"><span class="optionValue">' + defaults[n] + '</span> </li>';
                    count++;
                });
            return '<div class="activeFormMod checkBoxAndRadio checkboxWithImgMod"> <div class="formWrap"> <div class="haederText"> <h2><span class="title">' + name + '</span><i class="com_required"></i><i class="redTip">［请<b>至少</b>选择<s></s>项]</i></h2> <p class="instruct">请填写简短描述文字</p> </div> <div class="modCell tc"><div class="picture_checkbox"> <ul class="clearfix pictureCheckboxList">' + options + '</ul> </div></div> </div> </div>';
        },
        id_pictureradio: function(name) {
            var options = '',
                count = 0,
                defaults = ["选项1", "选项2", "选项3", "选项4"];
            $.each(defaults,
                function(n) {
                    options += '<li class="pictureradio-item"> <div class="picradio_img i-pic"> <img src="'+siteurl+'../images/holder.png" class="picc_img"> </div> <input type="radio" disabled="true" name="radioImg' + dlMain.serialCount._getCount() + '" value="' + count + '"><span class="optionValue">' + defaults[n] + '</span></li>';
                    count++;
                });
            return '<div class="activeFormMod checkBoxAndRadio radioWithImgMod"> <div class="formWrap"> <div class="haederText"> <h2><span class="title">' + name + '</span><i class="com_required"></i><i class="redTip">［请<b>至少</b>选择<s></s>项]</i></h2> <p class="instruct">请填写简短描述文字</p> </div> <div class="modCell tc"><div class="picture_radio"> <ul class="clearfix pictureRadioList">' + options + '</ul> </div></div> </div> </div>';
        },
        id_code: function(name) {
            return '<div class="activeFormMod codeMod"> <div class="formWrap"> <div class="haederText"> <h2><span class="title">' + name + '</span></h2> <p class="instruct">请填写简短描述文字</p> </div> <div class="modCell"> <input type="text" class="minInput" disabled="true"><span class="code"><img src="'+siteurl+'../images/code.png"></span><a href="javascript:;" class="btn"></a> </div> </div> </div>';
        },
        id_city: function(name) {
            return this.id_singleline(name);
        },
        id_email: function(name) {
            return this.id_singleline(name);
        },
        id_id: function(name) {
            return this.id_singleline(name);
        },
        id_phone: function(name) {
            return this.id_singleline(name);
        }
    };

    function pigBind() {
        var formBuilder_edit = $('.formBuilder_edit'),
            formBuilder_edit_tooltip_timer;
        formBuilder_edit.off('mouseenter').on('mouseenter', '.ui-draggable',
            function(e) {
                var pageY = e.pageY + 10,
                    pageX = e.pageX + 10,
                    text = $(this).data('title');
                if (formBuilder_edit_tooltip_timer) {
                    clearTimeout(formBuilder_edit_tooltip_timer);
                    formBuilder_edit_tooltip_timer = null;
                }
                formBuilder_edit_tooltip_timer = setTimeout(function() {
                        $('#formBuilder_edit_tooltip').text(text).css({
                            'display': 'inline-block',
                            'top': pageY,
                            'left': pageX
                        });
                    },
                    100);
            });
        formBuilder_edit.off('mouseleave').on('mouseleave', '.ui-draggable',
            function(e) {
                if (formBuilder_edit_tooltip_timer) {
                    clearTimeout(formBuilder_edit_tooltip_timer);
                    formBuilder_edit_tooltip_timer = null;
                }
                $('#formBuilder_edit_tooltip').hide();
            });
        formBuilder_edit.find('.utility').unbind('click').bind('click',
            function() {
                $(".JSaddModBtn").parent().remove();
                var $componentContainer = $(".activeMod .form_component"),
                    utilityId = $(this).attr('id'),
                    utilityText = $(this).find('.title').text(),
                    componentHTML = htmlMap[utilityId](utilityText),
                    componentTitle = "点击进行修改,拖动交换位置,按住Ctrl拖动即可复制.";

                // add To last ...
                dlMain.serialCount._selfAdd();
                $(this).clone().html(componentHTML).appendTo($componentContainer).removeClass('utility').attr({
                    "id": "com" + dlMain.serialCount._getCount(),
                    "name": utilityId,
                    "title": componentTitle
                });

                formItemSortable();
                addOptionDrag();
                $('.mCustomScrollbar').mCustomScrollbar('scrollTo', 'bottom');
            }).draggable({
                appendTo: "body",
                helper: "clone",
                cancel: ".limit-disable",
                opacity: 0.8,
                revert: false,
                distance: 2,
                connectToSortable: $(".activeMod .form_component"),
                start: function(event, ui) {
                    $(".ui-draggable-dragging").css({
                        "height": "auto",
                        "float": "none",
                        "width": "170px"
                    }).attr("id", $(event.target).attr("id"));
                },
                drag: function(event, ui) {},
                stop: function(event, ui) {
                    $(".JSaddModBtn").parent().remove();
                    var utilityId = ui.helper.attr('id'),
                        utilityText = ui.helper.text(),
                        componentHTML = htmlMap[utilityId](utilityText),
                        $newComponent;
                    dlMain.serialCount._selfAdd();
                    $newComponent = $('.form_component').find('.utility');
                    $newComponent.html(componentHTML).removeClass('utility').attr({
                        "id": "com" + dlMain.serialCount._getCount(),
                        "name": utilityId,
                        "title": "点击进行修改,拖动交换位置,按住Ctrl拖动即可复制."
                    });
                    formItemSortable();
                    addOptionDrag();
                    $newComponent.trigger('click');
                }
            });
    }

    return {
        'addUtility': function(name, html) {
            htmlMap[name] = html;
        },
        getUtilityHTML: function(name, _title) {
            return htmlMap[name](_title);
        },
        bind: function() {
            return pigBind();
        }
    };
}
function formItemSortable() {
    // 对所有的表单中的元素增加sortable
    var $componentContainer = $(".activeMod .form_component");
    $componentContainer.find('.locked').attr({
        'class': 'ui-draggable',
        'title': '拖动交换位置,按住Ctrl拖动即可复制.'
    });
    var ctrlCopy = false,
        scrollFlag = true,
        utilTrue = utilityDrag(),
        tmpHTML = '';

    /**
     * ctrl 按下阻止右键菜单
     * */
    $componentContainer.on('contextmenu',
        function(e) {
            if (e.ctrlKey) {
                e.preventDefault();
            }
        });
    $componentContainer.sortable({
        items: ">li:not(.placeholder)",
        opacity: 0.8,
        //拖动时候的透明度
        axis: "y",
        cancel: ".locked",
        distance: 6,
        refreshPositions: true,
        start: function(event, ui) {
            var isClicked = false;
            //在拖动开始的时候判断是否按下了Ctrl
            if (event.ctrlKey) {
                // if (event.ctrlKey){
                if (ui.helper.find(".deleteButton").length) {
                    isClicked = true;
                    ui.helper.find(".deleteButton").remove();
                }
                dlMain.serialCount._selfAdd();
                var newComId = "com" + dlMain.serialCount._getCount();
                var currentComId = $(ui.item).attr('id');
                $(ui.item).attr("id", newComId);

                $("<li class='" + ui.helper.attr("class") + "' id=" + currentComId + " >" + ui.helper.html() + "</li>").attr({
                    "name": ui.helper.attr("name"),
                    "title": ui.helper.attr("title")
                }).insertAfter(ui.helper).removeClass("clicked");
                if (isClicked) {
                    ui.helper.prepend("<div class='deleteButton'></div>");
                }
                ctrlCopy = true;
            }

            if (ui.helper.hasClass('utility')) {
                tmpHTML = utilTrue.getUtilityHTML(ui.helper.attr('id'), ui.helper.find('.title').text());
                ui.placeholder.empty().append(tmpHTML).css({
                    'opacity': '0.4',
                    'visibility': 'visible'
                }).find('.deleteButton').remove();
            } else {
                ui.placeholder.empty().append(ui.helper.html()).css({
                    'opacity': '0.4',
                    'visibility': 'visible'
                }).find('.deleteButton').remove();
            }

        },
        sort: function(event, ui) {
            $(this).find(".placeholder").remove();
            ui.placeholder.css({
                'width': '100%'
            });
            $(".ui-sortable-helper").addClass('buildFormSort').css('width', '318px');
            if (ui.helper.hasClass('utility')) {
                ui.helper.css('width', '170px');
                ui.placeholder.empty().append(tmpHTML).css({
                    'opacity': '0.4',
                    'visibility': 'visible',
                    'height': 'auto',
                    'width': '318px'
                });
            } else {
                ui.placeholder.empty().append(ui.helper.html()).css({
                    'opacity': '0.4',
                    'visibility': 'visible'
                }).find('.deleteButton').remove();
            }
        },
        out: function(event, ui) {
            if (ui.helper) {
                ui.helper.css('width', '170px');
            }
        },
        over: function(event, ui) {
            ui.helper.css('width', '318px');
            if (ui.helper.hasClass('utility')) {
                ui.helper.css('width', '170px');
            }
        },
        update: function(event, ui) {
            $(this).find(".buildFormSort").removeClass('buildFormSort');
        },
        beforeStop: function(event, ui) {
            $(this).find(".buildFormSort").removeClass('buildFormSort');
        },
        stop: function() {
            if (ctrlCopy) {
                formItemSortable();
                addOptionDrag();
                dlMain.componentSetting.settingDeleteSelf.bind();
                ctrlCopy = false;
            }
        }
    }).find('.ui-draggable').unbind('click').bind('click',
        function() {
            // 编辑的开始
            var $editField = $('.formEditHd ul li').eq(2);
            renderFormComponent($(this));
            dlMain.componentSetting.settingDeleteSelf.bind();
            if (!$editField.hasClass('on')) {
                $editField.trigger('click');
            }
            //$(this).removeClass('unedited');
        }).unbind('mouseover').bind('mouseover',
        function() {
            var currentId = $(this).attr('id');
            dlMain.componentSetting.settingHoverDelete.bind(currentId);
        });
}
function addOptionDrag() {
    var $componentContainer = $(".activeMod .form_component");
    $componentContainer.find(".optionGarden").sortable({
        opacity: 0.8,
        //拖动时候的透明度
        //		axis: "y",
        stop: function(event, ui) {
            $(this).parents(".ui-draggable").trigger("click");
        }
    });
    $componentContainer.find(".pictureCheckboxList,.pictureRadioList").sortable({
        opacity: 0.8,
        //拖动时候的透明度
        //		axis: "y",
        start: function(event, ui) {},
        stop: function(event, ui) {
            var ul = $(this);
            ul.closest(".ui-draggable").trigger("click");
        }
    });
}
// 表单中的每一个组件绑定事件
function renderFormComponent($ui) {
    if ($ui) {
        var componentId = $ui.attr('id'),
            componentName = $ui.attr('name');
        if (dlMain.currentComponent !== componentId) {
            dlMain.currentComponent = componentId;
            dlMain.currentChanged = true;
        } else {
            dlMain.currentChanged = false;
        }
        dlMain.editManager(componentName);
        $.each(dlMain.editFunctionMap[componentName],
            function(key, val) {
                dlMain.componentSetting[val].bind();
            });
    } else {
        dlMain.editManager(false);
    }
}
dlMain.defaultColor = {
    bodybgcolor: 'fff',
    title1: {
        bgcolor: '2bce89',
        isshow: 'block',
        color: 'fff',
        fontsize:'16',
        align: 'left'
    },
    title2: {
        bgcolor: '2bce89',
        isshow: 'block',
        color: 'fff',
        fontsize: '16',
        align: 'left'
    },
    baseinfo: {
        bgcolor: 'd9f9eb',
        color: '333',
        fontsize: '12'
    },
    hdtit: {
        color: '666',
        fontsize: '16'
    },
    hddesc: {
        color: '9d9d9d',
        fontsize: '16'
    },
    optionvalue: {
        color: '333',
        fontsize: '12'
    },
    conbg: 'fff',
    footbtn: {
        color: 'fff',
        fontsize: '16',
        bgcolor: '3caf59'
    }
}
//用户修改的样式，如果为空则取原始样式
dlMain.styleOption={};

// todo 'custom_base'json变量在页面上打印的，当前文件没有这个变量

if(custom_base!= 'null'){
    dlMain.styleOption=JSON.parse(custom_base);
}else{
    dlMain.styleOption = {
        bodybgcolor: '',
        title1: {
            bgcolor: '',
            isshow: '',
            color: '',
            fontsize:'',
            align: ''
        },
        title2: {
            bgcolor: '',
            isshow: '',
            color: '',
            fontsize: '',
            align: ''
        },
        baseinfo: {
            bgcolor: '',
            color: '',
            fontsize: ''
        },
        hdtit: {
            color: '',
            fontsize: ''
        },
        hddesc: {
            color: '',
            fontsize: ''
        },
        optionvalue: {
            color: '',
            fontsize: ''
        },
        conbg: '',
        footbtn: {
            color: '',
            fontsize: '',
            bgcolor: ''
        }
    };
}

dlMain.formSetting = {
    // 集成了 渲染 、 事件绑定
    'formTitle': (function() {
        var $titleField = $('.formName_input');
        function pigBind() {
            var $formTitleField = $('#actName').find('h2');
            $titleField.val($formTitleField.text().replace(/&nbsp;/g, ' ')).unbind('input keyup').bind('input keyup',
                function() {
                    var currentVal = $(this).val();
                    $formTitleField.text(currentVal);
                    $formTitleField.html($formTitleField.html().replace(/\s/g, '&nbsp;'));
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    'formTel': (function() {
        var $telField = $('.formTel_input');
        function pigBind() {
            var $fromTelField = $('#fromTelAndPhone').find('em.f_tel');
            $telField.val($fromTelField.text().replace(/&nbsp;/g, ' ')).unbind('input keyup').bind('input keyup',
                function() {
                    var currentVal = $(this).val();
                    $fromTelField.text(currentVal);
                    $fromTelField.html($fromTelField.html().replace(/\s/g, '&nbsp;'));
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    'formPhone': (function() {
        var $telField = $('.formPhone_input');
        function pigBind() {
            var $fromTelField = $('#fromTelAndPhone').find('em.f_phone');
            $telField.val($fromTelField.text().replace(/&nbsp;/g, ' ')).unbind('input keyup').bind('input keyup',
                function() {
                    var currentVal = $(this).val();
                    $fromTelField.text(currentVal);
                    $fromTelField.html($fromTelField.html().replace(/\s/g, '&nbsp;'));
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    'formAddress': (function() {
        var $addressField = $('.formAddress_input');
        function pigBind() {
            var $fromAdressField = $('#formAddress').find('span');
            $addressField.val($fromAdressField.text().replace(/&nbsp;/g, ' ')).unbind('input keyup').bind('input keyup',
                function() {
                    var currentVal = $(this).val();
                    $fromAdressField.text(currentVal);
                    $fromAdressField.html($fromAdressField.html().replace(/\s/g, '&nbsp;'));
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    'formBriefing': (function() {
        var $briefingField = $('.formBriefing_input');
        function pigBind() {
            var $fromBriefingField = $('#formBriefing').find('span');
            $briefingField.val($fromBriefingField.text().replace(/&nbsp;/g, ' ')).unbind('input keyup').bind('input keyup',
                function() {
                    var currentVal = $(this).val();
                    $fromBriefingField.text(currentVal);
                    $fromBriefingField.html($fromBriefingField.html().replace(/\s/g, '&nbsp;'));
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    'formMoney': (function() {
        var $moneyField = $('.formMoney_input');
        function pigBind() {
            var $fromMoneyField = $('#formMoney').find('span em');
            $moneyField.val($fromMoneyField.text().replace(/&nbsp;/g, ' ')).unbind('input keyup').bind('input keyup',
                function() {
                    var currentVal = $(this).val();
                    $fromMoneyField.text(currentVal);
                    $fromMoneyField.html($fromMoneyField.html().replace(/\s/g, '&nbsp;'));
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    'baseTitle1': (function() {
        var $titleField = $('.title1Input');
        function pigBind() {
            var $formTitleField = $('.BigTit1').find('h2');
            $titleField.val($formTitleField.text().replace(/&nbsp;/g, ' ')).unbind('input keyup').bind('input keyup',
                function() {
                    var currentVal = $(this).val();
                    $formTitleField.text(currentVal);
                    $formTitleField.html($formTitleField.html().replace(/\s/g, '&nbsp;'));
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    'baseTitle2': (function() {
        var $titleField = $('.title2Input');
        function pigBind() {
            var $formTitleField = $('.BigTit2').find('h2');
            $titleField.val($formTitleField.text().replace(/&nbsp;/g, ' ')).unbind('input keyup').bind('input keyup',
                function() {
                    var currentVal = $(this).val();
                    $formTitleField.text(currentVal);
                    $formTitleField.html($formTitleField.html().replace(/\s/g, '&nbsp;'));
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    'baseFootBtn': (function() {
        var $titleField = $('.footBtnInput');
        function pigBind() {
            var $formTitleField = $('.footBtn').find('button');
            $titleField.val($formTitleField.text().replace(/&nbsp;/g, ' ')).unbind('input keyup').bind('input keyup',
                function() {
                    var currentVal = $(this).val();
                    $formTitleField.text(currentVal);
                    $formTitleField.html($formTitleField.html().replace(/\s/g, '&nbsp;'));
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
    'formCustomScheme': (function() {
        var _handle = {
            colorBind: function(hsb, hex, rgb, el) {
                var $el = $(el),
                    tagObg = $el.attr("data");
                $el.css('background', '#' + hex);
                if (tagObg == 'bodyBgColor') {
                    dlMain.styleOption.bodybgcolor = hex;
                } else if (tagObg == 'title1BgColor') {
                    dlMain.styleOption.title1.bgcolor = hex;
                } else if (tagObg == 'title1FontColor') {
                    dlMain.styleOption.title1.color = hex;
                } else if (tagObg == 'title2BgColor') {
                    dlMain.styleOption.title2.bgcolor = hex;
                } else if (tagObg == 'title2FontColor') {
                    dlMain.styleOption.title2.color = hex;
                }else if (tagObg == 'baseInfoFontColor') {
                    dlMain.styleOption.baseinfo.color = hex;
                }else if (tagObg == 'baseInfoBgColor') {
                    dlMain.styleOption.baseinfo.bgcolor = hex;
                }else if (tagObg == 'componentTitColor') {
                    dlMain.styleOption.hdtit.color = hex;
                }else if (tagObg == 'componentDescColor') {
                    dlMain.styleOption.hddesc.color = hex;
                }else if (tagObg == 'optionsFontColor') {
                    dlMain.styleOption.optionvalue.color = hex;
                }else if (tagObg == 'componentBgColor') {
                    dlMain.styleOption.conbg = hex;
                }else if (tagObg == 'btnFontColor') {
                    dlMain.styleOption.footbtn.color = hex;
                }else if (tagObg == 'btnBgColor') {
                    dlMain.styleOption.footbtn.bgcolor = hex;
                }

                dlMain.formUtility.formSchemeCSSGenerator();
            },
            //这里是集中处理带颜色设置的选项
            defaultInput:function() {
                $(".defaultInput").on('ifChecked',
                    function() {
                        $(this).parents('.cssRadio').find(".colorRect").css("display", 'none');
                        $(".colpick").hide();
                    });
                $(".customInput").on('ifChecked',
                    function() {
                        $(this).parents('.cssRadio').find(".colorRect").css("display", 'inline-block');
                    });
            },
            //显示隐藏切换控制
            isShowCtrl:function(){
                $(".title_show").on('ifChecked',
                    function() {
                        if($(this).attr('name')=='title1'){
                            dlMain.styleOption.title1.isshow='block';
                        }else if($(this).attr('name')=='title2'){
                            dlMain.styleOption.title2.isshow='block';
                        }
                        dlMain.formUtility.formSchemeCSSGenerator();
                    });
                $(".title_hide").on('ifChecked',
                    function() {
                        if($(this).attr('name')=='title1'){
                            dlMain.styleOption.title1.isshow='none';
                        }else if($(this).attr('name')=='title2'){
                            dlMain.styleOption.title2.isshow='none';
                        }
                        dlMain.formUtility.formSchemeCSSGenerator();
                    });

            },


            //颜色设置按钮状态初始化
            colorInit:function(){
                //初始化背景色，背景色设置选项
                if(!dlMain.styleOption.bodybgcolor==''){
                    $("#bodyBgColor_d").removeAttr('checked');
                    $("#bodyBgColor_c").prop('checked',true);
                    $("#bodyBgColor_d").parents(".cssRadio").find(".colorRect").css("display",'inline-block').css("background","#"+dlMain.styleOption.bodybgcolor);
                }else{
                    $("#bodyBgColor_c").removeAttr('checked');
                    $("#bodyBgColor_d").prop('checked',true);
                    $("#bodyBgColor_d").parents(".cssRadio").find(".colorRect").css("display",'none')
                }
                //初始化标题1背景色
                if(!dlMain.styleOption.title1.bgcolor==''){
                    $("#title1BgColor_d").removeAttr('checked');
                    $("#title1BgColor_c").prop('checked',true);
                    $("#title1BgColor_d").parents(".cssRadio").find(".colorRect").css("display",'inline-block').css("background","#"+dlMain.styleOption.title1.bgcolor);
                }else{
                    $("#title1BgColor_c").removeAttr('checked');
                    $("#title1BgColor_d").prop('checked',true);
                    $("#title1BgColor_d").parents(".cssRadio").find(".colorRect").css("display",'none')
                }
                //初始化标题1文字颜色
                if(!dlMain.styleOption.title1.color==''){
                    $("#title1FontColor_d").removeAttr('checked');
                    $("#title1FontColor_c").prop('checked',true);
                    $("#title1FontColor_d").parents(".minCell").find(".colorRect").css("display",'inline-block').css("background","#"+dlMain.styleOption.title1.color);
                }else{
                    $("#title1FontColor_c").removeAttr('checked');
                    $("#title1FontColor_d").prop('checked',true);
                    $("#title1FontColor_d").parents(".minCell").find(".colorRect").css("display",'none')
                }
                //初始化标题2背景色
                if(!dlMain.styleOption.title2.bgcolor==''){
                    $("#title2BgColor_d").removeAttr('checked');
                    $("#title2BgColor_c").prop('checked',true);
                    $("#title2BgColor_d").parents(".cssRadio").find(".colorRect").css("display",'inline-block').css("background","#"+dlMain.styleOption.title2.bgcolor);
                }else{
                    $("#title2BgColor_c").removeAttr('checked');
                    $("#title2BgColor_d").prop('checked',true);
                    $("#title2BgColor_d").parents(".cssRadio").find(".colorRect").css("display",'none')
                }
                //初始化标题2文字颜色
                if(!dlMain.styleOption.title2.color==''){
                    $("#title2FontColor_d").removeAttr('checked');
                    $("#title2FontColor_c").prop('checked',true);
                    $("#title2FontColor_d").parents(".minCell").find(".colorRect").css("display",'inline-block').css("background","#"+dlMain.styleOption.title2.color);
                }else{
                    $("#title2FontColor_c").removeAttr('checked');
                    $("#title2FontColor_d").prop('checked',true);
                    $("#title2FontColor_d").parents(".minCell").find(".colorRect").css("display",'none')
                }

                //初始化基础信息文字颜色
                if(!dlMain.styleOption.baseinfo.color==''){
                    $("#baseInfoFontColor_d").removeAttr('checked');
                    $("#baseInfoFontColor_c").prop('checked',true);
                    $("#baseInfoFontColor_d").parents(".minCell").find(".colorRect").css("display",'inline-block').css("background","#"+dlMain.styleOption.baseinfo.color);
                }else{
                    $("#baseInfoFontColor_c").removeAttr('checked');
                    $("#baseInfoFontColor_d").prop('checked',true);
                    $("#baseInfoFontColor_d").parents(".minCell").find(".colorRect").css("display",'none')
                }

                //初始化基础信息背景
                if(!dlMain.styleOption.baseinfo.bgcolor==''){
                    $("#baseInfoBgColor_d").removeAttr('checked');
                    $("#baseInfoBgColor_c").prop('checked',true);
                    $("#baseInfoBgColor_d").parents(".minCell").find(".colorRect").css("display",'inline-block').css("background",dlMain.styleOption.baseinfo.bgcolor);
                }else{
                    $("#baseInfoBgColor_c").removeAttr('checked');
                    $("#baseInfoBgColor_d").prop('checked',true);
                    $("#baseInfoBgColor_d").parents(".minCell").find(".colorRect").css("display",'none')
                }


                //初始化组件——标题颜色
                if(!dlMain.styleOption.hdtit.color==''){
                    $("#componentTitColor_d").removeAttr('checked');
                    $("#componentTitColor_c").prop('checked',true);
                    $("#componentTitColor_d").parents(".minCell").find(".colorRect").css("display",'inline-block').css("background","#"+dlMain.styleOption.hdtit.color);
                }else{
                    $("#componentTitColor_c").removeAttr('checked');
                    $("#componentTitColor_d").prop('checked',true);
                    $("#componentTitColor_d").parents(".minCell").find(".colorRect").css("display",'none')
                }

                //初始化组件——描述颜色
                if(!dlMain.styleOption.hddesc.color==''){
                    $("#componentDescColor_d").removeAttr('checked');
                    $("#componentDescColor_c").prop('checked',true);
                    $("#componentDescColor_d").parents(".minCell").find(".colorRect").css("display",'inline-block').css("background","#"+dlMain.styleOption.hddesc.color);
                }else{
                    $("#componentDescColor_c").removeAttr('checked');
                    $("#componentDescColor_d").prop('checked',true);
                    $("#componentDescColor_d").parents(".minCell").find(".colorRect").css("display",'none')
                }

                //初始化组件——选项颜色
                if(!dlMain.styleOption.optionvalue.color==''){
                    $("#optionsFontColor_d").removeAttr('checked');
                    $("#optionsFontColor_c").prop('checked',true);
                    $("#optionsFontColor_d").parents(".minCell").find(".colorRect").css("display",'inline-block').css("background","#"+dlMain.styleOption.optionvalue.color);
                }else{
                    $("#optionsFontColor_c").removeAttr('checked');
                    $("#optionsFontColor_d").prop('checked',true);
                    $("#optionsFontColor_d").parents(".minCell").find(".colorRect").css("display",'none')
                }

                //初始化组件——背景色
                if(!dlMain.styleOption.conbg==''){
                    $("#componentBgColor_d").removeAttr('checked');
                    $("#componentBgColor_c").prop('checked',true);
                    $("#componentBgColor_d").parents(".minCell").find(".colorRect").css("display",'inline-block').css("background","#"+dlMain.styleOption.conbg);
                }else{
                    $("#componentBgColor_c").removeAttr('checked');
                    $("#componentBgColor_d").prop('checked',true);
                    $("#componentBgColor_d").parents(".minCell").find(".colorRect").css("display",'none')
                }
                //初始化底部按钮——文本颜色
                if(!dlMain.styleOption.footbtn.color==''){
                    $("#btnFontColor_d").removeAttr('checked');
                    $("#btnFontColor_c").prop('checked',true);
                    $("#btnFontColor_d").parents(".minCell").find(".colorRect").css("display",'inline-block').css("background","#"+dlMain.styleOption.footbtn.color);
                }else{
                    $("#btnFontColor_c").removeAttr('checked');
                    $("#btnFontColor_d").prop('checked',true);
                    $("#btnFontColor_d").parents(".minCell").find(".colorRect").css("display",'none')
                }
                //初始化底部按钮——文本颜色
                if(!dlMain.styleOption.footbtn.bgcolor==''){
                    $("#btnBgColor_d").removeAttr('checked');
                    $("#btnBgColor_c").prop('checked',true);
                    $("#btnBgColor_d").parents(".minCell").find(".colorRect").css("display",'inline-block').css("background","#"+dlMain.styleOption.footbtn.bgcolor);
                }else{
                    $("#btnBgColor_c").removeAttr('checked');
                    $("#btnBgColor_d").prop('checked',true);
                    $("#btnBgColor_d").parents(".minCell").find(".colorRect").css("display",'none')
                }
            },
            //显示隐藏初始化
            isShowInit:function(){
                if(dlMain.styleOption.title1.isshow=='none'){
                    $("#title1_show").removeAttr('checked');
                    $("#title1_hide").prop('checked',true);
                    $("#title1_hide").parents(".cssRadio").find(".colorRect").css("display",'inline-block')
                }else{
                    $("#title1_hide").removeAttr('checked');
                    $("#title1_show").prop('checked',true);
                    $("#title1_show").parents(".cssRadio").find(".colorRect").css("display",'none')
                }
                if(dlMain.styleOption.title2.isshow=='none'){
                    $("#title2_show").removeAttr('checked');
                    $("#title2_hide").prop('checked',true);
                    $("#title2_hide").parents(".cssRadio").find(".colorRect").css("display",'inline-block')
                }else{
                    $("#title2_hide").removeAttr('checked');
                    $("#title2_show").prop('checked',true);
                    $("#title2_show").parents(".cssRadio").find(".colorRect").css("display",'none')
                }

            },
            //默认颜色按钮点击，实现重置样式
            colorDefault:function(){
                $(".defaultInput").on("ifChecked",function(){
                    if($(this).attr('name')=='bodyBgColor'){
                        dlMain.styleOption.bodybgcolor=dlMain.defaultColor.bodybgcolor;
                    }else if($(this).attr('name')=='title1BgColor'){
                        dlMain.styleOption.title1.bgcolor=dlMain.defaultColor.title1.bgcolor;
                    }else if($(this).attr('name')=='title1FontColor'){
                        dlMain.styleOption.title1.color=dlMain.defaultColor.title1.color;
                    }else if($(this).attr('name')=='title2BgColor'){
                        dlMain.styleOption.title2.bgcolor=dlMain.defaultColor.title2.bgcolor;
                    }else if($(this).attr('name')=='title2FontColor'){
                        dlMain.styleOption.title2.color=dlMain.defaultColor.title2.color;
                    }else if($(this).attr('name')=='baseInfoFontColor'){
                        dlMain.styleOption.baseinfo.color=dlMain.defaultColor.baseinfo.color;
                    }else if($(this).attr('name')=='baseInfoBgColor'){
                        dlMain.styleOption.baseinfo.bgcolor=dlMain.defaultColor.baseinfo.bgcolor;
                    }else if($(this).attr('name')=='componentTitColor'){
                        dlMain.styleOption.hdtit.color=dlMain.defaultColor.hdtit.color;
                    }else if($(this).attr('name')=='componentDescColor'){
                        dlMain.styleOption.hddesc.color=dlMain.defaultColor.hddesc.color;
                    }else if($(this).attr('name')=='optionsFontColor'){
                        dlMain.styleOption.optionvalue.color=dlMain.defaultColor.optionvalue.color;
                    }else if($(this).attr('name')=='componentBgColor'){
                        dlMain.styleOption.conbg=dlMain.defaultColor.conbg;
                    }else if($(this).attr('name')=='btnFontColor'){
                        dlMain.styleOption.footbtn.color=dlMain.defaultColor.footbtn.color;
                    }else if($(this).attr('name')=='btnBgColor'){
                        dlMain.styleOption.footbtn.bgcolor=dlMain.defaultColor.footbtn.bgcolor;
                    }

                    dlMain.formUtility.formSchemeCSSGenerator();

                });
            },
            titTextAlign:function(){
                $(".titTextAlign").each(function(){
                    var $that=$(this);
                    $that.on("ifChecked",function(){
                        if($(this).attr('name')=='title1TextAlign'){
                            var v=$(this).val();
                            dlMain.styleOption.title1.align=v;
                        }else if($(this).attr('name')=='title2TextAlign'){
                            var v=$(this).val();
                            dlMain.styleOption.title2.align=v;
                        }
                        dlMain.formUtility.formSchemeCSSGenerator();
                    });
                })
                var tit1AlginVal='',tit2AlginVal='';
                //$(".titTextAlign").removeAttr("checked");
                tit1AlginVal =$(".BigTit1 h2").css('text-align');
                tit2AlginVal =$(".BigTit2 h2").css('text-align');
                $("#title1TextAlign_"+tit1AlginVal).prop('checked',true);
                $("#title2TextAlign_"+tit2AlginVal).prop('checked',true);
            },
            sliderRange: function(){
                var title1size=parseInt($('.BigTit1 h2').css('font-size'));
                $(".slider-range-title1" ).slider({
                    range: "min",
                    value: title1size,
                    min: 12,
                    max: 48,
                    slide: function( event, ui ) {
                        $(this).next().text( ui.value+"px" );
                        dlMain.styleOption.title1.fontsize=ui.value;
                        dlMain.formUtility.formSchemeCSSGenerator();
                    }
                });
                $( ".rangeCell-title1 .amount" ).text( $(".slider-range-title1" ).slider( "value" )+"px" );
                var title2size=parseInt($('.BigTit2 h2').css('font-size'));
                $(".slider-range-title2" ).slider({
                    range: "min",
                    value: title2size,
                    min: 12,
                    max: 48,
                    slide: function( event, ui ) {
                        $(this).next().text( ui.value+"px" );
                        dlMain.styleOption.title2.fontsize=ui.value;
                        dlMain.formUtility.formSchemeCSSGenerator();
                    }
                });

                $( ".rangeCell-title2 .amount" ).text( $(".slider-range-title2" ).slider( "value" )+"px" );

                var baseInfoFont=parseInt($('.baseInfo .row .descText span').css('font-size'));
                $(".slider-range-baseInfoFont" ).slider({
                    range: "min",
                    value: baseInfoFont,
                    min: 12,
                    max: 48,
                    slide: function( event, ui ) {
                        $(this).next().text( ui.value+"px" );
                        dlMain.styleOption.baseinfo.fontsize=ui.value;
                        dlMain.formUtility.formSchemeCSSGenerator();
                    }
                });
                $( ".rangeCell-baseInfoFont .amount" ).text( $(".slider-range-baseInfoFont" ).slider( "value" )+"px" );


                var componentTitSize;
                if(!dlMain.styleOption.hdtit.fontsize==''){
                    componentTitSize=dlMain.styleOption.hdtit.fontsize;
                }else{
                    componentTitSize=dlMain.defaultColor.hdtit.fontsize;
                }
                $(".slider-range-componentTitSize" ).slider({
                    range: "min",
                    value: componentTitSize,
                    min: 12,
                    max: 48,
                    slide: function( event, ui ) {
                        $(this).next().text( ui.value+"px" );
                        dlMain.styleOption.hdtit.fontsize=ui.value;
                        dlMain.formUtility.formSchemeCSSGenerator();
                    }
                });
                $( ".rangeCell-componentTitSize .amount" ).text( $(".slider-range-componentTitSize" ).slider( "value" )+"px" );


                var componentDescSize;
                if(!dlMain.styleOption.hddesc.fontsize==''){
                    componentDescSize=dlMain.styleOption.hddesc.fontsize;
                }else{
                    componentDescSize=dlMain.defaultColor.hddesc.fontsize;
                }

                $(".slider-range-componentDescSize" ).slider({
                    range: "min",
                    value: componentDescSize,
                    min: 12,
                    max: 48,
                    slide: function( event, ui ) {
                        $(this).next().text( ui.value+"px" );
                        dlMain.styleOption.hddesc.fontsize=ui.value;
                        dlMain.formUtility.formSchemeCSSGenerator();
                    }
                });
                $( ".rangeCell-componentDescSize .amount" ).text( $(".slider-range-componentDescSize" ).slider( "value" )+"px" );


                var optionsSize=parseInt($('.optionValue').css('font-size'));
                if(!dlMain.styleOption.optionvalue.fontsize==''){
                    optionsSize=dlMain.styleOption.optionvalue.fontsize;
                }else{
                    optionsSize=dlMain.defaultColor.optionvalue.fontsize;
                }

                $(".slider-range-optionsSize" ).slider({
                    range: "min",
                    value:optionsSize,
                    min: 12,
                    max: 48,
                    slide: function( event, ui ) {
                        $(this).next().text( ui.value+"px" );
                        dlMain.styleOption.optionvalue.fontsize=ui.value;
                        dlMain.formUtility.formSchemeCSSGenerator();
                    }
                });
                $( ".rangeCell-optionsSize .amount" ).text( $(".slider-range-optionsSize" ).slider( "value" )+"px" );

                var btnSize=parseInt($('.footBtn button').css('font-size'));
                $(".slider-range-btnSize").slider({
                    range: "min",
                    value: btnSize,
                    min: 12,
                    max: 48,
                    slide: function( event, ui ) {
                        $(this).next().text( ui.value+"px" );
                        dlMain.styleOption.footbtn.fontsize=ui.value;
                        dlMain.formUtility.formSchemeCSSGenerator();
                    }
                });
                $( ".rangeCell-btnSize .amount" ).text( $(".slider-range-btnSize" ).slider( "value" )+"px" );
            }

        };
        function pigBind() {
            _handle.colorInit();
            _handle.isShowInit();
            _handle.isShowCtrl();
            _handle.defaultInput();//默认和自定义设置切换
            //色值选择
            var $styleDesign = $('#form_baseEdit'),
                colorRect = $styleDesign.find('.colorRect');
            dlMain.formUtility.formColorPicker(colorRect, _handle.colorBind);
            dlMain.formUtility.formSchemeCSSGenerator();

            //默认颜色和初始化状态
            _handle.colorDefault();
            _handle.titTextAlign();

            _handle.sliderRange();


        }

        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
}
dlMain.formUtility = {
    formImgUpload: function($ui, uploadCallback, pCom) {
     //    $ui.fileupload({
     //        dataType: "json",
     //        pasteZone: null,
     //        url: uploadurl,
     //        drop: function(e) {
     //            return false;
     //        },
     //        add: function(e, data) {
     //            var flag = false,
     //                that = (typeof(pCom) == 'object' ? pCom: $(this).siblings('p'));

     //            if (data.files[0].size) {
     //                if (data.files[0].size < 2000000) {
     //                    $(this).attr('hasFile', true);
     //                    that.text(data.files[0].name).css("color", "#333333");
     //                    flag = true;
     //                } else {
					// 	alert('请上传小于2M的图片…');
     //                    that.text('请上传小于2M的图片…').css('color', '#B94A48');
     //                }
     //            } else {
     //                $(this).attr('hasFile', true);
     //                that.text(data.files[0].name).css("color", "#333333");
     //                flag = true;
     //            }
     //            if (flag) {
     //                data.submit();
     //            }
     //        },
     //        start: function(e, data) { (typeof(pCom) == 'object' ? pCom: $(this).siblings('p')).text('开始上传……');
     //        },
     //        progressall: function(e, data) {
     //            var progress = parseInt(data.loaded / data.total * 90, 10),
     //                that = (typeof(pCom) == 'object' ? pCom: $(this).siblings('p'));
     //            that.css('color', '#333').text('正在上传……' + progress + '%').siblings('.progress').css('width', progress * 0.9 + '%');
     //        },
     //        done: function(e, data) {
     //            // var uploadFlag = data.result.data.flag;
     //            var uploadFlag = data.result.status,
     //                that = (typeof(pCom) == 'object' ? pCom: $(this).siblings('p'));
     //            if (uploadFlag=='success') {
     //                that.css('color', '#333').text(data.files[0].name).siblings('.progress').css('width', '90%');
     //                uploadCallback(e, data);
     //            } else {
					// alert('文件超过大小，上传失败。');
     //                that.css('color', '#333').text('文件超过大小，上传失败。').siblings('.progress').css('width', '90%');
     //                $('.validate_submit').removeAttr('style').text('提交');
     //            }
     //            $(this).siblings('.progress').fadeOut();
     //        }
     //    });
    },
    formSelectImgUpload: function($ui, uploadCallback) {
     //    $ui.fileupload({
     //        dataType: "json",
     //        pasteZone: null,
     //        url: uploadurl,
     //        drop: function(e) {
     //            return false;
     //        },
     //        add: function(e, data) {
     //            var flag = false;
     //            if (data.files[0].size) {
     //                if (data.files[0].size < 1000000) {
     //                    $(this).attr('hasFile', true);
     //                    flag = true;
     //                } else {
					// 	alert('文件太大，请添加小于1M图片。')
     //                    $(this).siblings('.upload_btn').html('文件太大<br/>(限1MB)').show();
     //                }
     //            } else {
     //                $(this).attr('hasFile', true);
     //                flag = true;
     //            }
     //            if (flag) {
     //                data.submit();
     //            }
     //        },
     //        start: function(e, data) {
     //            $(this).siblings('.upload_btn').html('开始上传<br/>(限1MB)').show();
     //        },
     //        progressall: function(e, data) {
     //            var progress = parseInt(data.loaded / data.total * 90, 10);
     //            $(this).siblings('.upload_btn').text('' + progress + '%...');
     //        },
     //        done: function(e, data) {
     //            var uploadFlag = data.result.status;
     //            if (uploadFlag=='success') {
     //                $(this).siblings('.upload_btn').html('上传成功<br/>(限1MB)').show();

     //                uploadCallback(e, data);

     //            } else {
					// alert('上传失败，请重新上传。')
     //                $(this).siblings('.upload_btn').html('上传失败<br/>(限1MB)').show();
     //            }
     //        }
     //    });
    },
    HtmlString: function(s) {
        var TAG_A_REG = /<[aA][^>]*link-save="([^"]*)"[^>]*>([^<>]*)<['img''IMG'][^>]*src="images\/icon\/externalLink.png"[^>]*><\/[aA]>/g;
        return s.replace(TAG_A_REG,
            function($, $1, $2) {
                return '[' + $2 + '](' + decodeURIComponent($1) + ')';
            });
    },
    getCurrentCursorPosition: function($ui) {
        var el = $ui.get(0);
        var pos = 0;
        if ('selectionStart' in el) {
            pos = el.selectionStart;
        } else if ('selection' in document) {
            el.focus();
            var Sel = document.selection.createRange();
            var SelLength = document.selection.createRange().text.length;
            Sel.moveStart('character', -el.value.length);
            pos = Sel.text.length - SelLength;
        }
        return pos;
    },
    formSchemeCSSGenerator: function() {
        function __addCss(name, content) {
            var styleElem = document.getElementsByTagName('style');
            for (var i = 0,
                     len = styleElem.length; i < len; i++) {
                if (styleElem[i]) {
                    if (name === styleElem[i].id) {
                        styleElem[i].parentNode.removeChild(styleElem[i]);
                    }
                }
            }
            $('<style id="' + name + '">' + content + '</style>').appendTo('body');
        }
        var cssInfo = '';
        $(document).queue('generateCSSQ',
            function() {
                //如果有哪一条为空则去原始样式去取
                $.each(dlMain.styleOption,function(i){
                    if(dlMain.styleOption[i]==''){
                        dlMain.styleOption[i]=dlMain.defaultColor[i]
                    }
                        $.each(this,function(j)
                        {
                            if(dlMain.styleOption[i][j]==''){
                                dlMain.styleOption[i][j]=dlMain.defaultColor[i][j]
                            }
                        });
                });
                cssInfo = '#anythingContent .mianMod{background: #' + dlMain.styleOption.bodybgcolor + '}' + '#anythingContent .regularMod .BigTit1{background: #' + dlMain.styleOption.title1.bgcolor + ';display: ' + dlMain.styleOption.title1.isshow + '}' + '#anythingContent .regularMod .BigTit1 h2{color: #' + dlMain.styleOption.title1.color + ';font-size: ' + dlMain.styleOption.title1.fontsize + 'px;text-align: ' + dlMain.styleOption.title1.align + '}' + '#anythingContent .regularMod .BigTit2{background: #' + dlMain.styleOption.title2.bgcolor + ';display: ' + dlMain.styleOption.title2.isshow + '}' + '#anythingContent .regularMod .BigTit2 h2{color: #' + dlMain.styleOption.title2.color + ';font-size: ' + dlMain.styleOption.title2.fontsize + 'px;text-align: ' + dlMain.styleOption.title2.align + '}' + '#anythingContent .regularMod .baseInfo{background: #' + dlMain.styleOption.baseinfo.bgcolor + '}' + '#anythingContent .regularMod .baseInfo .row .descText span{font-size: ' + dlMain.styleOption.baseinfo.fontsize + 'px;color: #' + dlMain.styleOption.baseinfo.color + '}' + '#anythingContent .haederText h2 .title,#anythingContent .sectionMod h3{font-size: ' + dlMain.styleOption.hdtit.fontsize + 'px;color: #' + dlMain.styleOption.hdtit.color + '}' + '#anythingContent .optionValue{font-size: ' + dlMain.styleOption.optionvalue.fontsize + 'px;color: #' + dlMain.styleOption.optionvalue.color + '}' + '#anythingContent .haederText p,#anythingContent .sectionMod p,#anythingContent .imgMod p{font-size: ' + dlMain.styleOption.hddesc.fontsize + 'px;color: #' + dlMain.styleOption.hddesc.color + '}' + '#anythingContent .form_component>li{background: #' + dlMain.styleOption.conbg + '}' + '#anythingContent .footBtn button{font-size: ' + dlMain.styleOption.footbtn.fontsize + 'px;color: #' + dlMain.styleOption.footbtn.color + ';background: #' + dlMain.styleOption.footbtn.bgcolor + '}';
                __addCss('form_style_scheme', cssInfo);
            });
        $(document).dequeue('generateCSSQ');
    },
    formColorPicker: function($ui, changeCallback) {
        $ui.colpick({
            layout: 'hex',
            submit: 0,
            onChange: changeCallback
        });
    },
}
dlMain.showAndHide = {
    //todo 集成了一些选项设置显示隐藏功能
    "isPay": (function() {
        var shows = $("#isPay-show");
        var hides = $("#isPay-hide");
        var isPay = $(".isPay");
        $("#formMoney").hide();
        function pigBind() {
            shows.on('ifChecked',
                function(event) {
                    isPay.removeClass("hide");
                    $("#formMoney").show();
                });
            hides.on('ifChecked',
                function(event) {
                    isPay.addClass("hide");
                    $("#formMoney").hide();
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };

    })(),
    "isTerm": (function() {
        var shows = $("#term-short");
        var hides = $("#term-permanent");
        function pigBind() {
            shows.on('ifChecked',
                function(event) {
                    $(".set-expiryDate").removeClass("hide");
                });
            hides.on('ifChecked',
                function(event) {
                    $(".set-expiryDate").addClass("hide");
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };

    })(),
    "allNotice": (function() {
        var obj = $("#allNotiSet");
        function pigBind() {
            obj.on('ifChecked',
                function(event) {
                    $(".allNotice").removeClass("hide");
                });
            obj.on('ifUnchecked',
                function(event) {
                    $(".allNotice").addClass("hide");
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };

    })(),
    "emailNotice": (function() {
        var obj = $("#emailNotiSet");
        function pigBind() {
            obj.on('ifChecked',
                function(event) {
                    $(".noticeSet-email").removeClass("hide");
                });
            obj.on('ifUnchecked',
                function(event) {
                    $(".noticeSet-email").addClass("hide");
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };

    })(),
    "textlNotice": (function() {
        var obj = $("#textNotiSet");
        function pigBind() {
            obj.on('ifChecked',
                function(event) {
                    $(".noticeSet-text").removeClass("hide");
                });
            obj.on('ifUnchecked',
                function(event) {
                    $(".noticeSet-text").addClass("hide");
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };

    })(),

}
dlMain.fnClick = {
    'form_component_Click': (function() {
        var obj = $(".form_component");
        function pigBind() {
            obj.on("click", ".ui-draggable",
                function() {
                    $(".clicked").removeClass("clicked");
                    $(this).addClass("clicked");
                });
        }
        return {
            bind: function() {
                pigBind();
            }
        };
    })(),
}
dlMain.plugin = {
    '$iheck':(function(){
        function pigBind(){
            //单选框，复选框样式自定义替换插件处理
            $('input.byIcheck').iCheck({
                checkboxClass: 'icheckbox_minimal-green',
                radioClass: 'iradio_minimal-green',
                increaseArea: '20%' // optional
            });
            //单选框，复选框样式自定义替换插件处理
            $('input.byBaseIcheck').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green',
                increaseArea: '20%' // optional
            });
        }
        return{
            bind: function() {
                pigBind();
            }
        }
    })(),
}

dlMain.detailFixed={
    'fixFooter':(function(){
        function pigBind(){
            var h = $(".tableContent .content").outerHeight(true);
            var w=$(".tableContent .content").outerWidth(true);
            var left = $(".tableContent .content").offset().left;
            if( window.innerHeight < h){
                $(".saveBottomBar").addClass("fixBottombar");
                $(".saveBottomBar").css({'left':left,'width':w});
            }else{
                $(".saveBottomBar").removeClass("fixBottombar");
                $(".saveBottomBar").css({'width':'auto'});
            }
        }
        return{
            bind: function() {
                pigBind();
                window.onresize = function(){
                    pigBind();
                };

            }
        }

    })(),
}
function showWindow(obj){
    $(".fullBg").show();
    $(obj).show();
}
function hideWindow(obj){
    $(".fullBg").hide();
    $(obj).hide();
}
dlMain.windowCtrl={
    'windowPreview':(function(){
        function pigBind(){
            $("#previewButton").on("click",function(){
                $('#formPreviewPage').attr('src', $('#formPreviewPage').attr('src'));
                showWindow(".windowPreview");
            });
            $(".windowPreview .xClosed").on('click',function(){
                hideWindow(".windowPreview");
            });
            $(".fullBg").on('click',function(){
                $(this).hide();
                $(".window").hide();
            });
        }
        return{
            bind: function() {
                pigBind();
            }
        }
    })(),
    'windowReload':(function(){
        function pigBind(){
            $(".backToEdit").on("click",function(){
                hideWindow(".windowPreview");
            });
        }
        return{
            bind: function() {
                pigBind();
            }
        }
    })(),
}
function init() {
    $(document).queue('PIGCMS', function () {
    dlMain.tabs.subTab.bind();
    dlMain.tabs.swiperImg.bind();
    /*右侧编辑区域，子选项卡*/
    dlMain.fnClick.form_component_Click.bind();
    //这里是实时输入激活队列
    dlMain.formSetting.formTitle.bind();
    dlMain.formSetting.formTel.bind();
    dlMain.formSetting.formPhone.bind();
    dlMain.formSetting.formAddress.bind();
    dlMain.formSetting.formBriefing.bind();
    dlMain.formSetting.formMoney.bind();
    dlMain.formSetting.baseTitle1.bind();
    dlMain.formSetting.baseTitle2.bind();
    dlMain.formSetting.baseFootBtn.bind();
    dlMain.formSetting.formCustomScheme.bind();

    //这里是一些显示隐藏激活队列
    dlMain.showAndHide.isPay.bind();
    dlMain.showAndHide.isTerm.bind();
    dlMain.showAndHide.allNotice.bind();
    dlMain.showAndHide.emailNotice.bind();
    dlMain.showAndHide.textlNotice.bind();

    utilityDrag().bind();
    formItemSortable();
    addOptionDrag();
    serialSet();
    dlMain.plugin.$iheck.bind();
    //dlMain.detailFixed.fixFooter.bind();
    dlMain.windowCtrl.windowPreview.bind();
    dlMain.windowCtrl.windowReload.bind();

    });
    $(document).dequeue('PIGCMS');
}
$(function() {
    init();
});