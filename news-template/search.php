<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  
                  <?php
                    include 'config.php';
                    if(isset($_GET['search'])){
                        $search_term = $_GET['search'];
                    }
                    $limit = 3;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $offset = ((int)$page - 1) * $limit;
                    $sqli = "SELECT * from post
                            LEFT JOIN category ON post.category = category.category_id
                            LEFT JOIN user ON post.author = user.user_id
                            WHERE title LIKE '%$search_term%' OR description LIKE '%$search_term%'
                            ORDER BY post.post_id DESC LIMIT $offset,$limit 
                         ";
                         $result = mysqli_query($connect,$sqli) or die("query failed");
                         if(mysqli_num_rows($result) >0){
                            
                            echo "<h2 class='page-heading'>Search : {$search_term}</h2>";
                            while($row = mysqli_fetch_assoc($result)){
                        
                    ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href='single.php?id=<?php echo $row['post_id']?>'><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row['post_id']?>'><?php echo $row['title'];?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category'];?>'><?php echo $row['category_name'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?aid=<?php echo $row['user_id'];?>'><?php echo $row['username'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date'];?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo $row['description'];?>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php  }
                        }else{
                            echo "<h2>No Records found.</h2>";
                        }
                        $sqk = "SELECT * from post
                                where title LIKE '%{$search_term}%' or description LIKE '%{$search_term}%'  ";
                                  $result2 = mysqli_query($connect,$sqk) or die("query failed");
                                  if($count = mysqli_num_rows($result2) >0){
                                    $total_records = $count;
                                    $limit = 3;
                                    $per_page = ceil($total_records / $limit);
                                    echo ' <ul class="pagination">';
                                    
                                        if ($page > 1) {
                                            echo '<li><a href=search.php?page=' . ($page - 1) . '>Prev</a></li>';
                                        }
                                        for ($i = 1; $i <= $per_page; $i++) {
                                            if ($i == $page) {
                                                $active = "active";
                                            } else {
                                                $active = "";
                                            }
                                            echo "<li class={$active}><a href='search.php?page={$i}'>{$i}</a></li>";
                                        }
                                        if ($per_page > $page) {
                                            echo '<li><a href=search.php?page=' . ($page + 1) . '>Next</a></li>';
                                        }
                                    }
                                    echo '</ul>';
                                    
                        ?>
                    
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
