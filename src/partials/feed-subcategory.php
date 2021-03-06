<div class="wide-container">
  <div class="stories-angled">
    <div class="container">
      <!-- TODO: get_subcategory_name() function create for human name -->
      <h1 class="stories-angled__title"><?php //echo get_subcategory_name($cat_id); ?></h1>
    </div>
    <?php
    // alternate classes for each article to tesselate
    $n = 1;
    foreach($articles as $article):
    if($n%2) :
      $storyClassFlag = "edge--both--reverse";
    else :
      $storyClassFlag = "edge--both";
    endif;
    $n++;
    ?>
    <div class="stories-angled__story edge <?php echo $storyClassFlag; ?>">
      <div class="container">
        <div class="row">
          <div class="col-md-auto">
            <a href="<?php echo get_article_link($article->intItemID); ?>">
              <?php if($article->thumb->url != "") : ?>
                <img src="<?php echo $article->thumb->url; ?>" class="stories-angled__story-image"  alt="<?php echo $article->thumb->alt; ?>" />
              <?php else : ?>
                <!-- alt tag is empty, but this is the correct way to display decorative images
                  https://www.w3.org/WAI/tutorials/images/decorative/
                -->
                <img src="<?php echo $GLOBALS['SITE_PATH']; ?>/assets/images/placeholder.jpg" class="stories-angled__story-image"  alt="" role="presentation" />
              <?php endif; ?>
            </a>
          </div>
          <div class="col">
            <p class="stories-angled__story-date">
              <?php echo date('F j, Y', strtotime($article->datModified)); ?>
              <!-- FakeDate 30, 2018 -->
              <?php if($article->bln4H) : echo " | 4-H"; endif; ?>
            </p>
            <a href="<?php echo $GLOBALS['SITE_PATH']; ?>/article/<?php echo $article->intItemID; ?>">
              <h3 class="stories-angled__story-title"><?php echo $article->strTitle ?></h3>
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
    <div class="container" style="margin-top: 5rem;">
      <div class="row">
        <?php
        if(isset($_GET['pc'])) :
          $page_count = (int) $_GET['pc'];
        endif;
        if($page_count < 1) :
        ?>
          <a href="?pc=<?php echo $page_count+1;?>" class="cta cta__primary" style='position:relative;z-index: 3;'>Next Page &raquo;</a>
        <?php
        else :
        ?>
          <div class="col-sm-6">
            <a href="?pc=<?php echo $page_count-1;?>" class="cta cta__primary" style='position:relative;z-index: 3;'>&laquo; Previous Page</a>
          </div>
          <div class="col-sm-6">
            <a href="?pc=<?php echo $page_count+1;?>" class="cta cta__primary" style='position:relative;z-index: 3;'>Next Page &raquo;</a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

