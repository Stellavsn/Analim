<?php include __DIR__ . '/../layout.php'; ?>

<h2>Mes sessions</h2>

<?php if(empty($lesParticipations)): ?>
    <p style="font-style: italic; color: #666;">Vous n'êtes inscrit à aucune session pour le moment.</p>
    <a href="index.php?c=session&a=list">📋 Voir toutes les sessions disponibles</a>
<?php else: ?>
    <table border="1" style="border-collapse: collapse; width: 100%; margin-top: 20px;">
        <thead>
            <tr style="background-color: #f0f0f0;">
                <th style="padding: 10px;">Description</th>
                <th style="padding: 10px;">Date</th>
                <th style="padding: 10px;">Créneau</th>
                <th style="padding: 10px;">Prix (€)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lesParticipations as $p): ?>
                <?php
                // Extraire date et créneau
                $date = date('d/m/Y', strtotime($p->getDateHeure()));
                $heure = date('H:i:s', strtotime($p->getDateHeure()));
                $creneau = ($heure === '08:00:00') ? '🌅 Matin (8h-12h)' : '☀️ Après-midi (14h-18h)';
                ?>
                <tr>
                    <td style="padding: 8px;"><?= htmlspecialchars($p->getDescription()) ?></td>
                    <td style="padding: 8px;"><?= htmlspecialchars($date) ?></td>
                    <td style="padding: 8px;"><?= $creneau ?></td>
                    <td style="padding: 8px;"><?= htmlspecialchars($p->getPrixSession()) ?> €</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <p style="margin-top: 20px;">
        <strong>Total :</strong> <?= count($lesParticipations) ?> session(s)
    </p>
<?php endif; ?>