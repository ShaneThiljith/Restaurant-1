<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orders = json_decode($_POST['orders'], true);
    
    if (!$orders) {
        echo json_encode(["status" => "error", "message" => "Invalid order data"]);
        exit;
    }
    
    $conn = new mysqli("localhost", "root", "", "root");
    
    if ($conn->connect_error) {
        die(json_encode(["status" => "error", "message" => "Database connection failed"]));
    }
    
    foreach ($orders as $order) {
        $name = $conn->real_escape_string($order['name']);
        $price = (int)$order['price'];
        $quantity = (int)$order['quantity'];
        
        if ($quantity > 0) {
            $sql = "INSERT INTO orders (name, price, quantity) VALUES ('$name', $price, $quantity)";
            $conn->query($sql);
        }
    }
    
    $conn->close();
    echo json_encode(["status" => "success", "message" => "Order placed successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now - Harias Restaurant</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: bisque;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .menu-item img {
            width: 80px;
            height: 80px;
            border-radius: 5px;
        }
        .quantity {
            width: 40px;
            text-align: center;
        }
        .order-btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #2761c3;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Your Meal</h1>
        <div class="menu-item">
            <img src="images/biriyani.jpg" alt="Biriyani">
            <span>Biriyani - ₹300</span>
            <input type="number" class="quantity" min="0" value="0">
        </div>
        <div class="menu-item">
            <img src="images/porotta.jpg" alt="Porotta">
            <span>Porotta - ₹50</span>
            <input type="number" class="quantity" min="0" value="0">
        </div>
        <div class="menu-item">
            <img src="images/chicken fridrice.jpg" alt="Fried Rice">
            <span>Fried Rice - ₹200</span>
            <input type="number" class="quantity" min="0" value="0">
        </div>
        <div class="menu-item">
            <img src="images/chilli chicken.jpg" alt="Chicken Chilli">
            <span>Chicken Chilli - ₹250</span>
            <input type="number" class="quantity" min="0" value="0">
        </div>
        <div class="menu-item">
            <img src="images/dragon chicken.jpg" alt="Dragon Chicken">
            <span>Dragon Chicken - ₹280</span>
            <input type="number" class="quantity" min="0" value="0">
        </div>
        <div class="menu-item">
            <img src="images/honey chicken.jpg" alt="Honey Chicken">
            <span>Honey Chicken - ₹260</span>
            <input type="number" class="quantity" min="0" value="0">
        </div>
        <div class="menu-item">
            <img src="images/pepper chicken.jpg" alt="Pepper Chicken">
            <span>Pepper Chicken - ₹270</span>
            <input type="number" class="quantity" min="0" value="0">
        </div>
        <div class="menu-item">
            <img src="images/bbutter arlic chicken.jpg" alt="Butter Garlic Chicken">
            <span>Butter Garlic Chicken - ₹290</span>
            <input type="number" class="quantity" min="0" value="0">
        </div>
        <div class="menu-item">
            <img src="images/mutton curry.jpg" alt="Mutton Curry">
            <span>Mutton Curry - ₹320</span>
            <input type="number" class="quantity" min="0" value="0">
        </div>
        <div class="menu-item">
            <img src="images/mutton pepper fry.jpg" alt="Mutton Pepper Fry">
            <span>Mutton Pepper Fry - ₹340</span>
            <input type="number" class="quantity" min="0" value="0">
        </div>
        <div class="menu-item">
            <img src="images/idli.jpg" alt="Idli">
            <span>Idli - ₹50</span>
            <input type="number" class="quantity" min="0" value="0">
        </div>
        <div class="menu-item">
            <img src="images/checken noodles.jpg" alt="Chicken Noodles">
            <span>Chicken Noodles - ₹180</span>
            <input type="number" class="quantity" min="0" value="0">
        </div>
        <button class="order-btn">Place Order</button>
    </div>
</body>
</html>
