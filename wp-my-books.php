<?php

/*
 * Plugin Name: My Book
 * Plugin URI: http://onlinewebtutorhub.blogspot.in/
 * Description: This is my custom plugin which basically make use of books management
 * Author: Online Web Tutor
 * Author URI: http://onlinewebtutorhub.blogspot.in/
 * Version: 1.0
 */

if (!defined("ABSPATH"))
    exit;
if (!defined("MY_BOOK_PLUGIN_DIR_PATH"))
    define("MY_BOOK_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
if (!defined("MY_BOOK_PLUGIN_URL"))
    define("MY_BOOK_PLUGIN_URL", plugins_url() . "/my-books");

function my_book_include_assets() {

$slug = '';
$pages_includes = array("frontendpage","book-list","add-new","add-author","remove-author","add-student","remove-student","course-tracker");

$currentPage = $_GET['page'];

//$_SERVER[REQUEST_URI] 
///$_SERVER[HTTP_HOST]: http://, https://

if(empty($currentPage)){
       $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (preg_match("/my_book/", $actual_link)) {
            $currentPage = "frontendpage";
        }
}

	if(in_array($currentPage,$pages_includes)){

	//styles
		wp_enqueue_style("bootstrap", MY_BOOK_PLUGIN_URL . "/assets/css/bootstrap.css", '');
		wp_enqueue_style("datatable", MY_BOOK_PLUGIN_URL . "/assets/css/jquery.dataTables.min.css", '');
		wp_enqueue_style("notifybar", MY_BOOK_PLUGIN_URL . "/assets/css/jquery.notifyBar.css", '');
		wp_enqueue_style("style", MY_BOOK_PLUGIN_URL . "/assets/css/style.css", '');
		//scripts
		wp_enqueue_script('jquery');
		wp_enqueue_script('bootstrap.min.js', MY_BOOK_PLUGIN_URL . '/assets/js/bootstrap.min.js', '', true);
		wp_enqueue_script('validation.min.js', MY_BOOK_PLUGIN_URL . '/assets/js/jquery.validate.min.js', '', true);
		wp_enqueue_script('datatable.min.js', MY_BOOK_PLUGIN_URL . '/assets/js/jquery.dataTables.min.js', '', true);
		wp_enqueue_script('jquery.notifyBar.js', MY_BOOK_PLUGIN_URL . '/assets/js/jquery.notifyBar.js', '', true);
		wp_enqueue_script('script.js', MY_BOOK_PLUGIN_URL . '/assets/js/script.js', '', true);
		wp_localize_script("script.js", "mybookajaxurl", admin_url("admin-ajax.php"));

	}  
}

add_action("init", "my_book_include_assets");

function my_book_plugin_menus() {
    add_menu_page("My Book", "My Book", "manage_options", "book-list", "my_book_list", "dashicons-book-alt", 30);
    add_submenu_page("book-list", "Book List", "Book List", "manage_options", "book-list", "my_book_list");
    add_submenu_page("book-list", "Add New", "Add New", "manage_options", "add-new", "my_book_add");
    
    /// my extended submenus

    add_submenu_page("book-list", "Add New Author", "Add New Author", "manage_options", "add-author", "my_author_add");
    add_submenu_page("book-list", "Manage Author", "Manage Author", "manage_options", "remove-author", "my_author_remove");
    add_submenu_page("book-list", "Add New Student", "Add New Student", "manage_options", "add-student", "my_student_add");
    add_submenu_page("book-list", "Manage Student", "Manage Student", "manage_options", "remove-student", "my_student_remove");
    add_submenu_page("book-list", "Course Tracker", "Course Tracker", "manage_options", "course-tracker", "course_tracker");

    //end section

    add_submenu_page("book-list", "", "", "manage_options", "book-edit", "my_book_edit");
}

function my_author_add(){
  include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/author-add.php";
}
function my_author_remove(){
   include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/manage-author.php";
}

function my_student_add(){
  include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/student-add.php";
}

function my_student_remove(){
  include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/manage-student.php";
}

function course_tracker(){
  include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/course-tracker.php";
}

add_action("admin_menu", "my_book_plugin_menus");

function my_book_list() {
    include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/book-list.php";
}

function my_book_add() {
    include_once MY_BOOK_PLUGIN_DIR_PATH . '/views/book-add.php';
}

function my_book_edit() {
    include_once MY_BOOK_PLUGIN_DIR_PATH . '/views/book-edit.php';
}

function my_book_table() {
    global $wpdb;
    return $wpdb->prefix . "my_books"; //wp_my_books
}

function my_book_generates_table_script() {

    global $wpdb;
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $sql = "  CREATE TABLE `" . my_book_table() . "` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) DEFAULT NULL,
            `author` varchar(255) DEFAULT NULL,
            `about` text,
            `book_image` text,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
           ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

    dbDelta($sql);

    $sql2 = " CREATE TABLE `".my_authors_table()."` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) DEFAULT NULL,
            `fb_link` text,
            `about` text,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1
            ";

            dbDelta($sql2);

     $sql3 = "CREATE TABLE `".my_students_table()."` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(255) DEFAULT NULL,
                `email` varchar(255) DEFAULT NULL,
                `user_login_id` int(11) DEFAULT NULL,
                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1

     ";   
     dbDelta($sql3);

     $sql4 = "CREATE TABLE `".my_enrol_table()."` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `student_id` int(11) NOT NULL,
            `book_id` int(11) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1
     ";  
     dbDelta($sql4);  

     //user role registration
     add_role("wp_book_user_key","My Book User",array(
         "read"=>true
     ));

     /*dynamic page creation code- listing of created books*/
     // Create post object
        $my_post = array(
            'post_title'    => "Book Page",
            'post_content'  => "[book_page]", //shortcode
            'post_status'   => 'publish',
            "post_type" =>"page",
            "post_name" => "my_book"
        );
        
        // Insert the post into the database
        $book_id = wp_insert_post( $my_post );
        add_option("my_book_page_id",$book_id);

}

register_activation_hook(__FILE__, "my_book_generates_table_script");


function my_book_page_functions(){
   include_once MY_BOOK_PLUGIN_DIR_PATH . '/views/my_books_frontend_lists.php';
}

add_shortcode("book_page","my_book_page_functions");

function my_authors_table(){
    global $wpdb;
    return $wpdb->prefix ."my_authors"; // wp_my_authors
}
function my_students_table(){
    global $wpdb;
    return $wpdb->prefix ."my_students"; // wp_my_students
}
function my_enrol_table(){
    global $wpdb;
    return $wpdb->prefix ."my_enrol"; // wp_my_enrol
}

function drop_table_plugin_books() {
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS " . my_book_table());
    $wpdb->query("DROP TABLE IF EXISTS " . my_authors_table());
    $wpdb->query("DROP TABLE IF EXISTS " . my_students_table());
    $wpdb->query("DROP TABLE IF EXISTS " . my_enrol_table());

    //removing user_role
    if(get_role("wp_book_user_key")){
       remove_role("wp_book_user_key");
    }
    //delete password 
    if(!empty(get_option("my_book_page_id"))){
        $page_id = get_option("my_book_page_id");
        wp_delete_post($page_id, true); //wp_posts
        delete_option("my_book_page_id"); // wp_options
    }
    
}

register_deactivation_hook(__FILE__, "drop_table_plugin_books");
// register_uninstall_hook(__FILE__,"drop_table_plugin_books");

add_action("wp_ajax_mybooklibrary", "my_book_ajax_handler");

function my_book_ajax_handler() {
    global $wpdb;
    include_once MY_BOOK_PLUGIN_DIR_PATH . '/library/my_booklibrary.php';
    wp_die();
}

add_filter("page_template","owt_custom_page_layout");

function owt_custom_page_layout($page_template){
   global $post;
   $page_slug = $post->post_name; //book page slug
   if($page_slug=="my_book"){
       $page_template =  MY_BOOK_PLUGIN_DIR_PATH . '/views/frontend-books-template.php';
   }
   return $page_template;
}

function get_author_details($author_id){
    global $wpdb;
    $author_details = $wpdb->get_row(

        $wpdb->prepare(

             "SELECT * from ".my_authors_table()." WHERE id = %d",$author_id

        ),ARRAY_A
    );
    return  $author_details;
}

function owt_login_user_role_filter($redirect_to,$request,$user){
     // custom user role
     global $user;
     if(isset($user->roles) && is_array($user->roles)){ //array which contains the user roles
          if(in_array("wp_book_user_key",$user->roles)){
               return $redirect_to = site_url()."/my_book";
          }else{
                return $redirect_to;
          }
     }
}
add_filter("login_redirect","owt_login_user_role_filter",10,3);

function owt_logout_user_role_filter(){
     // custom user role
     wp_redirect(site_url()."/my_book");
     exit();
}
add_filter("wp_logout","owt_logout_user_role_filter");

?>
