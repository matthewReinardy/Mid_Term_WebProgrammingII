<?php
class ShoppingCart
{
    public array $items = [];

    // Add item to the cart, storing the name, quantity, price, and image link in the cart
    public function addItem(Product $product, int $quantity): void
    {
        $this->items[$product->getName()] = [
            'name' => $product->getName(),
            'quantity' => $quantity,
            'price' => round($product->getPrice(), 2),
            'image' => $product->getImage(),
        ];
    }

    // Get all items in the cart
    public function getItems(): array
    {
        return $this->items;
    }

    //Get total items in the cart
    public function getTotalItems()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['quantity'];
        }
        return $total;
    }

    // Calculate discount based on session start time
    public function calculateTotalCost(): array
    {
        $discountRate = 0;

        // Calculations for discount (0.05 for odd and 0.10 for even)
        if (isset($_SESSION['session_start_time'])) {
            $sessionSeconds = date('s', $_SESSION['session_start_time']);
            if ($sessionSeconds % 2 == 0) {
                $discountRate = 0.10;
            } else {
                $discountRate = 0.05;
            }
        }

        // Calculate total cost
        $totalCostBeforeDiscount = 0;
        foreach ($this->getItems() as $item) {
            $totalCostBeforeDiscount += $item['price'] * $item['quantity'];
        }
        $discountAmount = $totalCostBeforeDiscount * $discountRate;
        $totalCostAfterDiscount = $totalCostBeforeDiscount - $discountAmount;

        return [
            'totalBeforeDiscount' => $totalCostBeforeDiscount,
            'discountAmount' => $discountAmount,
            'totalAfterDiscount' => $totalCostAfterDiscount,
        ];
    }

    //Shutdown function, similar to how I did the bingo game shutdown
    public function shutdown(): void
    {
        $_SESSION['thank_you_message'] = "Thank you for your purchase!";
        header("Location: shoppingCartPage.php");
        exit();
    }
}
