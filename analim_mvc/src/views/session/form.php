<?php include __DIR__ . '/../layout.php'; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 10px;">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<h2>Créer une nouvelle session</h2>

<form method="post" action="index.php?c=session&a=add">
    <label>Description :</label>
    <input type="text" name="description" required><br><br>
    
    <label>Date :</label>
    <input type="date" name="date" required min="<?= date('Y-m-d') ?>"><br><br>
    
    <fieldset style="border: 1px solid #ccc; padding: 10px; margin-bottom: 15px;">
        <legend>Créneau :</legend>
        <label style="display: block; margin-bottom: 10px;">
            <input type="radio" name="creneau" value="matin" required>
            <strong>Matin</strong> (8h00 - 12h00)
        </label>
        <label style="display: block;">
            <input type="radio" name="creneau" value="apres-midi" required>
            <strong>Après-midi</strong> (14h00 - 18h00)
        </label>
    </fieldset>
    
    <label>Prix (€) :</label>
    <input type="number" name="prix_session" step="0.01" required><br><br>
    
    <button type="submit">Créer la session</button>
    <a href="index.php?c=session&a=list">Annuler</a>
</form>