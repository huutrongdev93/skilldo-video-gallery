<div class="video-gallery-category row">
    <?php foreach ($objects as $key => $item): $url = Posts::getMeta($item->id, 'video_url', true); ?>
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
<nav class="text-center">
    <?= (isset($pagination))?$pagination->html():'';?>
</nav>