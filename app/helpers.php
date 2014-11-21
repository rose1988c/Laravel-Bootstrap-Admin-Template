<?php
/**
 * Get gravatar url by email
 * @param $email
 * @return string
 */
function gratavarUrl($email)
{
    return "http://www.gravatar.com/avatar/" . md5($email) . "?s=100";
}

/**
 * Get image by qiniu
 * 
 * @return string
 */
function QiniuImageViewUrl($key, array $options = array())
{
    if (empty($options))
    {
        return Config::get('qiniu.url') . $key;
    } else {
        return Config::get('qiniu.url') . $key . '?imageView/' . join('/', $options);
    }
}