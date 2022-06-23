<!DOCTYPE html>
<html lang="<?= Language::current();?>" <?php do_action('in_tag_html');?>>
    <?php $this->template->render_include('head'); ?>
    <body class="" <?php do_action('in_tag_body');?> style="height: auto">
        <?php $this->template->render_include('mobile-search'); ?>
        <div id="td-outer-wrap">
            <?php $this->template->render_include('top'); ?>
            <div class="warper">
                <?php $this->template->render_include('banner'); ?>
                <div class="container">
                    <?php $this->template->render_view(); ?>
                </div>
                <style type="text/css">
                    .video-gallery-category { overflow: hidden; }
                    .video-gallery-category .item { margin: 10px 0; overflow: hidden; position: relative }
                    .video-gallery-category .item .img {
                        overflow: hidden;
                        border-radius:5px;
                    }
                    .video-gallery-category .item .img img {
                        -webkit-transform: scale(1.03);
                        -ms-transform: scale(1.03);
                        transform: scale(1.03);
                        -webkit-transition: -webkit-transform .5s ease-out;
                        transition: -webkit-transform .5s ease-out;
                        -o-transition: transform .5s ease-out;
                        transition: transform .5s ease-out;
                        transition: transform .5s ease-out,-webkit-transform .5s ease-out;
                        width:100%; height: 100%; object-fit: cover;
                    }
                    .video-gallery-category .item .title {
                        position: absolute; top:0; left:0;
                        width: 100%; height: 100%;
                        background-color: rgba(0,0,0,0.5);
                        padding:20px;
                        opacity: 0;
                        transition: 0.8s all;
                    }
                    .video-gallery-category .item .title h3 {
                        margin-top: 70%;
                        font-size: 18px; line-height: 25px; letter-spacing: 5px;
                        text-align: left;
                        color:#fff;
                        text-transform: uppercase;
                        opacity: 0;
                        margin-left: -10px;
                        transition: 0.5s all;
                    }
                    .video-gallery-category .item .title h3:after {
                        content: "";
                        display: table;
                        margin: 10px 0;
                        height: 1px;
                        width: 0;
                        background: #fff;
                        transition: 0.8s all;
                    }
                    .video-gallery-category .item:hover .img,
                    .video-gallery-category .item.active .img {
                        box-shadow: 2px 2px 20px #333;
                    }
                    .video-gallery-category .item:hover .title,
                    .video-gallery-category .item.active .title {
                        opacity: 1; transition: 0.3s all;
                    }
                    .video-gallery-category .item:hover .title h3,
                    .video-gallery-category .item.active .title h3 {
                        opacity: 1;
                        margin-left: 0px;
                        transition: 0.5s all;
                    }
                    .video-gallery-category .item:hover .title h3:after,
                    .video-gallery-category .item.active .title h3:after {
                        width: 100%;
                        transition: 0.8s all;
                    }
                    .video-gallery-category .item:hover img {
                        -webkit-transform: scale(1.03) translateX(1%);
                        -ms-transform: scale(1.03) translateX(1%);
                        transform: scale(1.03) translateX(1%);
                    }
                    @media (max-width: 768px) {
                        .video-gallery-category .item .img {
                            box-shadow: 2px 2px 20px #333;
                        }
                        .video-gallery-category .item .title {
                            opacity: 1; transition: 0.3s all;
                        }
                        .video-gallery-category .item .title h3 {
                            opacity: 1;
                            margin-left: 0px;
                            transition: 0.5s all;
                        }
                        .video-gallery-category .item .title h3:after {
                            width: 100%;
                            transition: 0.8s all;
                        }
                    }

                    .item .play-now {
                        position: absolute;
                        left: 50%;
                        top: 50%;
                        display: block;
                        border-radius: 50%;
                        z-index: 10;
                        width: 60px;
                        height: 60px;
                        -webkit-transform: translateX(-50%) translateY(-50%);
                        transform: translateX(-50%) translateY(-50%);
                        transform-origin: center center;
                        opacity: 0.8;
                    }
                    .item .play-now .icon {
                        position: absolute;
                        left: 50%;
                        top: 50%;
                        height: 65px;
                        width: 65px;
                        text-align: center;
                        line-height: 65px;
                        color: #fff;
                        z-index: 1;
                        font-size: 20px;
                        padding-left: 5px;
                        display: block;
                        -webkit-transform: translateX(-50%) translateY(-50%);
                        transform: translateX(-50%) translateY(-50%);
                        -webkit-transform-origin: center;
                        transform-origin: center center;
                        -webkit-border-radius: 50%;
                        -moz-border-radius: 50%;
                        -ms-border-radius: 50%;
                        -o-border-radius: 50%;
                        border-radius: 50%;
                        -webkit-box-shadow: 0 5px 10px 0 rgba(255, 255, 255, .1);
                        -moz-box-shadow: 0 5px 10px 0 rgba(255, 255, 255, .1);
                        -ms-box-shadow: 0 5px 10px 0 rgba(255, 255, 255, .1);
                        -o-box-shadow: 0 5px 10px 0 rgba(255, 255, 255, .1);
                        box-shadow: 0 5px 10px 0 rgba(255, 255, 255, .1);
                        background-color: var(--theme-color);
                        opacity: 0.5;
                    }
                    .item .play-now .ripple,
                    .item .play-now .ripple:before,
                    .item .play-now .ripple:after {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        height: 65px;
                        width: 65px;
                        -webkit-transform: translateX(-50%) translateY(-50%);
                        transform: translateX(-50%) translateY(-50%);
                        -webkit-transform-origin: center;
                        transform-origin: center center;
                        -webkit-border-radius: 50%;
                        -moz-border-radius: 50%;
                        -ms-border-radius: 50%;
                        -o-border-radius: 50%;
                        border-radius: 50%;
                        -webkit-box-shadow: 0 0 0 0 rgba(255, 255, 255, .3);
                        -moz-box-shadow: 0 0 0 0 rgba(255, 255, 255, .3);
                        -ms-box-shadow: 0 0 0 0 rgba(255, 255, 255, .3);
                        -o-box-shadow: 0 0 0 0 rgba(255, 255, 255, .3);
                        box-shadow: 0 0 0 0 rgba(255, 255, 255, .3);
                        -webkit-animation: ripple 3s infinite;
                        -moz-animation: ripple 3s infinite;
                        -ms-animation: ripple 3s infinite;
                        -o-animation: ripple 3s infinite;
                        animation: ripple 3s infinite;
                    }
                    .item .play-now .ripple:before {
                        -webkit-animation-delay: .9s;
                        -moz-animation-delay: .9s;
                        -ms-animation-delay: .9s;
                        -o-animation-delay: .9s;
                        animation-delay: .9s;
                        content: "";
                        position: absolute;
                    }
                    .item .play-now .ripple:after {
                        -webkit-animation-delay: .6s;
                        -moz-animation-delay: .6s;
                        -ms-animation-delay: .6s;
                        -o-animation-delay: .6s;
                        animation-delay: .6s;
                        content: "";
                        position: absolute;
                        background-color: var(--theme-color);
                    }

                    @-webkit-keyframes ripple {
                        70% {box-shadow: 0 0 0 70px rgba(255, 255, 255, 0);}
                        100% {box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);}
                    }
                    @keyframes ripple {
                        70% {box-shadow: 0 0 0 70px rgba(255, 255, 255, 0);}
                        100% {box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);}
                    }

                </style>
                <script>
                    $(function () {
                        let itemW = $('.video-gallery-category .item').first().width();
                        $('.video-gallery-category .item .img').css('height', itemW+'px');
                    });
                </script>
            </div>
            <?php $this->template->render_include('footer'); ?>
        </div>
    </body>
</html>