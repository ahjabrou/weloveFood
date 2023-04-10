
<section id="premier"  style="position: relative;">


<div class="swiper mySwiper">
        <div class="swiper-wrapper">

          <?php
    // require('connet.php');
    
    
              while($hari = mysqli_fetch_assoc($data1)){
                 ?>
          <div class="swiper-slide">
              <img class="img_scroll" src="<?=$hari['imagepub']?>" alt="image">
          <div class="div_text_scroll"><?=$hari['titre']?><br>  <b><?=$hari['pseudo']?> <b><?=$hari['fonction']?></b></div>
      
          </div>
    

 
<!--fin 3eme scroll-->
<?php
      }
   
?>
        
      </div>
      </div>
</section>

<div class="swiper-button-next" style="height: 80px;width: 50px; position: absolute; color: black; background-color: transparent;font-weight: bold;margin-top: -40px;"></div>
<div class="swiper-button-prev" style="height: 80px;width: 50px; position: absolute; color: black; background-color: transparent;font-weight: bold;margin-top: -40px;"></div>
<!-- Swiper JS pour carousel -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 10,
        spaceBetween: 2,
        slidesPerGroup: 10,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });


      // function ldike(id) {
      //   var count=jQuery('#like'+id).html();
      //   count++;
      //   jQuery('#like'+id).html(count);
      // }

      // $(document).ready(function() {
      //   $('form').submit(function(e) {
      //     e.preventDefault();
      //     const avis = $(this).find('input[name=avis]').val();
      //     const id = $(this).find('input[name=id]').val();
      //     const _this = this
      //     $.post("likeDislike.php", { id, avis }, function(res){
      //       const result = JSON.parse(res)
      //       if(result) {
      //         $(_this).find('input[name=count1]').val(result.like)
      //         $(_this).find('input[name=count2]').val(result.dislike)
      //       }
      //     });
      //   });
      // });

      
</script>