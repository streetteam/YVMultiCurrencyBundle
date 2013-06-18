<?php

namespace YV\MultiCurrencyBundle\Model\ModelInterface;

interface FileUploadableInterface
{
    public function getAbsolutePath();
    
    public function getWebPath();
    
    public function setUploadRootDir($uploadRootDir);
    
    public function getUploadRootDir();
    
    public function setUploadDir($uploadDir);
    
    public function getUploadDir();
    
    public function preUpload();
    
    public function upload();
    
    public function removeUpload();
}