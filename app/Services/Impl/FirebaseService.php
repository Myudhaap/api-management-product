<?php

namespace App\Services\Impl;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\File;

class FirebaseService
{
    private StorageClient $firebase;
    private $bucket;

    public function __construct()
    {
        $serviceAccountPath = storage_path("firebase_credential.json");

        $this->firebase = new StorageClient([
            "projectId" => "management-product-dfe97",
            "keyFilePath" => $serviceAccountPath
        ]);

        $this->bucket = $this->firebase->bucket("management-product-dfe97.appspot.com");
    }

    public function upload($file, $path): array
    {
        $timestamp = round(microtime(true) * 1000);
        $filePath = $timestamp."-".$file->getClientOriginalName();

        $fileUpload = $this->bucket->upload(
            fopen($file->getRealPath(), "r"),
            ["name" => $path.$filePath]
        );


        return [
            "fileUpload" => $fileUpload,
            "filePath" => $filePath
        ];
    }

    public function update($file, $path, $filePath): array
    {
        $object = $this->bucket->object($path.$filePath);

        if($object->exists()){
            $object->delete();
        }

        return $this->upload($file, $path);
    }
}
