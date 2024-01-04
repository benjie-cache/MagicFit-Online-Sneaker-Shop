<template lang="">
    <div class="col-lg-3">
        <div class="axil-shop-sidebar">
            <div class="d-lg-none">
                <button class="sidebar-close filter-close-btn">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="toggle-list product-categories">
                <h6 class="title">Brands</h6>
                <div class="shop-submenu">
                    <ul>
                        <li class="current-cat"><a href="#">Adidas</a></li>
                        <li><a href="#">Nike</a></li>
                        <li><a href="#">Loius</a></li>
                       
                      
                    </ul>
                </div>
            </div>
            <div class="toggle-list product-categories product-categories">
                <h6 class="title">CATEGORIES</h6>
                <div class="shop-submenu">
                    <ul>
                        <li class="chosen"><a href="#">Lifestyle</a></li>
                        <li><a href="#">Training & Gym</a></li>
                        <li><a href="#">Running</a></li>
                        <li><a href="#">Basket Ball</a></li>
                    </ul>
                </div>
            </div>
            <div class="toggle-list product-categories product-gender">
                <h6 class="title">GENDER</h6>
                <div class="shop-submenu">
                    <ul>
                        <li class="chosen"><a href="#">Men (40)</a></li>
                        <li><a href="#">Women (56)</a></li>
                        <li><a href="#">Unisex (18)</a></li>
                    </ul>
                </div>
            </div>
            <div class="toggle-list product-color">
                <h6 class="title">COLORS</h6>
                <div class="shop-submenu">
                    <ul>
                        <li class="chosen">
                            <a href="#" class="color-extra-01"></a>
                        </li>
                        <li><a href="#" class="color-extra-02"></a></li>
                        <li><a href="#" class="color-extra-03"></a></li>
                        <li><a href="#" class="color-extra-04"></a></li>
                        <li><a href="#" class="color-extra-05"></a></li>
                        <li><a href="#" class="color-extra-06"></a></li>
                        <li><a href="#" class="color-extra-07"></a></li>
                        <li><a href="#" class="color-extra-08"></a></li>
                        <li><a href="#" class="color-extra-09"></a></li>
                        <li><a href="#" class="color-extra-10"></a></li>
                        <li><a href="#" class="color-extra-11"></a></li>
                    </ul>
                </div>
            </div>

            <div class="toggle-list product-size">
                <h6 class="title">SIZE</h6>
                <div class="shop-submenu">
                    <ul>
                        <li class="chosen"><a href="#">XS</a></li>
                        <li><a href="#">S</a></li>
                        <li><a href="#">M</a></li>
                        <li><a href="#">L</a></li>
                        <li><a href="#">XL</a></li>
                        <li><a href="#">XXL</a></li>
                        <li><a href="#">3XL</a></li>
                        <li><a href="#">4XL</a></li>
                    </ul>
                </div>
            </div>
            <div class="toggle-list product-price-range">
                <h6 class="title">PRICE</h6>
                <div class="shop-submenu">
                    <ul>
                        <li class="chosen"><a href="#">30</a></li>
                        <li><a href="#">5000</a></li>
                    </ul>
                    <form action="#" class="mt--25">
                        <div id="slider-range"></div>
                        <div class="flex-center mt--20">
                            <span class="input-range">Price: </span>
                            <input
                                type="text"
                                id="amount"
                                class="amount-range"
                                readonly
                            />
                        </div>
                    </form>
                </div>
            </div>
            <button class="axil-btn btn-bg-primary">All Reset</button>
        </div>
        <!-- End .axil-shop-sidebar -->
    </div>
</template>
<script>
export default {};
</script>
<style lang=""></style>
