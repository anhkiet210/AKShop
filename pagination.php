<!-- store bottom filter -->
<?php
    if($lhh == '' or $lhh == '0'){
        $pag_lhh = '';
    }else{
        $pag_lhh = '&lhh='.$lhh;
    }
    if($s == ''){
        $pag_s = '&s=sort_n';
    }else{
        $pag_s = '&s='.$s;
    }
    if($search == ''){
        $pag_search = '';
    }else{
        $pag_search = '&search='.$search;
    }
    if($m == '' or $m == '0'){
        $pag_m = '';
    }else{
        $pag_m = '&m='.$m;
    }
?> 
<div class="store-filter clearfix">
    <ul class="store-pagination">
        <?php
            if($current_page > 3){
                $first_page = 1;
                ?>
                    <li><a href="?p=<?=$first_page?><?=$pag_lhh?><?=$pag_s?><?=$pag_search?><?=$pag_m?>">First</a></li>
                <?php 
            }
            if($current_page > 1){
                $pre_page = $current_page - 1;
                ?>
                    <li><a href="?p=<?=$pre_page?><?=$pag_lhh?><?=$pag_s?><?=$pag_search?><?=$pag_m?>">Pre</a></li>
                <?php 
            }
            for($num=1; $num<=$totalPages; $num++){
                if($num != $current_page){
                    if(($num > $current_page -3) && ($num < $current_page + 3)){
                        ?>
                            <li><a href="?p=<?=$num?><?=$pag_lhh?><?=$pag_s?><?=$pag_search?><?=$pag_m?>"><?=$num?></a></li>
                        <?php 
                    }
                }else{
                    ?>
                        <li style="background-color: #D10024;"><strong><?=$num?></strong></li>
                    <?php
                }
            }
            if($current_page < $totalPages - 1){
                $next_page = $current_page + 1;
                ?>
                    <li><a href="?p=<?=$next_page?><?=$pag_lhh?><?=$pag_s?><?=$pag_search?><?=$pag_m?>">Next</a></li>
                <?php 
            }
            if($current_page <= $totalPages - 3){
                $end_page = $totalPages;
                ?>
                <li><a href="?p=<?=$end_page?><?=$pag_lhh?><?=$pag_s?><?=$pag_search?><?=$pag_m?>">End</a></li>
                <?php 
            }
        ?>
    </ul>
</div> 
<!-- /store bottom filter -->