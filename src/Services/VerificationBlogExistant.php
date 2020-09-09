<?php
namespace App\Services;

abstract class VerificationBlogExistant{
    
    protected function verificationBlogExistant(int $id, int $blog_id)
    {
        $request_uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
        if  ($blog_id < "1" || $blog_id > $id) {
            if (preg_match('/^\/blog\-(\d+)$/', $request_uri)) {
                header("Location:/liste-des-blogs");
            } elseif (preg_match('/^\/modifier\-blog\-(\d+)$/', $request_uri)) {
                header("Location:modifier-blogs");
            } else {
                header("Location:/");
            } 
        }
    }

}