<section id="create-edit-product-page">
    <h1><?php echo isset($product) ? 'Modifier un produit' : 'Créer un produit'; ?></h1>

    <form action="?controller=product&action=<?php echo isset($product) ? 'updateProduct' : 'createProduct'; ?>" method="POST" enctype="multipart/form-data">
        <?php if (isset($product)): ?>
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <?php endif; ?>

        <label for="name">Nom du produit :</label>
        <input type="text" id="name" name="name" value="<?php echo isset($product) ? htmlspecialchars($product['name']) : ''; ?>" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?php echo isset($product) ? htmlspecialchars($product['description']) : ''; ?></textarea>

        <label for="price">Prix :</label>
        <input type="number" step="any" id="price" name="price" value="<?php echo isset($product) ? htmlspecialchars($product['price']) : ''; ?>" required>

        <label for="image">Image du produit :</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <button type="submit"><?php echo isset($product) ? 'Modifier' : 'Créer'; ?></button>
    </form>

    <?php if (isset($success_message)): ?>
        <p class="success-message"><?php echo $success_message; ?></p>
    <?php elseif (isset($error_message)): ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>
</section>
