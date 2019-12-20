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

/**
 * @param string $url the url it needs to look like
 * @param string $callback if set this will be returned if true
 * @return bool url is active or not
 */
function active_url($url, $callback = '')
{
    $request_uri = $_SERVER['REQUEST_URI'];
    if (strpos($url,':id') > 0) {
        $request_uri = preg_replace("/[0-9]{1,}/", "*", $request_uri);
    }
    if (strpos($url,'?') < 0) {
        $request_uri = preg_replace("/\?.{0,}/", "", $request_uri);
    }
    if (empty($callback)) {
        return $url === $request_uri || '/'.$url === $request_uri;
    }
    return $url === $request_uri || '/'.$url === $request_uri ? $callback : '';
}
