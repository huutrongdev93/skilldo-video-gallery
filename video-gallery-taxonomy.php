<?php
Class Video_Gallery_Taxonomy {

    function __construct() {
        $this->register();
        add_filter('manage_post_'.VDG_KEY.'_columns', array($this, 'columnHeader'), 10);
        add_filter('manage_post_'.VDG_KEY.'_custom_column', array($this, 'columnData'), 10, 2);
        add_filter('admin_form_validation', array($this, 'validation'), 10, 2);
        add_action('save_object', array($this, 'saveMetaBox'), 10, 2);
        Metabox::add('video_url', 'Url youtube', 'Video_Gallery_Taxonomy::urlForm', ['module' => 'post_'.VDG_KEY]);
    }

    public function register() {
        Taxonomy::addPost(VDG_KEY, [
            'labels' => array(
                'name'          => __('Videos'),
                'singular_name' => __('Videos'),
            ),
            'show_in_nav_menus'  => false,
            'show_in_nav_admin'  => true,
            'menu_icon' => '<img src="'.VDG_PATH.'/assets/images/icon-300x300.png'.'" alt="">',
            'supports' => array(
                'group' => array('info', 'seo', 'media'),
                'field' => array('title', 'excerpt', 'seo_title', 'seo_description', 'seo_keywords', 'image')
            ),
            'capabilities' => array(
                'view'      => 'view_video_gallery',
                'add'       => 'add_video_gallery',
                'edit'      => 'edit_video_gallery',
                'delete'    => 'delete_video_gallery',
            ),
        ]);
        Taxonomy::addCategory('video-category', VDG_KEY, [
            'labels' => array(
                'name'          => __('Danh mục video'),
                'singular_name' => __('Danh mục video'),
            ),
            'show_in_nav_menus'  => true,
        ]);
    }

    public function columnHeader( $columns ) {
        $columnsnew = [];
        foreach ($columns as $key => $value) {
            $columnsnew[$key] = $value;
            if($key == 'title') {
                $columnsnew['taxonomy-video-category'] = 'Danh mục';
            }
        }
        $columns = $columnsnew;
        return $columns;
    }

    public function columnData( $column_name, $item ) {
        switch ( $column_name ) {
            case 'taxonomy-video-category':
                $str = '';
                $categories = PostCategory::getsByPost($item->id, Qr::set('cate_type', 'video-category')
                    ->select('categories.id', 'categories.name', 'categories.slug'));
                foreach ($categories as $value) {
                    $str .= sprintf('<a href="%s">%s</a>, ', URL_ADMIN.'/post/post-categories/edit/'.$value->slug.'?cate_type=video-category', $value->name);
                }
                echo trim($str,', ');
                break;
        }
    }

    static function urlForm($object) {
        $url = (have_posts($object)) ? Posts::getMeta($object->id, 'video_url', true) : '';
        $Form = new FormBuilder();
        $Form->add('video_url', 'text', ['label' => 'Url video youtube'], $url)->html(false);
    }

    public function validation($errors, $module) {

        if($module == 'post' && Admin::getPostType() == VDG_KEY) {
            //code
            $product_related = Request::Post('video_url');

            if(empty($product_related)) {
                return new SKD_Error('error', 'Đường dẫn video không được để trống.');
            }
        }

        return $errors;
    }

    public function saveMetaBox($post_id, $module) {

        if($module == 'post' && Admin::getPostType() == VDG_KEY) {

            $video = Posts::get($post_id);

            if(have_posts($video)) {

                $url = Request::Post('video_url');

                Posts::updateMeta($post_id, 'video_url', $url);

                if(empty($video->image)) {

                    $video->image = Template::imgLink($url);

                    Posts::insert((array)$video);
                }
            }
        }
    }
}

