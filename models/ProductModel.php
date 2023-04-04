<?php

    class ProductModel {

        private static $_table = "products";

        public static function findAll () {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT products.id, product_name, price, description, carts.cart_name AS cart
                    FROM {$table}
                    JOIN carts ON products.cart_id = carts.id";

            $products = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $products;
        }

        public static function find ($id) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT products.id, product_name, price, description, cart_id, carts.cart_name AS cart
                    FROM {$table}
                    JOIN carts ON products.cart_id = carts.id
                    WHERE products.id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $product = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;
            return $product;
        }

        public static function create ($package) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "INSERT INTO {$table} (
                product_name,
                price,
                description,
                cart_id
            ) VALUES (
                :product_name,
                :price,
                :description,
                :cart_id
            )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":product_name", $package["product_name"], PDO::PARAM_STR);
            $stmt->bindParam(":price", $package["price"], PDO::PARAM_STR); 
            $stmt->bindParam(":description", $package["description"], PDO::PARAM_STR); 
            $stmt->bindParam(":cart_id", $package["cart_id"], PDO::PARAM_INT);
            var_dump($stmt);
            $stmt->execute();
            $conn = null;
        }

        public static function update ($package) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "UPDATE {$table} SET
                product_name = :product_name,
                price = :price,
                description = :description,
                cart_id = :cart_id
            WHERE id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":product_name", $package['product_name'], PDO::PARAM_STR);
            $stmt->bindParam(":price", $package['price'], PDO::PARAM_STR);
            $stmt->bindParam(":description", $package['description'], PDO::PARAM_STR);
            $stmt->bindParam(":cart_id", $package['cart_id'], PDO::PARAM_INT);
            $stmt->bindParam(":id", $package['id'], PDO::PARAM_INT);
            
            $stmt->execute();
            $conn = null;
        }

        public static function delete ($id) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "DELETE FROM {$table} WHERE id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;
        }

    }

?>