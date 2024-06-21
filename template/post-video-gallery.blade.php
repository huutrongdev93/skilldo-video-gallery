@if(have_posts($object))
    @php $url = Posts::getMeta($object->id, 'video_url', true); @endphp
    <div class="video-gallery">
        <div class="video-gallery-sidebar-box">
            <iframe id="video-gallery-main"
                    src="https://www.youtube.com/embed/{!! Url::getYoutubeID($url) !!}"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
            </iframe>
            <div class="video-gallery-info">
                <h3 class="header" style="display: none;">{!! $object->title !!}</h3>
                <div class="excerpt">{!! $object->excerpt !!}</div>
                <div class="social-block">
                    <div class="social-btns">
                        <a class="btn facebook" href="javascript:;" onclick="window.open('http://www.facebook.com/sharer.php?u={!! Url::current() !!}', 'Chia sẽ sản phẩm này cho bạn bè', 'menubar=no,toolbar=no,resizable=no,scrollbars=no, width=600,height=455')"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn twitter" href="javascript:;" onclick="window.open('https://twitter.com/home?status={!! Url::current() !!}')"><i class="fab fa-twitter"></i></a>
                        <a class="btn google" href="javascript:;" onclick="window.open('https://mail.google.com/mail/u/0/?view=cm&to&su={!! $object->title !!}&body={!! Url::current() !!}&bcc&cc&fs=1&tf=1', 'Chia sẽ sản phẩm này cho bạn bè', 'menubar=no,toolbar=no,resizable=no,scrollbars=no, width=600,height=455')"><i class="fab fa-google-plus-g"></i></a>
                        <script src="https://sp.zalo.me/plugins/sdk.js"></script>
                        <a class="btn skype zalo-share-button" data-href="{!! Url::current() !!}" data-oaid="3986611713288256895" data-layout="4" data-color="blue" data-customize=true>
                            {!! Template::img(Url::base(VDG_PATH.'assets/images/Zalo-Icon.png')) !!}
                        </a>
                        <a class="btn skype" data-fancybox="gallery" href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={!! Url::current() !!}">
                            {!! Template::img('https://static.thenounproject.com/png/138360-200.png') !!}
                        </a>
                    </div>
                </div>
            </div>
            @php
                // Get visble related products then sort them at random.
                $related = Posts::where('public', 1)
                ->where('trash', 0)
                ->where('post_type', $object->post_type)
                ->limit(6)
                ->related($object)
                ->fetch();
            @endphp
            <div class="video-gallery-related">
                <h3 class="header text-left" style="text-align: left;">VIDEO LIÊN QUAN</h3>
                <div class="video-gallery-category row">
                    @foreach ($related as $key => $item)
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="item video-section-outer">
                                <div class="img video-section ">
                                    <a href="{!! Posts::getMeta($item->id, 'video_url', true) !!}" data-fancybox>
                                        {!! Template::img($item->image, $item->title) !!}
                                        <div class="title">
                                            <h3>{{ $item->title }}</h3>
                                        </div>
                                        <div class="mfp-video play-now">
                                            <i class="icon fa fa-play"></i>
                                            <span class="ripple"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
@endif