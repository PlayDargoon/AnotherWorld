<!-- templates/partials/header.html.php -->
<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>

    <span>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
                <tr>
                    <td>
                        <img class="i12img" src="/images/icons/health.png" alt="хп" width="12px" height="12px">
                        <span class="info"><?= $player['vitality'] ?></span>

                    </td>

                </tr>
            </tbody>
        </table>
    </span>


<?php endif; ?>
