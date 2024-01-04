<script setup >
import HeaderTop from './header-components/HeaderTop.vue';
import MainMenu from './header-components/MainMenu.vue';
import HeaderCampaign from './header-components/HeaderCampaign.vue';
import { onMounted } from 'vue';

onMounted(() => {
  var body = document.body;
  var isStickyHeader = body.classList.contains('sticky-header');

  if (isStickyHeader) {
    var stickyPlaceHolder = document.getElementById('axil-sticky-placeholder');
    var menu = document.querySelector('.axil-mainmenu');
    var menuH = menu.offsetHeight;
    var topHeaderH = document.querySelector('.axil-header-top').offsetHeight || 0;
    var headerCampaign = document.querySelector('.header-top-campaign').offsetHeight || 0;
    var targrtScroll = topHeaderH + headerCampaign;

    window.addEventListener('scroll', function() {
      if (window.pageYOffset > targrtScroll) {
        menu.classList.add('axil-sticky');
        stickyPlaceHolder.style.height = menuH + 'px';
      } else {
        menu.classList.remove('axil-sticky');
        stickyPlaceHolder.style.height = '0';
      }
    });
  }
});
</script>
<template lang="">
    
<header class="header axil-header header-style-5">
    <HeaderTop/>
    <!-- Start Mainmenu Area  -->
    <div id="axil-sticky-placeholder"></div>
<MainMenu/>
<HeaderCampaign/>
        <!-- End Mainmenu Area -->
 
    </header>
    
</template>

<style></style>