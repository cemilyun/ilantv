<?php
include 'topbar.php';
 ?>
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                    <li class="breadcrumb-item"><a href="product-list">İlanlar</a></li>
                    <li class="breadcrumb-item active">Ödeme Ekranı</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
        <!-- Checkout Start -->
        <div class="checkout">
            <div class="container-fluid"> 
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-inner">
                            <div class="billing-address">
                                <h2>Fatura Adresi</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>İsim</label>
                                        <input class="form-control" type="text" placeholder="İsim">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Soyisim</label>
                                        <input class="form-control" type="text" placeholder="Soyisim">
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control" type="text" placeholder="E-mail">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Telefon</label>
                                        <input class="form-control" type="text" placeholder="Telefon No">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Adres</label>
                                        <input class="form-control" type="text" placeholder="Adres">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Ülke</label>
                                        <select class="custom-select">
                                            <option selected>Türkiye</option>
                                            <option>Azerbaycan</option>
                                            <option>Yunanistan</option>
                                            <option>Gürcistan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>İl</label>
                                        <input class="form-control" type="text" placeholder="İl">
                                    </div>
                                    <div class="col-md-6">
                                        <label>İlçe</label>
                                        <input class="form-control" type="text" placeholder="İlçe">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Posta Kodu</label>
                                        <input class="form-control" type="text" placeholder="Posta Kodu">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="shipto">
                                            <label class="custom-control-label" for="shipto">Farklı Adrese Gönder</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="shipping-address">
                                <h2>Gönderi Adresi</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>İsim</label>
                                        <input class="form-control" type="text" placeholder="İsim">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Soyisim</label>
                                        <input class="form-control" type="text" placeholder="Soyisim">
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control" type="text" placeholder="E-mail">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Telefon</label>
                                        <input class="form-control" type="text" placeholder="Telefon">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Adres</label>
                                        <input class="form-control" type="text" placeholder="Adres">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Ülke</label>
                                        <select class="custom-select">
                                            <option selected>Türkiye</option>
                                            <option>Azerbaycan</option>
                                            <option>Yunanistan</option>
                                            <option>Gürcistan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>İl</label>
                                        <input class="form-control" type="text" placeholder="İl">
                                    </div>
                                    <div class="col-md-6">
                                        <label>İlçe</label>
                                        <input class="form-control" type="text" placeholder="İlçe">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Posta Kodu</label>
                                        <input class="form-control" type="text" placeholder="Posta Kodu">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout-inner">
                            <div class="checkout-summary">
                                <h1>Sepet Toplam</h1>
                                <p>Ürün Adı<span>$99</span></p>
                                <p class="sub-total">Ara Toplam<span>$99</span></p>
                                <p class="ship-cost">Kargo Ücret<span>$1</span></p>
                                <h2>Genel Toplam<span>$100</span></h2>
                            </div>

                            <div class="checkout-payment">
                                <div class="payment-methods">
                                    <h1>Ödeme Yöntemleri</h1>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-1" name="payment">
                                            <label class="custom-control-label" for="payment-1">Paypal</label>
                                        </div>
                                        <div class="payment-content" id="payment-1-show">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt orci ac eros volutpat maximus lacinia quis diam.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-2" name="payment">
                                            <label class="custom-control-label" for="payment-2">Havale/EFT</label>
                                        </div>
                                        <div class="payment-content" id="payment-2-show">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt orci ac eros volutpat maximus lacinia quis diam.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-3" name="payment">
                                            <label class="custom-control-label" for="payment-3">Kapıda Ödeme</label>
                                        </div>
                                        <div class="payment-content" id="payment-3-show">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt orci ac eros volutpat maximus lacinia quis diam.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-4" name="payment">
                                            <label class="custom-control-label" for="payment-4">Kredi Kartı</label>
                                        </div>
                                        <div class="payment-content" id="payment-4-show">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt orci ac eros volutpat maximus lacinia quis diam.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout-btn">
                                    <button>Siparişi Onayla</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Checkout End -->
        
<?php 
include 'footer.php';
?>