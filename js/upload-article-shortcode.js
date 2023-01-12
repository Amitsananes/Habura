jQuery(function($) {

    $('.show_old_form').on('click', function() {
        $('.frontend-form').toggle();
    });

    // Enable navigation prompt
    window.onbeforeunload = function() {
        return true;
    };

    if(typeof Humanize == 'undefined' || typeof Humanize.filesize != 'function'){
        $.getScript("https://cdnjs.cloudflare.com/ajax/libs/humanize-plus/1.5.0/humanize.min.js")
    }

    var getFileSize = function(filesize) {
        return Humanize.fileSize(filesize);
    };

    function is_image(filetype) {
        if (filetype.includes("image")) {
            return true;
        }
        return false;
    }

    function is_video(filetype) {
        if (filetype.includes("video")) {
            return true;
        }
        return false;
    }

    function is_audio(filetype) {
        if (filetype.includes("audio")) {
            return true;
        }
        return false;
    }

    function get_file_ext(filename) {
        var n = filename.lastIndexOf('.');
        return filename.substring(n);
    }

    function isFutureDate(value) {
        d_inp = new Date(value)
        date = new Date();
        console.log(date.getTime() + 1 * 60 * 60 * 1000);
        return (date.getTime() + 1 * 60 * 60 * 1000) <= d_inp.getTime();
    }

    function addHours(numOfHours, date = new Date()) {
        date.setTime(date.getTime() + numOfHours * 60 * 60 * 1000);
        return date;
    }

    function process_field(text) {

        // Search and replace phone numbers
        text = text.replace(/\d{10}/g,"");
        text = text.replace(/\d{9}/g,"");
        text = text.replace(/\d{2}-\d{7}/g,"");
        text = text.replace(/\d{3}-\d{7}/g,"");
        text = text.replace(/1-?700-?\d{3}-?\d{3}/g,"");
        text = text.replace(/1-?800-?\d{3}-?\d{3}/g,"");
        text = text.replace(/1-?200-?\d{3}-?\d{3}/g,"");
        text = text.replace(/\*(\d{4}|\d{3})/g,"");
        text = text.replace(/^\d+$/i,"");

        // Remove emails
        text = text.replace(/([^.@\s]+)(\.[^.@\s]+)*@([^.@\s]+\.)+([^.@\s]+)/,"");

        // Remove links
        text = text.replace(/[(http|ftp|https):\/\/]*([\w_-]+(?:(?:\.[\w_-]+)+))([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])/i,"");
        text = text.replace(/\b((?:[a-z][\w-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'".,<>?«»“”‘’]))/g,'');

        // Remove asterisks
        text = text.replace(/[&\\@^#+()$~%*{}]/g, '');

        // Remove Emojis
        text = text.replace(/([\u2700-\u27BF]|[\uE000-\uF8FF]|\uD83C[\uDC00-\uDFFF]|\uD83D[\uDC00-\uDFFF]|[\u2011-\u26FF]|\uD83E[\uDD10-\uDDFF])/g, '');

        text = text.replace(/<(?!\/?[br|strong|em|span]\s*\/?)[^>]+>/g, '');

        text = text.trim();

        return text;
    }

    form_data = new FormData();
    form_data.set('action', upload_form.action);
    form_data.set('nonce', upload_form.nonce);

    let megabytes = 1048576;
    let max_image_size = 5;
    let max_audio_size = 5;
    let max_video_size = 400;
    let max_files_size = 400;
    let current_files_size = 0;
    let featured_img_field = $('.featured_image');
    let upload_field = $('.video_file_field');

    let media_files = [];

    let today = addHours(3).toISOString().slice(0, 16);
    document.getElementsByName("schedule_post")[0].min = today;

    $('.featured_image').uploadPreviewer({
        containerClass: '.featured_image_container',
        buttonText: '<i class="fa-solid fa-image"></i>',
    });

    $('.video_file_field').uploadPreviewer({
        containerClass: '.media_files',
        buttonText: '<i class="fa-solid fa-photo-film"></i>',
    });

    jQuery('textarea[name="post_content"]').on('input', function() {
        jQuery(this).style('height', '');
        jQuery(this).style('height', jQuery(this).prop('scrollHeight'));
    });

    $('input[name="schedule_post"]').on('change', function() {
        if (!isFutureDate(jQuery(this).val())) {
            jQuery('.error.past_date').show();
        } else {
            jQuery('.error.past_date').hide();
        }
    });

    let addRemoveListener = false;
    setInterval(function() {
        if ($('.featured_image_container .file-preview-row').length) {
            $('.featured_image_container .file-preview-button').hide();
            $('.featured_image_container .file-preview-table').show();
            $('.featured_image_container .file-preview-loading-container').show();
        } else {
            $('.featured_image_container .file-preview-button').show();
            $('.featured_image_container .file-preview-table').hide();
            $('.featured_image_container .file-preview-loading-container').hide();
        }
        if ($('.media_files .file-preview-row').length) {
            $('.media_files .file-preview-table').show();
            $('.media_files .file-preview-loading-container').show();
        } else {
            $('.media_files .file-preview-table').hide();
            $('.media_files .file-preview-loading-container').hide();
        }

        // Added media files
        $('.added_media_files .file-preview-table').each(function() {
            if ($(this).find('.file-preview-row').length) {
                $(this).show();
                $(this).next('.file-preview-loading-container').show();
            } else {
                $(this).hide();
                $(this).next('.file-preview-loading-container').hide();
            }
        });

        if($('.media_files tr').length) {
            let counter = 0;
            $('.media_files tr').each(function() {
                $(this).attr('data-index', counter);
                counter++;
            });
        }

        if ($('.featured_image_container .btn.btn-primary').length && !addRemoveListener) {
            $('.featured_image_container .btn.btn-primary').on('click', function () {
                addRemoveListener = true;
                form_data.delete('featured_image');
                $('input[type="featured_image"]').val('');
            });
        }

    }, 500);

    featured_img_field.on('click', function() {
        $(this).val('');
    });

    featured_img_field.on('change', function() {
        if (is_image(this.files[0].type) && this.files[0].size > megabytes * max_image_size){
            alert("הקובץ גדול מידי!");
            $(this).val('');
            $('.featured_image_container').addClass("remove_file");
        } else if (is_video(this.files[0].type) && this.files[0].size > megabytes * max_video_size){
            alert("הקובץ גדול מידי!");
            $(this).val('');
        } else if (is_audio(this.files[0].type) && this.files[0].size > megabytes *  max_audio_size){
            alert("הקובץ גדול מידי!");
            $(this).val('');
        } else {
            // console.log(this.files[0]);
            // form_data.set('featured_image', $(this).prop('files')[0]);
        }
    });

    $('.categories-select').select2({
        maximumSelectionLength: 2,
    });

    $('.tags-select').select2({
        maximumSelectionLength: 10,
        tags: true,
        createTag: function (params) {
            // Don't offset to create a tag if there is no @ symbol
            if (/^\d+$/.test(params.term)) {
                console.log("Null 1");
                return null;
            }
            if (/\d{3}-\d{7}/.test(params.term)) {
                console.log("Null 2");
                return null;
            }
            if (/\d{2}-\d{7}/.test(params.term)) {
                console.log("Null 3");
                return null;
            }
            if (/0\d{9}/.test(params.term)) {
                console.log("Null 4");
                return null;
            }
            if (/1-700/.test(params.term)) {
                console.log("Null 5");
                return null;
            }
            if (/1-800/.test(params.term)) {
                console.log("Null 6");
                return null;
            }
            if (/[!@#$%^&*()_+]/.test(params.term)) {
                console.log("Null 7");
                return null;
            }
            if(new RegExp("([a-zA-Z0-9]+://)?([a-zA-Z0-9_]+:[a-zA-Z0-9_]+@)?([a-zA-Z0-9.-]+\\.[A-Za-z]{2,4})(:[0-9]+)?(/.*)?").test(params.term)) {
                console.log("Null 8");
                return null;
            }
            // if (/(http|ftp|https):\/\/([\w_-]+(?:(?:\.[\w_-]+)+))([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])/g) {
            //     console.log("Null 8");
            //     return null;
            // }

            return {
                id: params.term,
                text: params.term
            }
        },
        ajax: {
            delay: 750,
            type: 'POST',
            url: '/wp-admin/admin-ajax.php?action=load_more_tags',
            dataType: 'json',
            data: function(term) {
                // console.log("term");
                // console.log(term);
                return {
                    term: term['term'],
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data['data'], function (item) {
                        return {
                            text: item['name'],
                            id: item['term_id']
                        }
                    })
                };
            }
        }
    });

    let remove_rows_from = -1;

    $(document).on('DOMNodeInserted', function(e) {
        if ( $(e.target).hasClass('select2-results__message') ) {
            //element with .select2-results__message was inserted.
            if ($(e.target).text() === 'You can only select 2 items') {
                $(e.target).text('ניתן לבחור עד שתי קטגוריות');
            }
            if ($(e.target).text() === 'You can only select 10 items') {
                $(e.target).text('ניתן לבחור עד עשר תגיות');
            }
        }
        if ($(e.target).hasClass('file-preview-row')) {
            $(e.target).find('input').on('input', function() {
                $(this).closest('tr').find('.error').hide();
            });
            if ($(e.target).closest('.featured_image_container').hasClass('remove_file')) {
                $(e.target).remove();
                $('.featured_image_container').removeClass("remove_file")
            }
            if ($(e.target).closest('.media_files').length) {
                let filename = $(e.target).find('.filename').text();
                if ($('.media_files .file-preview-row .filename:contains("'+filename+'")').length > 1) {
                    $(e.target).remove();
                    let index = -1;
                    let count = 0;
                    for (let i = 0; i < media_files.length; i++) {
                        if (media_files[i].name == filename) {
                            index = i;
                            count++;
                        }
                    }
                    if (index > -1 && count > 1) {
                        media_files.splice(index, 1);
                    }
                } else {
                    $(e.target).find('.remove-file').on('click', function () {
                        let filename = $(this).closest('.file-preview-row').find('td.filename').text();
                        let filesize = parseInt($(this).closest('.file-preview-row').find('td.filesize').text());
                        let index = -1;
                        current_files_size -= filesize;
                        $('.current_size_sum').text(getFileSize(current_files_size));
                        for (let i = 0; i < media_files.length; i++) {
                            if (media_files[i].name == filename) {
                                index = i;
                            }
                        }
                        if (index > -1) {
                            media_files.splice(index, 1);
                        }
                    });
                }
                if (remove_rows_from > -1) {
                    if ($('.media_files .'+$(e.target).attr('class')).length > remove_rows_from) {
                        console.log("Should remove");
                        $(e.target).remove();
                    }
                }
            }
        }
    });

    $('.input_counter').on('input', function() {
        let chars_count = $(this).val().length;
        $(this).closest('.textarea_container').find('.current_count').text(chars_count);
    });

    upload_field.on('click', function() {
        $(this).val('');
    });

    upload_field.on('input', function() {
        if (is_image(this.files[0].type) && this.files[0].size > megabytes * max_image_size){
            alert("ניתן להעלות תמונות עד 5MB, סרטונים עד 400MB ואודיו עד 5MB");
            $(this).val('');
        } else if (is_video(this.files[0].type) && this.files[0].size > megabytes * max_video_size){
            alert("ניתן להעלות תמונות עד 5MB, סרטונים עד 400MB ואודיו עד 5MB");
            $(this).val('');
        } else if (is_audio(this.files[0].type) && this.files[0].size > megabytes *  max_audio_size){
            alert("ניתן להעלות תמונות עד 5MB, סרטונים עד 400MB ואודיו עד 5MB");
            $(this).val('');
        } else {
            for (let i = 0; i < $(this).prop('files').length; i++) {
                let file_size = $(this).prop('files')[i].size;
                let already_uploaded = false;
                for (let j = 0; j < media_files.length; j++) {
                    if (media_files[j]['name'] == $(this).prop('files')[i].name) {
                        already_uploaded = true;
                        break;
                    }
                }
                if (already_uploaded) {
                    alert('כבר העלת את הקובץ '+$(this).prop('files')[i].name);
                    continue;
                } else if (max_files_size * megabytes < file_size + current_files_size) {
                    alert('סך משקל הקבצים צריך להיות נמוך מ- 400mb');
                    if (remove_rows_from == -1) {
                        let index = 0;
                        if ($('.media_files .file-preview-row').length) {
                            parseInt($('.media_files .file-preview-row').last().attr('data-index'));
                        }
                        remove_rows_from = index + i;
                        console.log(index + " + " + i + " = " + remove_rows_from);
                    }
                    continue;
                } else {
                    current_files_size += file_size;
                    $('.current_size_sum').text(getFileSize(current_files_size));
                    media_files.push($(this).prop('files')[i]);
                }
            }
            // console.log(media_files);
            // console.log($(this).prop('files'));
            // var ins = document.getElementById('media_files').files.length;
            // files_counter++;
        }
    });

    $('.add_more_button').on('click', function() {
        if ($(this).hasClass('content')) {
            $('.more_content').append(
                '<textarea className="post_content" onInput=\'this.style.height = "";this.style.height = this.scrollHeight + "px"\'\n' +
                'name="post_content" rows="4" cols="50"></textarea>'
            );
            $(this).removeClass('content');
            $(this).addClass('files');
            $(this).text('הוסף קבצים');
        } else if ($(this).hasClass('files')) {
            let index = $('.more_content input.video_file_field').length;
            $('.more_content').append(
                '<div class="added_media_files index_'+index+'">' +
                '<input type="file" multiple title="הוסף קבצים לכתבה" class="video_file_field" name="media_files[]"/>' +
                '</div>'
            );
            $('.more_content .added_media_files:last-child input.video_file_field').uploadPreviewer({
                containerClass: '.index_'+index,
                buttonText: '<i class="fa-solid fa-photo-film"></i>',
            });
            $(this).removeClass('files');
            $(this).addClass('content');
            $(this).text('הוסף תוכן');
        }
    });

    $('input[name="schedule_post_checkbox"]').on('change', function() {
        if ($(this).is(':checked')) {
            $('.schedule_input_container').show();
        } else {
            $('.schedule_input_container').hide();
        }
    });

    $('input').on('input', function() {
        $(this).closest('.input_container').find('.error').hide();
    });

    $('select').on('input', function() {
        $(this).closest('.input_container').find('.error').hide();
    });

    $('textarea').on('input', function() {
        $(this).closest('.input_container').find('.error').hide();
    });

    jQuery("#post_content_tmce_ifr").contents().find("body").on('focus', function() {
        $('.tiny_mce_error.error').hide();
    })

    // Upload the post
    $('#upload-article-shortcode-form').on('submit', function(e) {
        e.preventDefault();

        $('input[type="submit"]').prop('disabled', true);

        let approved = true;
        let invalid_element_identifier = '';

        if (!$('input[name="post_title"]').val()) {
            // $('input[name="post_title"]').css('border-color', 'red');
            approved = false;
            invalid_element_identifier = 'input[name="post_title"]';
            $('input[name="post_title"]').closest('.input_container').find('p.error').show();
        }

        if (!$('textarea[name="post_excerpt"]').val()) {
            // $('textarea[name="post_excerpt"]').css('border-color', 'red');
            approved = false;
            if (!invalid_element_identifier) {
                invalid_element_identifier = 'textarea[name="post_excerpt"]';
            }
            $('textarea[name="post_excerpt"]').closest('.input_container').find('p.error').show();
        }

        if ($('.featured_image_container .file_alt_field').length) {
            $('.featured_image_container .file_alt_field').each(function() {
                if ($(this).val()) {
                    // let file = form_data.get('featured_image');
                    // let new_file_name = process_field($(this).val()) + get_file_ext(file['name']);
                    // form_data.set('featured_image', file, new_file_name);
                } else {
                    // $(this).css('border-color', 'red');
                    approved = false;
                    $(this).closest('td').find('p.error').show();
                    if (!invalid_element_identifier) {
                        invalid_element_identifier = '.featured_image_container .file_alt_field';
                    }
                }
            });
            $('.featured_image_container .file_description_field').each(function() {
                if ($(this).val()) {
                    // form_data.set('featured_img_desc', process_field($(this).val()));
                } else {
                    // form_data.set('featured_img_desc', $('input[name="post_title"]').val());
                }
            });
        } else {
            $('.featured_image_container label').css('color', 'red');
            approved = false;
            if (!invalid_element_identifier) {
                invalid_element_identifier = '.featured_image_container';
            }
            $('.featured_image_container').closest('.input_container').find('p.error').show();
        }

        if (!$('textarea[name="post_content"]').val()) {
            // $('textarea[name="post_content"]').css('border-color', 'red');
            approved = false;
            if (!invalid_element_identifier) {
                invalid_element_identifier = 'textarea[name="post_content"]';
            }
            $('textarea[name="post_content"]').closest('.input_container').find('p.error').show();
        }

        if ($('.categories-select').val().length) {
            form_data.set('categories', $('.categories-select').val());
        } else {
            // $('.categories_container .select2-selection.select2-selection--multiple').css('border-color', 'red');
            approved = false;
            if (!invalid_element_identifier) {
                invalid_element_identifier = '.categories-select';
            }
            $('.categories-select').closest('.input_container').find('p.error').show();
        }

        if ($('.tags-select').val().length) {
            form_data.set('tags', $('.tags-select').val());
        } else {
            // $('.tags_container .select2-selection.select2-selection--multiple').css('border-color', 'red');
            approved = false;
            if (!invalid_element_identifier) {
                invalid_element_identifier = '.tags-select';
            }
            $('.categories-select').closest('.input_container').find('p.error').show();
        }

        if ($('.media_files .file_alt_field').length) {
            let counter = 0;
            $('.media_files .file_alt_field').each(function() {
                if ($(this).val()) {
                    let filename = process_field($(this).val()) + get_file_ext(media_files[counter].name);
                    media_files[counter] = new File([media_files[counter]], filename, {
                        type: media_files[counter]['type'],
                    });
                    // let file = form_data.get('file'+counter);
                    // form_data.set('file'+counter, file, new_file_name);
                } else {
                    // $(this).css('border-color', 'red');
                    $(this).closest('td').find('p.error').show();
                    approved = false;
                }
                counter++;
            });
            let descriptions = [];
            $('.media_files .file_description_field').each(function() {
                descriptions.push(process_field($(this).val()) ? $(this).val() : $('input[name="post_title"]').val());
            });
            form_data.set('descriptions', descriptions);
        }

        if ($('input[name="schedule_post_checkbox"]').is(':checked')) {
            if ($('input[name="schedule_post"]').val() && isFutureDate($('input[name="schedule_post"]').val())) {
                form_data.set('schedule', process_field($('input[name="schedule_post"]').val()));
            } else {
                // $('input[name="schedule_post"]').css('border-color', 'red');
                approved = false;
                if (!invalid_element_identifier) {
                    invalid_element_identifier = 'input[name="schedule_post"]';
                }
                if (!$('input[name="schedule_post"]').val()) {
                    $('.schedule_input_container p.error:not(.past_date)').show();
                } else if (isFutureDate($('input[name="schedule_post"]').val())) {
                    $('.schedule_input_container p.error.past_date').show();
                }
            }
        }

        if ($('input[name="agree_to_terms"]').length && !$('input[name="agree_to_terms"]').is(':checked')) {
            // $('input[name="agree_to_terms"]').css('border-color', 'red');
            $('.agree_to_terms_container').css('color', 'red');
            approved = false;
            if (!invalid_element_identifier) {
                invalid_element_identifier = 'input[name="agree_to_terms"]';
            }
        }

        if ( !approved ) {
            $('input[type="submit"]').prop('disabled', false);
            $([document.documentElement, document.body]).animate({
                scrollTop: $(invalid_element_identifier).offset().top - 100
            }, 500);
            return;
        }

        form_data = new FormData(document.getElementById('upload-article-shortcode-form'));
        form_data.set('action', upload_form.action);
        form_data.set('nonce', upload_form.nonce);
        form_data.delete('media_files[]');
        // form_data.append("media_files[]", media_files);
        for (let i = 0; i < media_files.length; i++) {
            form_data.append("media_files[]", media_files[i]);
        }

        if (!$('input[name="schedule_post_checkbox"]').is(':checked') || $('input[name="schedule_post"]').val() == '') {
            console.log('Delete schedule_post')
            form_data.delete('schedule_post');
        }
        console.log(form_data.get('schedule_post'));

        form_data.set('post_title', process_field($('input[name="post_title"]').val()));
        form_data.set('post_excerpt', process_field($('textarea[name="post_excerpt"]').val()));
        form_data.set('post_content', process_field($('textarea[name="post_content"]').val()));
        form_data.set('featured_img_alt', process_field($('input[name="featured_img_alt"]').val()));
        if ($('textarea[name="featured_img_desc"]').val() != '') {
            form_data.set('featured_img_desc', process_field($('textarea[name="featured_img_desc"]').val()));
        } else {
            form_data.delete('featured_img_desc');
        }
        if ($('input[name="files_alts[]"]').length) {
            form_data.delete('files_alts[]');
            $('input[name="files_alts[]"]').each(function() {
                form_data.append('files_alts[]', process_field($(this).val()));
            });
        }
        if ($('input[name="files_descriptions[]"]').length) {
            form_data.delete('files_descriptions[]');
            $('input[name="files_descriptions[]"]').each(function() {
                form_data.append('files_descriptions[]', process_field($(this).val()));
            });
        }

        $this = $(this);

        $('.progress_indicator').show();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        update_progress(percentComplete * 100);
                        $('#progress-bar').val(percentComplete * 100);
                        $('.progress_indicator .progress').text(
                            (evt.loaded/megabytes).toFixed(1) +
                            '/' +
                            (evt.total/megabytes).toFixed(1) + 'Mb'
                        );
                        // $('#progress-bar').val({
                        //     width: percentComplete * 100 + '%'
                        // });
                        if (percentComplete === 1) {
                            console.log("Done!");
                        }
                    }
                }, false);
                xhr.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '/wp-admin/admin-ajax.php',
            processData: false,
            contentType: false,
            data: form_data,
            success: function (result) {
                // alert(result);
                window.onbeforeunload = null;
                // window.location.replace('/דף-תודה/');
                // $('input[type="submit"]').prop('disabled', false);
                // $('.progress_indicator').hide();
                // console.log(result);
            },
            complete: function() {
                window.onbeforeunload = null;
                window.location.replace('/דף-תודה/');
            },
            error: function (error) {
                // alert(error);
                $('.progress_indicator').hide();
                // console.log(error)
            },
        });
    });

    // https://uimovement.com/ui/3192/crospots-search/
    function update_progress(pct) {
        if(!isNaN(pct)) {
            if(pct > 100) {pct = 100}; // Too High
            if(pct < 0) {pct = 0};     // Too Low
            var offset = (( -parseFloat(pct) /100) * 220) - 220; // Getting offset for the SVG

            $('.imported_progress_bar .progress-bar').attr('stroke-dashoffset',offset);
            $('.imported_progress_bar .progress-label').text(Number(Math.round(pct+'e2')+'e-2')+'%'); // Rounds to two decimal places
        };

        // Check for finish
        (pct === 100)?( complete() ):( incomplete() );
    };

    // Complete and Error States
    function complete() {
        // $('.imported_progress_bar .container').addClass('flipped complete').removeClass('error');
        $('.progress_indicator p.wait').text('אנא המתן');
    };
    function incomplete() { $('.imported_progress_bar .container').removeClass('flipped complete'); };
    function error() { $('.imported_progress_bar .container').addClass('flipped error').removeClass('complete');  };
    function no_error() { $('.imported_progress_bar .container').removeClass('flipped error'); };

});