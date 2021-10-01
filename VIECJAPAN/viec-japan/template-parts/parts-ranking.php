<?php if(get_field('ランキングを表示')): ?>
    <div>
        <?php
            $ranking = get_field('ランキング');
            if($ranking == 1) {
                echo '<i class="fa fa-star" aria-hidden="true"></i>';
            }elseif($ranking == 2) {
                echo '<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
            }elseif($ranking == 3) {
                echo '<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
            }elseif($ranking == 4) {
                echo '<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
            }elseif($ranking == 5) {
                echo '<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
            }else {
                echo '<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
            }
        ?>
        (<?php the_field('ランキング') ?>)
    </div>
<?php endif; ?>