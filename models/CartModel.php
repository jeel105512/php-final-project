<?php

    class CartModel {

        private static $_table = "carts";

        public static function findAll () {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT * FROM {$table}";

            $carts = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $carts;
        }

        public static function find ($id) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT * FROM {$table} WHERE id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $cart = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;
            return $cart;
        }

        public static function create ($package) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "INSERT INTO {$table} (
                cart_name
            ) VALUES (
                :cart_name
            )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":cart_name", $package["cart_name"], PDO::PARAM_STR);
            var_dump($stmt);
            $stmt->execute();
            $conn = null;
        }

        public static function update ($package) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "UPDATE {$table} SET
                cart_name = :cart_name
            WHERE id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":cart_name", $package['cart_name'], PDO::PARAM_STR);
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