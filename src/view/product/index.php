<section id="product-management">
    <h1>Gestion des Produits</h1>

    <a href="?controller=product&action=createProductForm" class="btn-create">Ajouter un produit</a>

    <?php if (isset($products) && count($products) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['description']); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?>€</td>
                        <td>
                            <a href="?controller=product&action=editProduct&id=<?php echo $product['id']; ?>">Modifier</a>
                            <a href="?controller=product&action=deleteProduct&id=<?php echo $product['id']; ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun produit disponible pour le moment.</p>
    <?php endif; ?>

    <?php if (isset($success_message)): ?>
        <p class="success-message"><?php echo $success_message; ?></p>
    <?php endif; ?>
</section>
