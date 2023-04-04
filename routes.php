<?php

    /**
     * Routes are responsible for matching a requested path
     * with a controller and an action. The controller represents
     * a collection of functions you want associated, usually, with
     * a resource. The action is the specific function you want to call.
     */

    $routes = [
        "get" => [
            [
                "pattern" => "/",
                "controller" => "ProductsController",
                "action" => "index"
            ],
            [
                "pattern" => "/products",
                "controller" => "ProductsController",
                "action" => "index"
            ],
            [
                "pattern" => "/products/new",
                "controller" => "ProductsController",
                "action" => "_new"
            ],
            [
                "pattern" => "/products/:id",
                "controller" => "ProductsController",
                "action" => "show"
            ],
            [
                "pattern" => "/products/edit/:id",
                "controller" => "ProductsController",
                "action" => "edit"
            ],
            [
                "pattern" => "/products/delete/:id",
                "controller" => "ProductsController",
                "action" => "delete"
            ],
            [
                "pattern" => "/carts",
                "controller" => "CartsController",
                "action" => "index"
            ],
            [
                "pattern" => "/carts/new",
                "controller" => "CartsController",
                "action" => "_new"
            ],
            [
                "pattern" => "/carts/:id",
                "controller" => "CartsController",
                "action" => "show"
            ],
            [
                "pattern" => "/carts/edit/:id",
                "controller" => "CartsController",
                "action" => "edit"
            ],
            [
                "pattern" => "/carts/delete/:id",
                "controller" => "CartsController",
                "action" => "delete"
            ],
            [
                "pattern" => "/users/new",
                "controller" => "UsersController",
                "action" => "_new"
            ],
            [
                "pattern" => "/login",
                "controller" => "UsersController",
                "action" => "login"
            ],
            [
                "pattern" => "/logout",
                "controller" => "UsersController",
                "action" => "logout"
            ],
        ],
        "post" => [
            [
                "pattern" => "/products/create",
                "controller" => "ProductsController",
                "action" => "create"
            ],
            [
                "pattern" => "/products/update",
                "controller" => "ProductsController",
                "action" => "update"
            ],
            [
                "pattern" => "/carts/create",
                "controller" => "CartsController",
                "action" => "create"
            ],
            [
                "pattern" => "/carts/update",
                "controller" => "CartsController",
                "action" => "update"
            ],
            [
                "pattern" => "/users/create",
                "controller" => "UsersController",
                "action" => "create"
            ],
            [
                "pattern" => "/authenticate",
                "controller" => "UsersController",
                "action" => "authenticate"
            ],
        ]
    ];

?>