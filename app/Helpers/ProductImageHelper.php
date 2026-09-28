<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ProductImageHelper
{
    public static function getImageByProductName($productName, $categoryName = null)
    {
        $categoryImages = [
            'Buku Tulis' => [
                'url' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=600&h=600&fit=crop',
                'thumb' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&h=300&fit=crop'
            ],
            'Alat Tulis' => [
                'url' => 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=600&h=600&fit=crop',
                'thumb' => 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=300&h=300&fit=crop'
            ],
            'Alat Gambar' => [
                'url' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=600&h=600&fit=crop',
                'thumb' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=300&h=300&fit=crop'
            ],
            'Tas Sekolah' => [
                'url' => 'https://images.unsplash.com/photo-1622560480605-d6c1c4e3d0f0?w=600&h=600&fit=crop',
                'thumb' => 'https://images.unsplash.com/photo-1622560480605-d6c1c4e3d0f0?w=300&h=300&fit=crop'
            ],
            'Seragam' => [
                'url' => 'https://images.unsplash.com/photo-1593032465175-481ac7f401a0?w=600&h=600&fit=crop',
                'thumb' => 'https://images.unsplash.com/photo-1593032465175-481ac7f401a0?w=300&h=300&fit=crop'
            ],
            'Perlengkapan' => [
                'url' => 'https://images.unsplash.com/photo-1523362628745-0c100150b504?w=600&h=600&fit=crop',
                'thumb' => 'https://images.unsplash.com/photo-1523362628745-0c100150b504?w=300&h=300&fit=crop'
            ],
        ];

        $defaultImage = [
            'url' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=600&h=600&fit=crop',
            'thumb' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&h=300&fit=crop'
        ];

        if ($categoryName && isset($categoryImages[$categoryName])) {
            return $categoryImages[$categoryName];
        }

        return $defaultImage;
    }

    public static function getImageUrl($productName, $categoryName = null)
    {
        $image = self::getImageByProductName($productName, $categoryName);
        return $image['url'];
    }

    public static function getThumbUrl($productName, $categoryName = null)
    {
        $image = self::getImageByProductName($productName, $categoryName);
        return $image['thumb'];
    }

    public static function resolveImage($imagePath, $categoryName = null, $productName = null)
    {
        if (!empty($imagePath)) {
            return Str::startsWith($imagePath, 'http')
                ? $imagePath
                : asset('storage/' . $imagePath);
        }

        return self::getImageUrl($productName, $categoryName);
    }

    public static function resolveThumb($imagePath, $categoryName = null, $productName = null)
    {
        if (!empty($imagePath)) {
            return Str::startsWith($imagePath, 'http')
                ? $imagePath
                : asset('storage/' . $imagePath);
        }

        return self::getThumbUrl($productName, $categoryName);
    }
}