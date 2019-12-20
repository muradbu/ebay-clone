<?php
class SliderHelper
{
  /**
   *
   * Makes the slider indicators to navigate through images.
   *
   * @param string $images Images for slider, used to count through.
   *
   * @return string Return HTML text to display on page.
   *
   */
  public static function makeSlideIndicators($images)
  {
    $output = '';
    $count = 0;
    foreach ($images as $key => $image) {
      if ($count == 0) {
        $output .= '<li data-target="#dynamic_slide_show" data-slide-to="' . $count . '" class="active"></li>';
      } else {
        $output .= '<li data-target="#dynamic_slide_show" data-slide-to="' . $count . '"></li>';
      }
      $count++;
    }
    return $output;
  }

  /**
   *
   * Make the slider images.
   *
   * @param string $images Images to display.
   *
   * @return string Return HTML text to display on the page.
   *
   */
  public static function makeSlides($images)
  {
    $output = '';
    $count = 0;
    foreach ($images as $key => $image) {

      if ($key = "FileName") {
        if ($count == 0) {
          $output .= '<div class="carousel-item active">';
        } else {
          $output .= '<div class="carousel-item">';
        }
        $output .= '<img src="http://iproject1.icasites.nl/pics/' . $image["FileName"] . '" style="height: 500px; width: 500px" /></div>';
        $count++;
      }
    }
    return $output;
  }
}
