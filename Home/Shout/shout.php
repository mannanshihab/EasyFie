<section id="Shout" class="p-2">
    <div class="container mt-5">
        <h2 class="text-uppercase text-center pt-5 pb-5">Shout</h2>
        <div class="row">

            <?php
            //include('config2.php');
            include('config.php');
            $connect = mysqli_connect("$sql_db_host", "$sql_db_user", "$sql_db_pass", "$sql_db_name");
            mysqli_set_charset($connect, "utf8");

            $loc = "Location: ";
            $sql_query = "select Wo_Products.name, Wo_Products.description, Wo_Products.location, Wo_Products.tag, Wo_Products_Media.image, Wo_Posts.post_id FROM ((Wo_Products INNER JOIN Wo_Products_Media ON Wo_Products.id = Wo_Products_Media.product_id and Wo_Products.remark = 'Shout')INNER JOIN Wo_Posts ON Wo_Posts.product_id = Wo_Products.id) ORDER BY Wo_Products.id DESC limit 6 ";
            $resultset = mysqli_query($connect, $sql_query) or die("database error:" . mysqli_error($connect));
            while ($rows = mysqli_fetch_array($resultset)) { ?>
                <!-- post one -->
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4 p-1">
                            <img src="<?= str_replace('_image', '_image_small',  $rows["image"]); ?>" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href="post/<?php echo $rows["post_id"]; ?>" target="_blank">
                                    <h5 class="card-title">
                                        <?= substr($rows['name'], 0, 42) . '...'; ?>
                                    </h5>
                                </a>
                                <p class="card-text">
                                    <?= substr(strip_tags($rows['description']), 0, 230) . '....'; ?>
                                </p>
                                <div class="card-text">
                                    <i class="fa fa-tags">Tags</i>
                                    <?php foreach (explode(',', $rows['tag']) as $tags) { ?>
                                        <a href="#" class="btn btn-sm">
                                            <?= !empty($tags) ? $tags : ''; ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="location">
                            <i class="fas fa-map-marker-alt">
                                <?= $rows["location"]; ?>
                            </i>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!--End post one -->

        </div>
    </div>
</section>
