<?php
require 'vendor/autoload.php';

$s3 = new Aws\S3\S3Client([
    'version' => 'latest',
    'region' => 'us-east-1',
    'endpoint' => 'https://zjkateuajstwfwwcnbdj.supabase.co/storage/v1/s3',
    'use_path_style_endpoint' => true,
    'credentials' => [
        'key' => 'cef9fbfbb7960726587ae9ccd16864c2',
        'secret' => '98f9684bc6653563e2ac68c9773b7c9491f55580268026cf27cf333106f8746b',
    ],
]);

try {
    $result = $s3->listObjectsV2([
        'Bucket' => 'imagenes',
        'Prefix' => 'brands/',
    ]);
    print_r($result);
    echo "SUCCESS\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
