<?php if(have_posts($object)) {?>
    <?php $url = Posts::getMeta($object->id, 'video_url', true);?>
    <div class="video-gallery">
        <div class="video-gallery-sidebar-box">
            <iframe id="video-gallery-main"
                    src="https://www.youtube.com/embed/<?php echo Url::getYoutubeID($url);?>"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
            </iframe>
            <div class="video-gallery-info">
                <h3 class="header"><?= $object->title;?></h3>
                <div class="excerpt"><?php echo $object->excerpt;?></div>
                <div class="social-block">
                    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
                    <div class="social-btns">
                        <a class="btn facebook" href="javascript:;" onclick="window.open('http://www.facebook.com/sharer.php?u=<?= fullurl();?>', 'Chia sẽ sản phẩm này cho bạn bè', 'menubar=no,toolbar=no,resizable=no,scrollbars=no, width=600,height=455')"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn twitter" href="javascript:;" onclick="window.open('https://twitter.com/home?status=<?= fullurl();?>')"><i class="fab fa-twitter"></i></a>
                        <a class="btn google" href="javascript:;" onclick="window.open('https://mail.google.com/mail/u/0/?view=cm&to&su=<?= $object->title;?>&body=<?= fullurl();?>&bcc&cc&fs=1&tf=1', 'Chia sẽ sản phẩm này cho bạn bè', 'menubar=no,toolbar=no,resizable=no,scrollbars=no, width=600,height=455')"><i class="fab fa-google-plus-g"></i></a>
                        <script src="https://sp.zalo.me/plugins/sdk.js"></script>
                        <a class="btn skype zalo-share-button" data-href="<?php echo Url::current();?>" data-oaid="3986611713288256895" data-layout="4" data-color="blue" data-customize=true>
                            <?php echo Template::img(Url::base(PTG_PATH.'assets/images/Zalo-Icon.png')) ;?>
                        </a>
                        <a class="btn skype" data-fancybox="gallery" href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo Url::current();?>">
                            <?php echo Template::img('https://static.thenounproject.com/png/138360-200.png');?>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            $args = array(
                'where' => array('public' => 1, 'trash' => 0, 'post_type' => $object->post_type),
                'params' => array( 'limit' => 6 ),
                'related' => $object->id
            );

            // Get visble related products then sort them at random.
            $args['related_post'] = Posts::gets( $args );
            ?>
            <div class="video-gallery-related">
                <h3 class="header text-left" style="text-align: left;">VIDEO LIÊN QUAN</h3>
                <div class="video-gallery-category row">
                    <?php foreach ($args['related_post'] as $key => $item): $url = Posts::getMeta($item->id, 'video_url', true); ?>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="item video-section-outer">
                                <div class="img video-section ">
                                    <a href="<?php echo $url;?>" data-fancybox>
                                        <?php Template::img($item->image, $item->title);?>
                                        <div class="title">
                                            <h3><?php echo $item->title;?></h3>
                                        </div>
                                        <div class="mfp-video play-now">
                                            <i class="icon fa fa-play"></i>
                                            <span class="ripple"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>

    <style>
        #video-gallery-main { margin-top: 30px;}
        .video-gallery-info {
            background-color: #33495E;
            color:#fff;
            padding:30px; margin: 0 50px;
            position: relative; top:-30px;
        }
        .video-gallery-info h3 {
            text-align: left;  color:#fff;
            font-size: 25px; font-weight: bold;
            line-height: 35px; margin-top: 0; margin-bottom: 20px;
        }
        .video-gallery-info .excerpt {
            color: #949494; margin-bottom: 20px;
        }
        .social-block img {
            width: 30px;
            margin-right: 10px;
            position: relative; z-index: 9;
        }
        .social-block .social-btns .btn,
        .social-block .social-btns .btn:before,
        .social-block .social-btns .btn .fab {
            -webkit-transition: all 0.35s;
            transition: all 0.35s;
            -webkit-transition-timing-function: cubic-bezier(0.31, -0.105, 0.43, 1.59);
            transition-timing-function: cubic-bezier(0.31, -0.105, 0.43, 1.59);
        }
        .social-block .social-btns .btn:before {
            top: 90%;
            left: -110%;
        }
        .social-block .social-btns .btn .fab {
            -webkit-transform: scale(0.8);
            transform: scale(0.8);
        }
        .social-block .social-btns .btn.facebook:before {
            background-color: #3b5998;
        }
        .social-block .social-btns .btn.facebook .fab {
            color: #3b5998;
        }
        .social-block .social-btns .btn.twitter:before {
            background-color: #3cf;
        }
        .social-block .social-btns .btn.twitter .fab {
            color: #3cf;
        }
        .social-block .social-btns .btn.google:before {
            background-color: #dc4a38;
        }
        .social-block .social-btns .btn.google .fab {
            color: #dc4a38;
        }
        .social-block .social-btns .btn.dribbble:before {
            background-color: #f26798;
        }
        .social-block .social-btns .btn.dribbble .fa {
            color: #f26798;
        }
        .social-block .social-btns .btn.skype:before {
            background-color: #00aff0;
        }
        .social-block .social-btns .btn.skype .fab {
            color: #00aff0;
        }
        .social-block .social-btns .btn:focus:before,
        .social-block .social-btns .btn:hover:before {
            top: -10%;
            left: -10%;
        }
        .social-block .social-btns .btn:focus .fab,
        .social-block .social-btns .btn:hover .fab {
            color: #fff;
            -webkit-transform: scale(1);
            transform: scale(1);
        }
        .social-block .social-btns .btn {
            display: inline-block;
            background-color: #fff;
            width: 40px;
            height: 40px;
            line-height: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-radius: 28%;
            box-shadow: 0 5px 15px -5px rgba(0,0,0,0.1);
            opacity: 0.99;
            padding:5px;
        }
        .social-block .social-btns .btn:before {
            content: '';
            width: 120%;
            height: 120%;
            position: absolute;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        .social-block .social-btns .btn .fab {
            font-size: 20px;
            vertical-align: middle;
        }
        .social-block .social-btns .btn:hover img {
            filter:saturate(8);
        }
    </style>

    <script defer>
        $(function(){
            let iframeV = $('#video-gallery-main');
            let widthV = iframeV.width();
            iframeV.css('height', (widthV*9/16)+'px');
        });
    </script>
<?php } ?>