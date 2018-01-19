<section class="row">
      <div class="col-sm-12" style="padding: 0;">
        <div id="myCarousel" class="carousel slide" data-ride="carousel" style="-webkit-box-shadow: 0px 7px 43px -1px rgba(0,0,0,0.37);
-moz-box-shadow: 0px 7px 43px -1px rgba(0,0,0,0.37);
box-shadow: 0px 7px 43px -1px rgba(0,0,0,0.37);">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <?php

            $i = 0;
            $stmt = $dbConnection->prepare('SELECT * FROM slides WHERE active = :active');
            $stmt->execute(array(
              ":active" => 1
            ));
            $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

            for($i = 0; $i < count($count); $i++) {
              if($i == 0) {
                echo "<li data-target='#myCarousel' data-slide-to'".$i."' class='active'></li>";
              } else {
                echo "<li data-target='#myCarousel' data-slide-to'".$i."'></li>";
              }
            }

          ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <?php

            $stmt = $dbConnection->prepare('SELECT * FROM slides WHERE active = :active ORDER BY posted DESC');
            $stmt->execute(array(
              ":active" => 1
            ));
            $slides = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($slides > 0) {
              $i = 0;
              foreach($slides as $slide) {
                if($i == 0) {
                  echo '<div class="item active">';
                } else {
                  echo '<div class="item">';
                }
                echo '<img src="'.$slide['img'].'" style="width: 100%;"/>';
                echo '<div class="carousel-caption">';
                echo '<h3>'.$slide['title'].'</h3>';
                echo '<p>'.$slide['description'].'</p>';
                echo '</div>';
                echo '</div>';
                $i++;
              }
            }

          ?>
          
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

  </div> 
</section>