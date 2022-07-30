<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
<?php
$ads = $Ad->all(['sh'=>1]);
foreach ($ads as $key => $ad) {
    echo $ad['text'].'&nbsp;&nbsp;/&nbsp;&nbsp;';
}
?>
</marquee>