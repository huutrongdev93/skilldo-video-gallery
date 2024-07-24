<?php
const VDG_NAME = 'video-gallery';

const VDG_KEY = 'video-gallery';

define( 'VDG_PATH', Path::plugin(VDG_NAME));

class video_gallery {

    private string $name = 'video_gallery';

    function __construct() {
        $this->loadDependencies();
        new Video_Gallery_Taxonomy();
        new Video_Gallery_Roles();
    }

    public function active(): void
    {
        $this->insertFile();
        // Add caps for Root role
        $role = Role::get('root');
        $role->add('view_video_gallery');
        $role->add('add_video_gallery');
        $role->add('edit_video_gallery');
        $role->add('delete_video_gallery');
        // Add caps for Administrator role
        $role = Role::get('administrator');
        $role->add('view_video_gallery');
        $role->add('add_video_gallery');
        $role->add('edit_video_gallery');
        $role->add('delete_video_gallery');

        //demo data
        $postVideo = [
            [
                'title' => 'Hướng dẫn tạo video mẫu',
                'url'   => 'https://www.youtube.com/watch?v=alLs9S4pwo0',
            ],
            [
                'title' => 'Bộ sưu tập nhạc piano ấm áp nhẹ nhàng rất hay',
                'url'   => 'https://www.youtube.com/watch?v=yLpCHjbPsXY',
            ],
            [
                'title' => 'Relaxing music without ads Ghibli Studio Ghibli Concert',
                'url'   => 'https://www.youtube.com/watch?v=Njt1io9jakQ',
            ],
            [
                'title' => 'Peaceful piano and rain sounds- Relaxing sleep music, Meditation music',
                'url'   => 'https://www.youtube.com/watch?v=FzTsTdoyMK4',
            ],
            [
                'title' => 'Peaceful & Beautiful Sleep Music for Stress Relief',
                'url'   => 'https://www.youtube.com/watch?v=5C_HA-7rFGk',
            ],
        ];

        foreach ($postVideo as $video) {

            $post = [
                'title' => $video['title'], 'image' => Template::imgLink($video['url']), 'post_type' => VDG_KEY
            ];

            $id = Posts::insert($post);

            if(!is_skd_error($id)) {
                Posts::updateMeta($id, 'video_url', $video['url']);
            }
        }
    }

    public function restart(): void
    {
        $this->insertFile();
    }

    public function uninstall(): void {
    }

    public function insertFile():void
    {
        $store = Storage::disk('views');

        $templateLayout  = [
            'template-post-video-gallery.blade.php'           => 'plugins/'.VDG_NAME.'/template/template-post-video-gallery.blade.php',
            'template-post-video-category.blade.php'  => 'plugins/'.VDG_NAME.'/template/template-post-video-category.blade.php',
        ];

        foreach ($templateLayout as $file_name => $file_path) {
            if($store->has(Theme::name().'/theme-child/layouts/'.$file_name)) {
                continue;
            }
            $store->copy($file_path, Theme::name().'/theme-child/layouts/'.$file_name);
        }

        $templateViews  = [
            'post-video-gallery.blade.php'  => 'plugins/'.VDG_NAME.'/template/post-video-gallery.blade.php',
            'post-video-category.blade.php' => 'plugins/'.VDG_NAME.'/template/post-video-category.blade.php',
        ];

        foreach ($templateViews as $file_name => $file_path) {
            if($store->has(Theme::name().'/theme-child/'.$file_name)) {
                continue;
            }
            $store->copy($file_path, Theme::name().'/theme-child/'.$file_name);
        }
    }

    private function loadDependencies(): void {
        require_once VDG_PATH.'/video-gallery-taxonomy.php';
        require_once VDG_PATH.'/video-gallery-roles.php';
    }
}

new video_gallery();
