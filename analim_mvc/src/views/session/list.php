<?php include __DIR__ . '/../layout.php'; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div style="color: green; padding: 10px; border: 1px solid green; margin-bottom: 10px;">
        <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<h2>Liste des sessions</h2>
<a href="index.php?c=session&a=addForm">➕ Ajouter une session</a>

<table border="1" style="margin-top: 20px; border-collapse: collapse; width: 100%;">
    <thead>
        <tr style="background-color: #f0f0f0;">
            <th style="padding: 10px;">Description</th>
            <th style="padding: 10px;">Date</th>
            <th style="padding: 10px;">Créneau</th>
            <th style="padding: 10px;">Prix (€)</th>
            <?php if(isset ($_SESSION['email'])) : ?>
            <th style="padding: 10px;">Actions</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sessions as $session): ?>
            <?php
            // Extraire date et créneau
            $date = date('d/m/Y', strtotime($session['date_heure']));
            $heure = date('H:i:s', strtotime($session['date_heure']));
            $creneau = ($heure === '08:00:00') ? '🌅 Matin (8h-12h)' : '☀️ Après-midi (14h-18h)';
            ?>
            <tr>
                <td style="padding: 8px;"><?= htmlspecialchars($session['description']) ?></td>
                <td style="padding: 8px;"><?= htmlspecialchars($date) ?></td>
                <td style="padding: 8px;"><?= $creneau ?></td>
                <td style="padding: 8px;"><?= htmlspecialchars($session['prix_session']) ?></td>

                <?php if(isset ($_SESSION['email'])) : ?>
                  <td style="padding: 8px;">
                      <?php if (!empty($_SESSION['email']) && $inscriptionRepo->estInscrit($id_congressiste, $session['id_session'])): ?>
                          <a href="index.php?c=session&a=desinscrire&id=<?= $session['id_session'] ?>" 
                            onclick="return confirm('Se désinscrire ?')">
                            Se désinscrire ❌
                          </a>
                      <?php elseif (!empty($_SESSION['email'])): ?>
                          <a href="index.php?c=session&a=inscrire&id=<?= $session['id_session'] ?>">
                              S'inscrire ✅
                          </a>
                      <?php endif; ?>
                      <?php if(isset ($_SESSION['email']) && $_SESSION['email'] == "visentin.stella@gmail.com"): ?>
                        <a href="index.php?c=session&a=editForm&id=<?= $session['id_session'] ?>">Modifier ✏️</a>
                        <a href="index.php?c=session&a=delete&id=<?= $session['id_session'] ?>" 
                          onclick="return confirm('Supprimer cette session ?')">
                          Supprimer 🗑️
                        </a>
                      <?php endif; ?>
                  </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (empty($sessions)): ?>
    <p style="margin-top: 20px; font-style: italic; color: #666;">Aucune session disponible pour le moment.</p>
<?php endif; ?>