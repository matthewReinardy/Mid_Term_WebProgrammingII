<?php
session_start();
class ProductInventory
{
    public $products;

    public function __construct()
    {
        $this->products = [
            // Monitors
            new Product('HyperView Monitor', 'A 24-inch monitor with a sleek design and ultra-fast refresh rate, perfect for gaming and productivity.', '../images/monitor-hyperView.jpeg', '249.99'),
            new Product('Infinity Screen Monitor', 'A 27-inch monitor with stunning clarity and ultra-fast response time.', '../images/monitor-infinityScreen.jpeg', '299.99'),
            new Product('PixelXtreme Monitor', 'A 30-inch monitor offering ultra-high definition and a wide color gamut, ideal for creative professionals.', '../images/monitor-pixelXtreme.jpeg', '349.99'),
            new Product('TrueFrame HDR Monitor', 'A 32-inch monitor with HDR technology for lifelike color and contrast, perfect for entertainment.', '../images/monitor-trueFrame-HDR.jpeg', '399.99'),

            // Keyboards
            new Product('ClickWave Keyboard', 'An ergonomic keyboard with customizable backlighting and programmable keys for enhanced productivity.', '../images/keyboard-clickWave.jpeg', '89.99'),
            new Product('HyperKeys Keyboard', 'A high-performance keyboard with advanced macro capabilities and RGB lighting.', '../images/keyboard-hyperKeys5.jpeg', '109.99'),
            new Product('KeyStorm 9000 Keyboard', 'A mechanical keyboard with ultra-responsive switches, perfect for gaming and typing.', '../images/keyboard-keyStorm-9000.jpeg', '129.99'),
            new Product('TypeMaster Pro Keyboard', 'A professional-grade keyboard designed for writers, featuring a comfortable layout and quiet keys.', '../images/keyboard-typeMaster-pro.jpeg', '99.99'),

            // Mice
            new Product('AeroGrip Max Mouse', 'An ergonomic mouse designed for comfort and precision during long usage.', '../images/mouse-aeroGrip-max.jpeg', '59.99'),
            new Product('Precision Strike V2 Mouse', 'A high-precision mouse designed for gaming, with customizable sensitivity settings.', '../images/mouse-precisionStrike-V2.jpeg', '69.99'),
            new Product('Stealth Track 500 Mouse', 'An ergonomic gaming mouse with customizable RGB lighting and precision sensors for ultimate control.', '../images/mouse-stealthTrack-500.jpeg', '39.99'),
            new Product('Swift Click Pro Mouse', 'A lightweight mouse optimized for speed, featuring a sleek design and advanced tracking technology.', '../images/mouse-swift-click pro.jpeg', '44.99')
        ];
    }

    // Retrieve all products
    public function getAllProducts()
    {
        return $this->products;
    }

    public function getProductsByCategory($start, $length)
    {
        return array_slice($this->products, $start, $length);
    }

    public function findProductByName($name)
    {
        // Convert the search name to lowercase for case-insensitive comparison
        $lowercaseName = strtolower($name);

        foreach ($this->products as $product) {
            // Get the product name and convert it to lowercase
            $productName = strtolower($product->getName());

            // Check if the beginning of the product name matches the search name
            if (substr($productName, 0, strlen($lowercaseName)) === $lowercaseName) {
                return $product;
            }
        }

        return null; // Return null if the product is not found
    }
}
