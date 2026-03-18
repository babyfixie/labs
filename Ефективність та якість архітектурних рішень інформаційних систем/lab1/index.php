<?php

interface StorageInterface
{
    public function uploadFile($filePath);
    public function downloadFile($fileName);
}

class LocalDiskStorage implements StorageInterface
{
    public function uploadFile($filePath)
    {
        echo "[LocalDisk] Uploading file: " . $filePath . "<br>";
        return true;
    }

    public function downloadFile($fileName)
    {
        echo "[LocalDisk] Downloading file: " . $fileName . "<br>";
        return "/local/path/" . $fileName;
    }
}

class AmazonS3Storage implements StorageInterface
{
    public function uploadFile($filePath)
    {
        echo "[AmazonS3] Uploading file: " . $filePath . "<br>";
        return true;
    }

    public function downloadFile($fileName)
    {
        echo "[AmazonS3] Downloading file: " . $fileName . "<br>";
        return "https://s3.amazonaws.com/bucket/" . $fileName;
    }
}

class StorageManager
{
    private static $instance = null;
    private $storage;

    private function __construct($storage)
    {
        $this->storage = $storage;
    }

    // метод доступу до єдиного екземпляра
    public static function getInstance($storage)
    {
        if (self::$instance === null) {
            self::$instance = new StorageManager($storage);
        }
        return self::$instance;
    }

    // метод  отримання сховища
    public function getStorage()
    {
        return $this->storage;
    }
}

class User
{
    private $name;
    private $userStorage;

    public function __construct($name, $storage)
    {
        $this->name = $name;
        $this->userStorage = $storage;
    }

    public function upload($filePath)
    {
        $this->userStorage->uploadFile($filePath);
    }

    public function download($fileName)
    {
        $this->userStorage->downloadFile($fileName);
    }
}

function main()
{
    // користувач 1 використовує локальне сховище
    $localStorage = new LocalDiskStorage();
    $user1 = new User("Петя", $localStorage);
    $user1->upload("doc1.txt");

    // користувач 2 використовує Amazon S3
    $s3Storage = new AmazonS3Storage();
    $user2 = new User("Вася", $s3Storage);
    $user2->download("image.png");

    // один екземпляр менеджера сховищ
    $manager = StorageManager::getInstance($localStorage);
    $sharedStorage = $manager->getStorage();
    $sharedStorage->uploadFile("shared.txt");
}

// запуск
main();

/* 1. Користувач Петя завантажує файл doc1.txt у локальне сховище
2. Користувач Вася завантажує файл image.png у сховище Amazon S3
3. Через StorageManager завантажується файл shared.txt у локальне сховище */

?>