<?php include __DIR__ . '/../layout.php'; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 10px;">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<h2>Modifier la session</h2>

<form method="post" action="index.php?c=session&a=edit">
    <input type="hidden" name="id_session" value="<?= $session->getIdSession() ?>">
    
    <label>Description :</label>
    <input type="text" name="description" value="<?= htmlspecialchars($session->getDescription()) ?>" required><br><br>
    
    <label>Date :</label>
    <input type="date" name="date" value="<?= htmlspecialchars($date) ?>" required><br><br>
    
    <fieldset style="border: 1px solid #ccc; padding: 10px; margin-bottom: 15px;">
        <legend>Créneau :</legend>
        <label style="display: block; margin-bottom: 10px;">
            <input type="radio" name="creneau" value="matin" 
                   <?= $creneau === 'matin' ? 'checked' : '' ?> required>
            <strong>Matin</strong> (8h00 - 12h00)
        </label>
        <label style="display: block;">
            <input type="radio" name="creneau" value="apres-midi" 
                   <?= $creneau === 'apres-midi' ? 'checked' : '' ?> required>
            <strong>Après-midi</strong> (14h00 - 18h00)
        </label>
    </fieldset>
    
    <label>Prix (€) :</label>
    <input type="number" name="prix_session" value="<?= htmlspecialchars($session->getPrixSession()) ?>" step="0.01" required><br><br>
    
    <button type="submit">Modifier la session</button>
    <a href="index.php?c=session&a=list">Annuler</a>
</form>