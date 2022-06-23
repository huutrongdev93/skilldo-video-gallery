<?php
/**
Plugin name     : Video Gallery
Plugin class    : video_gallery
Plugin uri      : http://sikido.vn
Description     : Tạo thư viện video cho website
Author          : SKDSoftware Dev Team
Version         : 1.1.0
*/
const VDG_NAME = 'video-gallery';

const VDG_KEY = 'video-gallery';

define( 'VDG_PATH', Path::plugin(VDG_NAME));

class video_gallery {

    private $name = 'video_gallery';

    function __construct() {
        $this->loadDependencies();
        new Video_Gallery_Taxonomy();
        new Video_Gallery_Roles();
    }

    public function active() {
        $template  = [
            'post-video-gallery.php'            => VDG_NAME.'/template/post-video-gallery.php',
            'post-video-category.php'           => VDG_NAME.'/template/post-video-category.php',
            'template-post-video-gallery.php'   => VDG_NAME.'/template/template-post-video-gallery.php',
            'template-post-video-category.php'  => VDG_NAME.'/template/template-post-video-category.php',
        ];
        foreach ($template as $file_name => $file_path) {
            $file_new  = Path::theme($file_name, true);
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
    }

    public function uninstall(): void {
    }
    private function loadDependencies(): void {
        require_once VDG_PATH.'/video-gallery-taxonomy.php';
        require_once VDG_PATH.'/video-gallery-roles.php';
    }
}

new video_gallery();
