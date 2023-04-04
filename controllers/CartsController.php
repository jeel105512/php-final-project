<?php

    require_once("./models/CartModel.php");

    function index () {
        $carts = CartModel::findAll();

        render("carts/index", [
            "carts" => $carts,
            "title" => "Carts"
        ]);
    }

    function _new () {
        render("carts/new", [
            "title" => "New Cart",
            "action" => "create"
        ]);
    }

    function edit ($request) {
        if (!isset($request["params"]["id"])) {
            return redirect("", ["errors" => "Missing required ID parameter"]);
        }

        $cart = CartModel::find($request["params"]["id"]);
        if (!$cart) {
            return redirect("", ["errors" => "Cart does not exist"]);
        }

        render("carts/edit", [
            "title" => "Edit Cart",
            "cart" => $cart,
            "edit_mode" => true,
            "action" => "update"
        ]);
    }

    function create () {
        // Validate field requirements
        validate($_POST, "carts/new");
        
        // Write to database if good
        CartModel::create($_POST);

        redirect("carts", ["success" => "Cart was created successfully"]);
    }

    function update () {
        // Missing ID
        if (!isset($_POST['id'])) {
            return redirect("carts", ["errors" => "Missing required ID parameter"]);
        }

        // Validate field requirements
        validate($_POST, "carts/edit/{$_POST['id']}");

        // Write to database if good
        CartModel::update($_POST);
        redirect("carts", ["success" => "Cart was updated successfully"]);
    }

    function delete ($request) {
        // Missing ID
        if (!isset($request["params"]["id"])) {
            return redirect("carts", ["errors" => "Missing required ID parameter"]);
        }

        try {
            CartModel::delete($request["params"]["id"]);
            redirect("carts", ["success" => "Cart was deleted successfully"]);
        } catch (\Throwable $th) {
            redirect("carts", ["errors" => "Cart was not deleted as it contain products"]);
        }

        CartModel::delete($request["params"]["id"]);

        redirect("carts", ["success" => "Cart was deleted successfully"]);
    }

    function validate ($package, $error_redirect_path) {
        $fields = ["cart_name"];
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