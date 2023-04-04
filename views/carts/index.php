<div>
    <h1>List Carts</h1>

    <?php if (isset($carts) && count($carts) > 0): ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Cart Name</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($carts as $cart): ?>
                <tr>
                    <td><?= $cart->cart_name ?></td>
                    <td>
                        <a class="btn btn-warning" href="<?= ROOT_PATH ?>/carts/edit/<?= $cart->id ?>">edit</a>
                        <a class="btn btn-danger" href="<?= ROOT_PATH ?>/carts/delete/<?= $cart->id ?>" onclick="return confirm('Are you sure you want to delete this cart?')">delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php endif ?>




    <section>
        <?php if (isset($carts) && count($carts) > 0): ?>
                <?php foreach ($carts as $cart): ?>
                <div class="cart-card">
                    <div class="name">
                        <div class="cart-name"><?= $cart->cart_name ?> cart</div>
                    </div>
                    <div class="edit-delete">
                        <a href="<?= ROOT_PATH ?>/carts/edit/<?= $cart->id ?>">
                            <div class="edit-icon"><i class="fa-solid fa-pen"></i></div>
                            <div>Edit</div>
                        </a>
                        <a href="<?= ROOT_PATH ?>/carts/delete/<?= $cart->id ?>" onclick="return confirm('Are you sure you want to delete this cart?')">
                            <div class="delete-icon"><i class="fa-solid fa-trash"></i></div>
                            <div>Delete</div>
                        </a>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </section>


</div>