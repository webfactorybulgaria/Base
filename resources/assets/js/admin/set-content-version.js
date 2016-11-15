$(function () {
    /**
     * Change content version when user change tab in back end forms
     *
     * @param  {string} version
     * @return {void}
     */
    function setContentVersion(version) {
        $.each(version, function(key, value) {
            if(key == 'translations') {
                $.each(value, function(tk, translation) {
                    $.each(translation, function(k, v) {
                        var id = document.getElementById(translation.locale + '[' + k + ']');
                        var $id = $(id);
                        if(id !== null) {
                            var type = id.tagName.toLowerCase();
                            if(type == 'textarea' && $id.hasClass('ckeditor')) {
                                // lang specific -> ckeditor fields
                                CKEDITOR.instances[translation.locale + '[' + k + ']'].setData(v);
                            } else {
                                // lang specific -> text inputs
                                $id.val(v);
                            }
                        } else {
                            // lang specific -> checkbox inputs
                            var $id = $("[type='checkbox'][name='" + translation.locale + "[" + k + "]'");
                            if($id.length) {
                                if(parseInt(v)) {
                                    $id.prop("checked", true);
                                } else {
                                    $id.prop("checked", false);
                                }
                            }
                        }
                    });
                });
            } else {
                var $id = $('#' + key);
                if($id.length) {
                    if($id.attr('type') == 'date') {
                        // general data -> date inputs
                        var date = new Date(value);
                        var day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate();
                        var month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1);
                        var year = date.getFullYear();
                        var dateStr = year + '-' + month + '-' + day;
                        $id.val(dateStr);
                    } else {
                        // general data -> text inputs + select dropdowns
                        $id.val(value);
                    }
                } else {
                    // general data -> checkbox inputs
                    var $id = $("[type='checkbox'][name='" + key + "'");
                    if($id.length) {
                        if(parseInt(value)) {
                            $id.prop("checked", true);
                        } else {
                            $id.prop("checked", false);
                        }
                    }
                }
            }
        });
    }

    $('.btn-version-js').click(function (e) {
        e.preventDefault();
        var $this = $(this);
        var version = $this.data('json');
        setContentVersion(version);
        $this.addClass('active').siblings().removeClass('active');
        $('#active-version').html($this.html());

    });

});
