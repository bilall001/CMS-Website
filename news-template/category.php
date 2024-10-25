<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                include "config.php";
                if (isset($_GET['cid'])) {
                    $cat_id = $_GET['cid'];
                }
                $limit = 3;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $offset = ((int)$page - 1) * $limit;
                $sql = "SELECT * FROM post 
                LEFT JOIN category ON post.category = category.category_id
                LEFT JOIN user ON post.author = user.user_id
                WHERE category_id = $cat_id
                ORDER BY post.post_id DESC LIMIT $offset,$limit
                ;";
                 $result = mysqli_query($connect, $sql) or die("query failed");
                 if(mysqli_num_rows($result)>0){
                     while ($row = mysqli_fetch_assoc($result)) {
                         ?>
                         <h2 class="page-heading fw-bold text-capitalize"><?php echo $row['category_name']?></h2>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?<?php echo $row['post_id']?>"><img src="admin/upload/<?php echo $row['post_img']?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row['post_id']?>'><?php echo $row['title']?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category'];?>'><?php echo $row['category_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?aid=<?php echo $row['user_id'];?>'><?php echo $row['username']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo $row['description']?>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                 }
                }
                            ?>
                               <?php
                      $sqli1 = "SELECT post FROM category
                                WHERE category_id = $cat_id    
                      ";
                      $result1 = mysqli_query($connect, $sqli1) or die("Query failed.");
                      $count = mysqli_num_rows($result1);
                      if ($count > 0) {
                          $total_records = $count;
                          $limit = 3;
                          $per_page = ceil($total_records / $limit);
                          echo '<ul class="pagination admin-pagination">';
                          if ($page > 1) {
                              echo '<li><a href=index.php?cidd='.$cat_id.'&page=' . ($page - 1) . '>Prev</a></li>';
                          }
                          for ($i = 1; $i <= $per_page; $i++) {
                              if ($i == $page) {
                                  $active = "active";
                              } else {
                                  $active = "";
                              }
                              echo "<li class={$active}><a href='index.php?cidd='.$cat_id.'&page={$i}'>{$i}</a></li>";
                          }
                          if ($per_page > $page) {
                              echo '<li><a href=index.php?cidd='.$cat_id.'&page=' . ($page + 1) .'>Next</a></li>';
                          }
                          echo '</ul>';
                      }
                        ?>
                    <!-- <ul class='pagination'>
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                    </ul> -->
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
