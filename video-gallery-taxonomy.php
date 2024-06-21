<?php
Class Video_Gallery_Taxonomy {

    function __construct() {
        $this->register();
        add_filter('manage_post_'.VDG_KEY.'_columns', array($this, 'columnHeader'), 10);
        add_filter('admin_form_validation', array($this, 'validation'), 10, 3);
        add_action('save_post_object', array($this, 'saveMetaBox'), 10, 2);
        Metabox::add('video_url', 'Url youtube', 'Video_Gallery_Taxonomy::urlForm', ['module' => 'post_'.VDG_KEY]);
        AdminMenu::addSub('galleries', VDG_KEY, 'Video', 'post/?post_type='.VDG_KEY);
        AdminMenu::addSub('galleries', 'video-category', 'Danh mục video', 'post/post-categories?cate_type=video-category&post_type='.VDG_KEY);
    }

    public function register(): void
    {
        Taxonomy::addPost(VDG_KEY, [
            'labels' => array(
                'name'          => __('Videos'),
                'singular_name' => __('Videos'),
            ),
            'show_in_nav_menus'  => false,
            'show_in_nav_admin'  => false,
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
            'show_in_nav_admin'  => true,
        ]);
    }

    public function columnHeader( $columns ): array
    {
        $columnsNew = [];
        foreach ($columns as $key => $value) {
            $columnsNew[$key] = $value;
            if($key == 'title') {
                $columnsNew['taxonomy-video-category'] = [
                    'label' => 'Danh mục',
                    'column' => fn($item, $args) => \SkillDo\Table\Columns\ColumnView::make('category', $item, $args)->html(function ($column) {
                        $str = '';
                        $categories = PostCategory::getsByPost($column->item->id, Qr::set('cate_type', 'video-category')->where('value', 'video-category')
                            ->select('categories.id', 'categories.name', 'categories.slug'));

                        foreach ($categories as $value) {
                            $str .= sprintf('<a href="%s">%s</a>, ', URL_ADMIN . '/post/post-categories/edit/' . $value->slug . '?cate_type=video-category', $value->name);
                        }
                        echo trim($str, ', ');
                    })
                ];
            }
        }
        return $columnsNew;
    }

    static function urlForm($object): void
    {
        $url = (have_posts($object)) ? Posts::getMeta($object->id, 'video_url', true) : '';
        $Form = form();
        $Form->text('video_url', ['label' => 'Url video youtube'], $url)->html(false);
    }

    public function validation($errors, $module, $request) {

        if($module == 'post' && Admin::getPostType() == VDG_KEY) {
            //code
            $product_related = $request->input('video_url');

            if(empty($product_related)) {
                return new SKD_Error('error', 'Đường dẫn video không được để trống.');
            }
        }

        return $errors;
    }

    public function saveMetaBox($post_id, $request): void
    {
        if(Admin::getPostType() == VDG_KEY) {

            $video = Posts::get($post_id);

            if(have_posts($video)) {

                $url = $request->input('video_url');

                Posts::updateMeta($post_id, 'video_url', $url);

                if(empty($video->image)) {

                    Posts::insert([
                        'id'    => $video->id,
                        'image' => Template::imgLink($url)
                    ]);
                }
            }
        }
    }
}

