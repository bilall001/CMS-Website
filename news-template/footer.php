<div id ="footer">
    <div class="container">
    <?php
    $sqli = "SELECT * from settings";
    $resulti = mysqli_query($connect, $sqli);
    if(mysqli_num_rows($resulti) > 0){
        while($row = mysqli_fetch_assoc($resulti)){
    ?>
        <div class="row">
            <div class="col-md-12">
                <span><?php echo $row['footerdec']?></span>
            </div>
        </div>
    </div>
    <?php
  }
}
    ?>
</div>
</body>
</html>
