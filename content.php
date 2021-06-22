     

<!-- Newsletter Start -->
<div class="newsletter">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h1>Gelişmelerden Haberdar Ol!</h1>
            </div>
            <div class="col-md-6">
                <div class="form">
                    <input type="email" value="Email adresini yaz.">
                    <button>Kaydet</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter End -->        

<!-- Recent Product Start -->
<div class="recent-product product">
    <div class="container-fluid">
        <div class="section-header">
            <h1>Son İlanlar</h1>
        </div>
        <div class="row align-items-center product-slider product-slider-4">
           <?php 
           $digersor = $conn->prepare("SELECT * FROM urunler ORDER BY id DESC");
           $digersor->execute();
           while ($diger = $digersor->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="col-lg-3">
                <div class="product-item">
                    <div class="product-title">
                        <a href="product-detail?urun=<?php echo $diger['id'] ?>"><?php echo $diger["title"] ?></a>
                    </div>
                    <div class="product-image">
                        <a href="product-detail?urun=<?php echo $diger['id'] ?>">
                            <img src="<?php echo $diger['image'] ?>" style="width: 100%; height: 200px;">
                        </a>
                    </div>
                    <div class="product-price">
                        <h3><span>₺</span><?php echo $diger['amount'] ?></h3>
                        <a class="btn" href="product-detail?urun=<?php echo $diger['id'] ?>"><i class="fas fa-angle-double-right"></i>İlana Git</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</div>
<!-- Recent Product End -->

<!-- Review Start -->
<div class="review">
    <div class="container-fluid">
        <div class="row align-items-center review-slider normal-slider">
            <?php 
            $yorumsor = $conn->prepare("SELECT * FROM yorumlar ORDER BY id DESC");
            $yorumsor->execute();
            while ($yorum = $yorumsor->fetch(PDO::FETCH_ASSOC)) { 

                $isor = $conn->prepare("SELECT title,image FROM urunler where id=:id");
                $isor->execute(array('id' => $yorum['urunid']));
                $i = $isor->fetch(PDO::FETCH_ASSOC);

                ?>
                <div class="col-md-6">
                    <div class="review-slider-item">
                        <div class="review-img">
                            <img src="<?php echo $i['image'] ?>" alt="Image">
                        </div>
                        <div class="review-text">
                            <h2><?php echo $yorum["name"] ?></h2>
                            <h3><?php
                            echo $i['title'];

                            ?></h3>
                            <div class="ratting">
                                <?php for ($i=0; $i <$yorum['stars'] ; $i++) { ?>
                                   <i class="fa fa-star"></i>
                               <?php } ?>
                           </div>
                           <p>
                            <?php echo $yorum["comment"] ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</div>
<!-- Review End -->        
