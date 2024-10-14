<?php
class Product
{
    private string $name;
    private string $description;
    private string $image;
    private float $price;
    private string $resized_image;
    private string $shopping_cart_image;

    // Constructor
    public function __construct(string $name, string $description, string $image, float $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->resized_image = $this->resizeImage($image);
        $this->shopping_cart_image = $this->resizeShoppingCartImage($image);
    }

    // Getters
    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getResizedImage(): string
    {
        return $this->resized_image;
    }

    public function getShoppingCartImage(): string
    {
        return $this->shopping_cart_image;
    }

    // Setters
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
        $this->resized_image = $this->resizeImage($image);
        $this->shopping_cart_image = $this->resizeShoppingCartImage($image);
    }

    public function setPrice(float $price): void
    {
        $this->price = round($price, 2);
    }

    public function setShoppingCartImage(string $image): void
    {
        $this->shopping_cart_image = $this->resizeShoppingCartImage($image);
    }

    // Method to resize the image (Product pages)
    private function resizeImage(string $imagePath): string
    {
        return resize_image_gd($imagePath, str_replace('.jpeg', '-resized.jpeg', $imagePath), 500, 500);
    }

    //Method to resize the image (Shopping Cart Page)
    private function resizeShoppingCartImage(string $imagePath): string
    {
        return resize_image_gd($imagePath, str_replace('.jpeg', '-cart-resized.jpeg', $imagePath), 200, 200);
    }
}
