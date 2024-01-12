<?php
/**
Plugin name     : Video Gallery
Plugin class    : video_gallery
Plugin uri      : http://sikido.vn
Description     : Tạo thư viện video cho website
Author          : SKDSoftware Dev Team
Version         : 1.1.3
*/
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
        $template  = [
            'post-video-gallery.php'            => VDG_NAME.'/template/post-video-gallery.php',
            'post-video-category.php'           => VDG_NAME.'/template/post-video-category.php',
            'template-post-video-gallery.php'   => VDG_NAME.'/template/template-post-video-gallery.php',
            'template-post-video-category.php'  => VDG_NAME.'/template/template-post-video-category.php',
        ];
        foreach ($template as $file_name => $file_path) {
            $file_new  = Path::theme('theme-child/'.$file_name, true);
            $file_path = Path::plugin($file_path, true);
            if(file_exists($file_new)) continue;
            if(file_exists($file_path)) {
                $handle     = file_get_contents($file_path);
                $file_new   = fopen($file_new, "w");
                fwrite($file_new, $handle);
                fclose($file_new);
            }
        }
        // Add caps for Root role
        $role = Role::get('root');
        $role->add_cap('view_video_gallery');
        $role->add_cap('add_video_gallery');
        $role->add_cap('edit_video_gallery');
        $role->add_cap('delete_video_gallery');
        // Add caps for Administrator role
        $role = Role::get('administrator');
        $role->add_cap('view_video_gallery');
        $role->add_cap('add_video_gallery');
        $role->add_cap('edit_video_gallery');
        $role->add_cap('delete_video_gallery');

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

    public function uninstall(): void {
    }
    private function loadDependencies(): void {
        require_once VDG_PATH.'/video-gallery-taxonomy.php';
        require_once VDG_PATH.'/video-gallery-roles.php';
    }
}

new video_gallery();
