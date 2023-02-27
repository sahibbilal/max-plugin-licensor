jQuery(document).ready( function () {
    var url = new URL(window.location);
    let searchParams = new URLSearchParams(url.search);
    var base_url = window.location.origin;
    if(searchParams.get('type') != ''){
        setTimeout(function(){
            var ajaxurl = jQuery('#ajax_url_for_options').val();
            // alert('checking');
            jQuery.ajax({
                url: ajaxurl,
                data: { action: "max_remove_notice_from_options"},
                type: "post",
                dataType: "html",
                success: function (res) {
                    jQuery('.is-dismissible').hide();
                }
            });
        //     jQuery('.is-dismissible').hide();
        //     url = url.slice( 0, url.indexOf('&') );
        //     console.log('test', url);
        //     if(searchParams.get('page') == 'max-plugin-licensor'){
        //         // if(searchParams.get('tab') == 'licensor'){
        //         //     window.history.pushState('', "", '/wp-admin/admin.php?page=max-plugin-licensor&tab=licenses');
        //         // }
        //         // else{
        //             // window.history.pushState({page: "plugins"}, "Licenses", base_url+'wp-admin/admin.php?page=max-plugin-licensor');
        //             // window.history.pushState('', "", '/wp-admin/admin.php?page=max-plugin-licensor');
        //         // }
        //     }
        }, 4000);
    }
    //show add plugin zip modal and also get data for update
    jQuery(document).on('click', '.max_show_zips_modal', function (e) {
        e.preventDefault();
        var ajaxurl = jQuery(this).data('ajaxurl');
        var type = jQuery(this).data('type');
        var id = jQuery(this).data('id');

        jQuery.ajax({
            url: ajaxurl,
            data: { action: "max_show_plugin_details_modal", type1: type , id: id },
            type: "post",
            dataType: "html",
            success: function (res) {
                jQuery(document).find('.max_modal').show();
                jQuery('.max_modal_inner').empty().append(res);
            }
        });
    });
    //search table function
    jQuery(document).on('keyup', '#post-search-input', function (e) {
        var value = jQuery(this).val().toLowerCase();
        jQuery(".max_saerch_table tbody tr").filter(function() {
            jQuery(this).toggle(jQuery(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    //check plugin uploaded file type
    jQuery(document).on('keyup', '.max_check_file', function (e) {
        var fileExtension = ['zip'];
        if (jQuery.inArray(jQuery(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only ZIP format are allowed");
            jQuery(this).val('');
        }
    });
    //delete plugin file function
    jQuery(document).on('click', '.max_delete_zip', function (e) {
        e.preventDefault();
        var ajaxurl = jQuery(this).data('ajaxurl');
        var id = jQuery(this).data('id');

        jQuery.ajax({
            url: ajaxurl,
            data: { action: "max_delete_plugin_zips" , id: id },
            type: "post",
            dataType: "html",
            success: function (res) {
                if(res == 200){
                    jQuery('#wpbody-content').append('<p>Deleted Successfully</p>')
                }else{
                    jQuery('#wpbody-content').append('<p style="color red">Sorry please try again</p>')
                }
            }
        });
    });
    //delete license file function
    jQuery(document).on('click', '.max_delete_license', function (e) {
        e.preventDefault();
        var ajaxurl = jQuery(this).data('ajaxurl');
        var id = jQuery(this).data('id');

        jQuery.ajax({
            url: ajaxurl,
            data: { action: "max_delete_plugin_licenses" , id: id },
            type: "post",
            dataType: "html",
            success: function (res) {
                if(res == 200){
                    jQuery('.max-sb-admin-tab').before('<div class="updated notice is-dismissible">' +
                        '<p>License deleted Successfully</p></div>');
                    // setTimeout(function(){
                        location.reload();
                    // }, 2000);
                }else{
                    jQuery('.max-sb-admin-tab').before('<div class="updated notice is-dismissible">' +
                        '<p>Sorry please try again</p>');
                    // setTimeout(function(){
                        location.reload();
                    // }, 2000);
                }
            }
        });
    });
    //show add plugin license modal and also get data for update
    jQuery(document).on('click', '.max_show_licenses_modal', function (e) {
        e.preventDefault();
        var ajaxurl = jQuery(this).data('ajaxurl');
        var type = jQuery(this).data('type');
        var id = jQuery(this).data('id');
        var plugin_id = jQuery(this).data('plugin_id');

        jQuery.ajax({
            url: ajaxurl,
            data: { action: "max_show_license_details_modal", type1: type , id: id, plugin_id: plugin_id },
            type: "post",
            dataType: "html",
            success: function (res) {
                jQuery(document).find('.max_modal').show();
                jQuery('.max_modal_inner').empty().append(res);
            }
        });
    });
    //function for renaming plugin slug
    jQuery(document).on('keyup', '.plugin_Slug', function () {
        var type = jQuery(this).data('type');
        var slug = jQuery(this).val();
        if(type == 1){
            slug = slug.replace(/\s/g, '-').toLowerCase();
            slug = slug.replace(/[~`!@#$%^&*()+={}\[\];:\'\"<>.,\/\\\?-_]/g, '');
        }else{
            slug = slug.replace(/\s/g, '');
            slug = slug.replace(/[a-zA-Z]/g, "");
            slug = slug.replace(/[~`!@#$%^&*()+={}\[\];:\'\"<>,\/\\\?-_]/g, '');
        }
        jQuery(this).val(slug);
    });
    jQuery(document).on('focusout', '.plugin_Slug', function () {
        var type = jQuery(this).data('type');
        var slug = jQuery(this).val();
        if(type == 1){
            slug = slug.replace(/\s/g, '-').toLowerCase();
            slug = slug.replace(/[~`!@#$%^&*()+={}\[\];:\'\"<>.,\/\\\?-_]/g, '');
        }else{
            slug = slug.replace(/\s/g, '');
            slug = slug.replace(/[a-zA-Z]/g, "");
            slug = slug.replace(/[~`!@#$%^&*()+={}\[\];:\'\"<>,\/\\\?-_]/g, '');
        }
        jQuery(this).val(slug);
    });
    //function for close modal
    jQuery(document).on('click', '.max_modal_close', function (e) {
        jQuery('.max_modal').find('form')[0].reset();
        jQuery('.max_modal').hide();
    });
    //function for generating random license key
    jQuery(document).on('click', '.max_add_random', function (e) {
        e.preventDefault();

        jQuery(document).find('.max_plugin_name_td p').remove();
        var random = license_generator(25);
        jQuery(document).find('.max_license_key_input').val(random);
        jQuery(document).find('.max_license_key_input').val(random);
    });
    //function for validation
    jQuery(document).on('click', '.max_modal_submit', function (e) {
        e.preventDefault();
        jQuery(this).closest('form').find('p').remove();
        var plugin_name = jQuery(document).find('.max_plugin_name').val();
        var site_name = jQuery(document).find("input[name=site_name]").val();
        var license_key = jQuery(document).find("input[name=license_key]").val();
        var license_type = jQuery(document).find(".max_license_type").val();
        var expiry_date = jQuery(document).find("input[name=expiry_date]").val();
        var plugin_Slug = jQuery(document).find("input[name=plugin_Slug]").val();
        var plugin_version = jQuery(document).find("input[name=plugin_version]").val();
        var plugin_file = jQuery(document).find("input[name=plugin_file]").val();
        var expression = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/gi;
        var regex = new RegExp(expression);
        if(plugin_name == '' || plugin_name == 'Select Plugin'){
            jQuery(document).find('.max_plugin_name').closest('td').append('<p style="color:red;margin:0">Please Select Plugin</p>');
        }else if(site_name == ''){
            jQuery(document).find("input[name=site_name]").closest('td').append('<p style="color:red;margin:0">Please add site name</p>');
        }
        // else if(site_name != '' && !site_name.match(regex)){
        //     jQuery(document).find("input[name=site_name]").closest('td').append('<p style="color:red;margin:0">Please type a valid site name e.g google.com</p>');
        // }
        else if(license_key == ''){
            jQuery(document).find("input[name=license_key]").closest('td').append('<p style="color:red;margin:0">Please add license name</p>');
        }else if(license_type == '' || license_type == 'Select Type'){
            jQuery(document).find(".max_license_type").closest('td').append('<p style="color:red;margin:0">Please add license type</p>');
        }else if(plugin_Slug == ''){
            jQuery(document).find("input[name=plugin_Slug]").closest('td').append('<p style="color:red;margin:0">Please add slug</p>');
        }else if(plugin_version == ''){
            jQuery(document).find("input[name=plugin_version]").closest('td').append('<p style="color:red;margin:0">Please add version</p>');
        }else if(plugin_file == ''){
            jQuery(document).find("input[name=plugin_file]").closest('td').append('<p style="color:red;margin:0">Please add zip file</p>');
        }else {
            console.log('testing ',expiry_date)
            jQuery(this).closest('form').submit();
        }
    });
    //function for changing data w.r.t license type monthyl or years
    jQuery(document).on('change', '.max_license_type', function (e) {
        var type = jQuery(this).val();
        var today = new Date();
        var date = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var year = today.getFullYear();
        if(type == 'monthly'){
            month = parseInt(month)+parseInt(1);
        }
        if(type == 'yearly'){
            year = parseInt(year)+parseInt(1);
        }
        today = year + '-' + month + '-' + date;
        jQuery(document).find('.max_expiry_date').val(today);
    });
    function license_generator( len ) {
        var length = (len)?(len):(20);
        var string = "abcdefghijklmnopqrstuvwxyz"; //to upper
        var numeric = '0123456789';
        var punctuation = '!@#$%^&*()_+|}{[]\:;?></-=';
        var license = "";
        var character = "";
        var crunch = true;
        while( license.length<length ) {
            entity1 = Math.ceil(string.length * Math.random()*Math.random());
            entity2 = Math.ceil(numeric.length * Math.random()*Math.random());
            entity3 = Math.ceil(punctuation.length * Math.random()*Math.random());
            hold = string.charAt( entity1 );
            hold = (license.length%2==0)?(hold.toUpperCase()):(hold);
            character += hold;
            character += numeric.charAt( entity2 );
            // character += punctuation.charAt( entity3 );
            license = character;
        }
        license=license.split('').sort(function(){return 0.5-Math.random()}).join('');
        return license.substr(0,len);
    }

});