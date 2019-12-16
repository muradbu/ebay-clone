<?php

/**
 *
 * Redirect to the given url
 *
 * @param string $url The url to redirect to.
 *
 */
function redirect($url)
{
    echo "<script> location.replace('$url'); </script>";
}
