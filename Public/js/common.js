var d = null;
window.realAlert = window.alert;
window.realConfirm = window.confirm;

/**
 * @brief 重写系统函数alert
 * @param string message 提示消息内容
 * @param string title 提示标题
 * @param function bYes 点击确认按钮时触发的事件
 * @param bool modal 是否以模态窗口显示
 */
window.alert = function (message, title, bYes, modal) {
    typeof(modal) == 'undefined' && (modal = true);

    d = dialog({
        title: title ? title : '提示',
        content: message ? message : 'null',
        okValue: '确定',
        ok: function () {
            return bYes ? bYes() : true;
        }
    });
    modal ? d.showModal() : d.show();
    window.alertDialog = d;
    return false;
}

/**
 * @brief 重写系统函数confirm
 * @param string message 提示消息内容
 * @param string title 提示标题
 * @param function bYes 点击确认按钮时触发的事件
 * @param function bNo 点击取消按钮时触发的事件
 * @param bool modal 是否以模态窗口显示
 */
window.confirm = function (message, title, bYes, bNo, modal) {
    typeof(modal) == 'undefined' && (modal = true);

    d = dialog({
        title: title ? title : '提示',
        content: message ? message : 'null',
        okValue: '确定',
        ok: function () {
            return bYes ? bYes() : true;
        },
        cancelValue: '取消',
        cancel: function () {
            return bNo ? bNo() : true;
        }
    });
    modal ? d.showModal() : d.show();
    window.confirmDialog = d;

    return false;
}

/**
 * @breif 重写系统函数open
 */
window.opend = function (url, title, width, height, modal) {
    typeof(modal) == 'undefined' && (modal = true);

    openDialog = dialog({
        url: url.match('http') ? url : __WEBROOT__ + url,
        title: title ? title : '',
        okValue: '提交',
        width: width ? width : 1000,
        height: height ? height : $(window).height() - 100,
    });
    modal ? openDialog.showModal() : openDialog.show();

    return false;
}

/**
 * @brief 添加系统函数show
 * @param string message 提示消息内容
 * @param int time 窗口持续显示的时间
 * @param bool modal 是否以模态窗口显示
 */
window.show = function (message, title, modal) {
    typeof(modal) == 'undefined' && (modal = true);

    d = dialog({
        title: title ? title : '提示',
        content: message ? message : 'null',
    });
    modal ? d.showModal() : d.show();

    return false;
}

/**
 * @brief 添加系统函数tips
 * @param string message 提示消息内容
 * @param int time 窗口持续显示的时间
 * @param bool modal 是否以模态窗口显示
 */
window.tips = function (message, time, modal) {
    typeof(modal) == 'undefined' && (modal = true);
    time && (time = parseFloat(time));

    d = dialog({
        content: message ? message : 'null'
    });

    setTimeout(function () {
        d.close().remove();
    }, (time ? time : 0.5) * 1000);
    modal ? d.showModal() : d.show();
    window.tipsDialog = d;
    return false;
}

//封装的全局变量
var global = {
    formStatus: false,
    /**
     * @brief 模拟TP的U函数
     * @param string url 待解析URL
     * @return string 模拟后的url
     */
    U: function (url) {
        switch (parseInt(__URL_MODEL__)) {
            case 0:
                url = url.split('/');
                return __WEBROOT__ + 'index.php?m=' + __MODULE_NAME__ + '&c=' + url[0] + '&a=' + url[1];
            case 1:
                url = url.split('/');
                return __WEBROOT__ + 'index.php?m=' + __MODULE_NAME__ + '&c=' + url[0] + '&a=' + url[1];
            case 2:
                return __WEBROOT__ + __MODULE_NAME__ + '/' + url + '.html';
                break;
        }
    },
    /**
     * @brief 页面跳转
     * @param string url 转向的网址
     */
    R: function (url) {
        window.location.href = url;
    },
    /**
     * @brief 处理搜索或筛选的结果URL
     * @param string url
     */
    parseUrl: function (key, val, url) {
        !url && (url = decodeURIComponent(window.location.href));
        if (!key) {
            return url;
        }

        eval('var pa=/\\W' + key + '=\\w+/');
        var match_string = url.match(pa) ? url.match(pa).toString() : '';
        var flag = match_string.substr(match_string.length - 1) == '&';

        switch (parseInt(__URL_MODEL__)) {
            case 0:
                if (match_string) {
                    url = val ? url.replace(pa, '&' + key + '=' + val + (flag ? '&' : '')) : url.replace(pa, '');
                }
                else {
                    val && (url += '&' + key + '=' + val);
                }
                break;
        }
        return url;
    }
};

/**
 * @brief 切换验证码
 * @param DOM imgObj 验证码对象
 * @param DOM inputObj 验证码输入框对象
 */
window.changeRandCode = function (imgObj, inputObj) {
    var img = imgObj.attr('src');
    var match = img.match('rand');
    var src = img.split('rand');
    var new_src = '';
    var rand = Math.random();

    switch (parseInt(__URL_MODEL__)) {
        case 0:
            new_src = src[0] + (match ? '' : '&') + 'rand=' + rand;
            break;

        case 1:
        case 2:
        case 3:
            new_src = (match ? src[0] + 'rand/' : (src[0].replace('.html', '') + '/rand/')) + rand + '.html';
            break;
    }

    imgObj.attr('src', new_src)
    inputObj.val('').focus();
};

/**
 * @brief 表单验证对象
 * @注意：对象输入框需要三个状态 ok error normal
 */
var formValidate = function (formObj) {
    var _self = this;
    _self.preObj = null;
    _self.tipsContent = null;

    this.markOk = false;	//是否标记验证通过状态
    this.markError = true;	//是否标记验证未状态
    this.showTips = true;	//是否显示错误提示
    this.status = true;		//验证状态
    this.time = 3;
    //验证表单
    this.validate = function () {
        formObj.find('input,select').each(function () {
            if ($(this).attr('ignore') == 'true') {
                return true;
            }
            if ($(this).attr('regexp')) {
                _self.preObj = $(this);
                _self.checkPattern($(this).val(), $(this).attr('regexp'));
                if (!_self.status) {
                    return false;
                }
            }
        });
    };
    //错误标记
    _self.error = function () {
        this.status = false;
        _self.preObj.focus();
        _self.preObj.removeClass('ok normal').addClass('error');
        this.markError && _self.preObj.addClass('error');
        this.showTips && _self.errorTips();
        setTimeout(function () {
            _self.preObj.removeClass('ok normal error');
        }, this.time * 1000);
    };
    //正确标记
    _self.ok = function () {
        this.status = true;
        _self.preObj.removeClass('error');
        this.markOk ? _self.preObj.addClass('ok') : _self.preObj.addClass('normal');
    };
    //错误提示
    _self.errorTips = function () {
        var tip = _self.preObj.attr('tips');
        var left = _self.preObj.offset().left;
        var top = _self.preObj.offset().top;
        var height = _self.preObj.height();
        var pleft = parseInt(_self.preObj.css('padding-left'));
        var ptop = parseInt(_self.preObj.css('padding-top'));
        var pbottom = parseInt(_self.preObj.css('padding-bottom'));

        left = left + pleft;
        top = top + ptop + pbottom;
        _self.tipsContent = '<div class="errorTips" style="margin-top:5px;"><span class="tipsContent">' + tip + '</span></div>';
        $('.errorTips').remove();
        tip && _self.preObj.after(_self.tipsContent);
        setTimeout(function () {
            $('div.errorTips').remove();
        }, this.time * 1000)
    };
    //验证规则
    _self.checkPattern = function (value, regexp) {
        var patt = new RegExp(regexp);

        patt.exec(value) ? _self.ok() : _self.error();
    };
};

/**
 * @brief 表单内容自动填充
 */
var autoComplete = function (formObj, data) {
    var _self = this;
    _self.data = (typeof(data) == 'object') ? data : (data.length ? eval('(' + data + ')') : '');
    _self.formObj = formObj;

    /**
     * @brief 构造函数
     */
    this.__construct = function () {
        if (typeof(_self.data) != 'object') {
            return false;
        }

        _self.init();
    }

    /**
     * @brief 填充内容
     */
    _self.init = function (data) {
        (typeof(data) == 'undefined') && (data = _self.data);
        for (var i in data) {
            if (typeof(data[i]) == 'object') {
                _self.init(data[i]);
            }
            else {
                var obj = $('[name="' + i + '"]');
                var tag_name = '';
                if (obj[0]) {
                    tag_name = obj[0].tagName.toLowerCase();
                }
                var tag_type = obj.attr('type');

                switch (tag_type) {
                    case 'radio':
                    case 'checkbox':
                        obj.each(function () {
                            if ($(this).val() == data[i]) {
                                $(this).prop('checked', true);
                            }
                            else {
                                $(this).prop('checked', false);
                            }
                        });
                        break;
                    case 'img':
                        obj.attr('src', data[i]);
                        break;
                    default:
                        obj.val(data[i].toString().replace(/amp;/g, ''));
                        break;
                }
            }
        }
    }

    _self.__construct();
}

/**
 * @brief 事件绑定
 */
$(function () {
    $('form').submit(function () {
        var formVal = new formValidate($(this));
        formVal.validate();
        global.formStatus = formVal.status;

        if ($(this).attr('ajaxSubmit') == 'true') {
            return false;
        }

        return formVal.status ? true : false;
    });

});