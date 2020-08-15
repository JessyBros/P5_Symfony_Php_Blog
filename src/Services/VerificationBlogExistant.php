<?php
namespace App\Services;

abstract class VerificationBlogExistant{
    
    protected function verificationBlogExistant(int $id, int $blog_id)
    {
        if  ($blog_id < "1" || $blog_id > $id) {
            if (preg_match('/^\/blog\-(\d+)$/', $_SERVER['REQUEST_URI'])) {
                header("Location:/liste-des-blogs");
            } elseif (preg_match('/^\/modifier\-blog\-(\d+)$/', $_SERVER['REQUEST_URI'])) {
                header("Location:modifier-blogs");
            } else {
                header("Location:/");
            } 
        }
    }

}