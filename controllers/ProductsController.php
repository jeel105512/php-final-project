<?php

    require_once("./models/ProductModel.php");
    require_once("./models/CartModel.php");

    function index () {
        $products = ProductModel::findAll();

        render("products/index", [
            "products" => $products,
            "title" => "Products"
        ]);
    }

    function _new () {
        $carts = CartModel::findAll();
        render("products/new", [
            "title" => "New Product",
            "action" => "create",
            "carts" => ($carts ?? [])
        ]);
    }

    function edit ($request) {
        if (!isset($request["params"]["id"])) {
            return redirect("", ["errors" => "Missing required ID parameter"]);
        }

        $product = ProductModel::find($request["params"]["id"]);
        if (!$product) {
            return redirect("", ["errors" => "Product does not exist"]);
        }

        $carts = CartModel::findAll();

        render("products/edit", [
            "title" => "Edit Product",
            "product" => $product,
            "edit_mode" => true,
            "action" => "update",
            "carts" => ($carts ?? [])
        ]);
    }

    function create () {
        // Validate field requirements
        validate($_POST, "products/new");
        
        // Write to database if good
        ProductModel::create($_POST);

        redirect("", ["success" => "Product was created successfully"]);
    }

    function update () {
        // Missing ID
        if (!isset($_POST['id'])) {
            return redirect("products", ["errors" => "Missing required ID parameter"]);
        }

        // Validate field requirements
        validate($_POST, "products/edit/{$_POST['id']}");

        // Write to database if good
        ProductModel::update($_POST);
        redirect("", ["success" => "Product was updated successfully"]);
    }

    function delete ($request) {
        // Missing ID
        if (!isset($request["params"]["id"])) {
            return redirect("products", ["errors" => "Missing required ID parameter"]);
        }

        ProductModel::delete($request["params"]["id"]);

        redirect("", ["success" => "Product was deleted successfully"]);
    }

    function validate ($package, $error_redirect_path) {
        $fields = ["product_name", "cart_id"];
        $errors = [];

        // No empty fields
        foreach ($fields as $field) {
            if (empty($package[$field])) {
                $humanize = ucwords(str_replace("_", " ", $field));
                $errors[] = "{$humanize} cannot be empty";
            }
        }

        if (count($errors)) {
            return redirect($error_redirect_path, ["form_fields" => $package, "errors" => $errors]);
        }
    }

?>