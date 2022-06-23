<?php
Class Video_Gallery_Roles {
    function __construct() {
        add_filter('user_role_editor_group', array($this, 'addGroup'), 1);
        add_filter('user_role_editor_label', array($this, 'addLabel'), 1);
    }
    public function addGroup( $group ) {
        $group['video'] = array(
            'label' => __('Video'),
            'capabilities' => array_keys(static::capabilities())
        );
        return $group;
    }
    public function addLabel( $label ): array {
        return array_merge( $label, static::capabilities() );
    }
    public function capabilities() {
        $label['view_video_gallery']         = 'Xem danh sách video';
        $label['add_video_gallery']          = 'Thêm video';
        $label['edit_video_gallery']         = 'Sửa video';
        $label['delete_video_gallery']       = 'Xóa video';
        return apply_filters('video_capabilities', $label );
    }
}







