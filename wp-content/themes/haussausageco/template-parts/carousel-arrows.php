<?php
/**
 * Template part for displaying carousel arrows
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package haussausageco
 */

$carousel__id = $args['id']; ?>

<a class="carousel-control-prev" href="<?php echo $carousel__id; ?>" role="button" data-slide="prev">
   <svg xmlns="http://www.w3.org/2000/svg" width="18.813" height="29.313" viewBox="0 0 18.813 29.313">
      <path d="M-2724.775,1325.6l-16.407-13.3,16.407-13.2" transform="translate(2742.182 -1297.695)"
         stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke-dasharray="1 4" />
   </svg>
   <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="<?php echo $carousel__id; ?>" role="button" data-slide="next">
   <svg xmlns="http://www.w3.org/2000/svg" width="18.813" height="29.313" viewBox="0 0 18.813 29.313">
      <path d="M-2724.775,1325.6l-16.407-13.3,16.407-13.2" transform="translate(-2723.369 1327.008) rotate(180)"
         stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke-dasharray="1 4" />
   </svg>
   <span class="sr-only">Next</span>
</a>