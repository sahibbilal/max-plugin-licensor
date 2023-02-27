<?php

function max_plugin_zips_html(){
    global $wpdb;
    $sb         = 1;
    $table_name = $wpdb->prefix."max_plugin_details";
    $data       = max_plugin_data_pagination($table_name);
    $result     = $data['result'];
    $total      = $data['total'];
    $per_page   = $data['per_page'];
    $page       = $data['page'];
//    $total      = ($total == $per_page) ? $per_page : $total / $per_page;
    $user = wp_get_current_user();

    ?>
    <div id="wpbody-content">
        <input type="hidden" id="ajax_url_for_options"  value="<?php echo admin_url('admin-ajax.php')?>">
        <?php echo max_plugin_notices(); ?>
        <div class="wrap">
            <form id="posts-filter" method="get">
                <?php if ( in_array( 'administrator', (array) $user->roles ) ) { ?>
                <a href="#" class="button button-success max_show_zips_modal" data-id="0" data-type="new" data-ajaxurl="<?php echo admin_url('admin-ajax.php')?>">Add New</a>
                <?php } ?>
                <p class="search-box">
                    <label class="screen-reader-text" for="post-search-input">Search Posts:</label>
                    <input type="search" id="post-search-input" placeholder="Search" name="s" value="">
<!--                    <input type="button" id="search-submit" class="button" value="Search Posts">-->
                </p>
                <hr class="wp-header-end">
                <div class="max-sb-admin-tab">
                    <table class="wp-list-table widefat fixed striped table-view-list posts max_saerch_table">
                        <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>Plugin name</th>
                            <th>Slug</th>
                            <th>Latest Vesrion</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($result as $single){ ?>
                            <tr>
                                <td><?php echo $sb++; ?></td>
                                <td>
                                    <a href="<?php echo $single->plugin_zip?>" target="_blank">
                                        <?php echo $single->plugin_name?>
                                    </a>
                                </td>
                                <td><?php echo $single->slug?></td>
                                <td><?php echo $single->version?></td>
                                <td><?php echo ($single->status == 'active') ? 'Active' : 'Inactive'; ?></td>
                                <td><?php echo explode(" ",$single->created_at)[0]; ?></td>
                                <td class="max_post_links">
                                    <div class="row-actionss">
                                        <span>
                                            <a href="#" class="max_show_zips_modal"  data-id="<?php echo $single->id; ?>" data-type="update" data-ajaxurl="<?php echo admin_url('admin-ajax.php')?>">Update</a> |
                                        </span>
                                        <span>
                                            <a href="#" class="max_show_licenses_modal" id="max_show_licenses_modal<?php echo $single->id; ?>" data-plugin_id="<?php echo $single->id; ?>"  data-id="<?php echo $single->id; ?>" data-type="new" data-ajaxurl="<?php echo admin_url('admin-ajax.php')?>">Add License Key</a> |
                                        </span>
                                        <span>
                                            <a href="#" class="max_delete_zip"  data-id="<?php echo $single->id; ?>" data-ajaxurl="<?php echo admin_url('admin-ajax.php')?>">Delete</a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <div class="max_modal" style="display:none;">
        <div class="max_modal_inner">
        </div>
    </div>
    <div class="max_pagination ">
        <?php
            echo paginate_links( array(
                'base' => add_query_arg( 'cpage', '%#%' ),
                'format' => '',
                'prev_text' => __('&laquo;'),
                'next_text' => __('&raquo;'),
                'total' => ceil($total / $per_page),
                'current' => $page
            ));
        ?>
    </div>
    <?php
}

function max_plugin_licenses_html(){
    global $wpdb;
    $sb         = 1;
    $table_name = $wpdb->prefix."max_license_details";
    $data       = max_plugin_data_pagination($table_name);
    $result     = $data['result'];
    $total      = $data['total'];
    $per_page   = $data['per_page'];
    $page       = $data['page'];
//    $total      = ($total == $per_page) ? $total : $total / $per_page;
    ?>
    <div id="wpbody-content">
        <input type="hidden" id="ajax_url_for_options"  value="<?php echo admin_url('admin-ajax.php')?>">
        <?php echo max_plugin_notices(); ?>
        <div class="wrap">
            <form id="posts-filter" method="get">
                <a href="#" class="button button-success max_show_licenses_modal" data-id="0" data-type="new" data-ajaxurl="<?php echo admin_url('admin-ajax.php')?>">Add New</a>
                <p class="search-box">
                    <label class="screen-reader-text" for="post-search-input">Search Posts:</label>
                    <input type="search" id="post-search-input" placeholder="Search" name="s" value="">
<!--                    <input type="button" id="search-submit" class="button" value="Search Posts">-->
                </p>
                <hr class="wp-header-end">
                <div class="max-sb-admin-tab">
                    <table class="wp-list-table widefat fixed striped table-view-list posts max_saerch_table">
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Plugin name</th>
                                <th>Domain / Website</th>
                                <th>License Key</th>
                                <th>License Type</th>
                                <th>Expiry date</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($result as $single){
                            $table_name = $wpdb->prefix."max_plugin_details";
                            $last_insertion = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $table_name . ' WHERE id = "' . $single->plugin_id . '"'));
                            ?>
                            <tr>
                                <td><?php echo $sb++; ?></td>
                                <td>
                                    <a href="<?php echo $last_insertion->plugin_zip ?>" target="_blank">
                                        <?php echo $last_insertion->plugin_name?>
                                    </a>
                                </td>
                                <td><?php echo $single->site_name?></td>
                                <td><?php echo $single->license_key?></td>
                                <td><?php echo $single->license_type?></td>
                                <td><?php echo $single->expiry_date?></td>
                                <td><?php echo ($single->status == 'active') ? 'Active' : 'Inactive'; ?></td>
                                <td><?php echo explode(" ",$single->created_at)[0]; ?></td>
                                <td class="max_post_links">
                                    <div class="row-actionss">
                                        <span>
                                            <a href="#" class="max_show_licenses_modal" id="max_show_licenses_modal<?php echo $single->id; ?>" data-plugin_id="<?php echo $single->plugin_id; ?>"  data-id="<?php echo $single->id; ?>" data-type="update" data-ajaxurl="<?php echo admin_url('admin-ajax.php')?>">Update</a> |
                                        </span>
                                        <span>
                                            <a href="#" class="max_delete_license"  data-id="<?php echo $single->id; ?>" data-ajaxurl="<?php echo admin_url('admin-ajax.php')?>">Delete</a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <div class="max_modal" style="display:none;">
        <div class="max_modal_inner">
        </div>
    </div>
    <div class="max_pagination ">
        <?php
            echo paginate_links( array(
                'base' => add_query_arg( 'cpage', '%#%' ),
                'format' => '',
                'prev_text' => __('&laquo;'),
                'next_text' => __('&raquo;'),
                'total' => ceil($total / $per_page ),
                'current' => $page
            ));
        ?>
    </div>
    <?php
}
function max_plugin_data_pagination($table_name){
    global $wpdb;
    $response               = [];
    $response['per_page']   = 10;
    $response['page']       = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
    $offset                 = ( $response['page'] * $response['per_page'] ) - $response['per_page'];
    $response['total']      = $wpdb->get_var( "SELECT COUNT(1) FROM $table_name AS combined_table" );
    $response['result']     = $wpdb->get_results ( "SELECT * FROM $table_name LIMIT $offset, ".$response['per_page']);
    return($response);
}
function max_plugin_notices(){
    $max_result_notice = get_option('max_result_notice');
    if(isset($max_result_notice) && $max_result_notice == 'slug'){ ?>
        <div class="max_error updated notice is-dismissible">
            <p>This slug are already exist. Please type a valid slug</p>
        </div>
    <?php }
    if(isset($max_result_notice) && $max_result_notice == 'site'){ ?>
        <div class="max_error updated notice is-dismissible">
            <p>This Site are already exist. Please type a valid site</p>
        </div>
    <?php }
    if(isset($max_result_notice) && $max_result_notice == 'query'){ ?>
        <div class="max_error updated notice is-dismissible">
            <p>Query error! Please try again</p>
        </div>
    <?php }
    if(isset($max_result_notice) && $max_result_notice == 'success'){ ?>
        <div class="updated notice is-dismissible">
            <p>Plugin Added Successfully</p>
        </div>
    <?php }
    if(isset($max_result_notice) && $max_result_notice == 'updated'){ ?>
        <div class="updated notice is-dismissible">
            <p>Plugin Updated Successfully</p>
        </div>
    <?php }
    if(isset($max_result_notice) && $max_result_notice == 'success1'){ ?>
        <div class="updated notice is-dismissible">
            <p>License key Added Successfully</p>
        </div>
    <?php }
    if(isset($max_result_notice) && $max_result_notice == 'updated1'){ ?>
        <div class="updated notice is-dismissible">
            <p>License Updated Successfully</p>
        </div>
    <?php }
    if(isset($max_result_notice) && $max_result_notice == 'file'){ ?>
        <div class="max_error updated notice is-dismissible">
            <p>File error! Please try again</p>
        </div>
    <?php }
}