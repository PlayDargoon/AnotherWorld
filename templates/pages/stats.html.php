<!-- templates/pages/stats.html.php -->


<body id="body_id" ignorewebview="true">


    <div class="body">
        <h2>Характеристики</h2>

        <div class="pb">
            <a href="/stats?id=<?= $player['id'] ?>&statId=0">Живучесть</a> |
            <a href="/stats?id=<?= $player['id'] ?>&statId=1">Сила</a> |
            <a href="/stats?id=<?= $player['id'] ?>&statId=2">Защита</a> |
            <a href="/stats?id=<?= $player['id'] ?>&statId=3">Крит</a> |
            <a href="/stats?id=<?= $player['id'] ?>&statId=4">Опыт</a>
        </div>

        <?php if ($statId === 0): ?>
            <div class="pb">
                <div class="pb">
                    <b>Живучесть</b> определяет способность персонажа переносить даже самые опасные ранения.<br>За каждую единицу живучести ты получаешь 10 очков здоровья.<br>
                </div>
                <img src="/images/icons/health.png" alt="." width="12" height="12"> У тебя: <span><?= $player['health'] ?></span>
                <span class="minor">(<span><?= $player['vitality'] ?></span> здоровья)</span>
            </div>
        <?php endif; ?>

        <?php if ($statId === 1): ?>
            <div class="pb">
                <div class="pb">
                    <b>Сила</b> отвечает за тяжесть повреждений, наносимых обычными атаками и амулетами.<br>Базовый урон от удара после 4-секундной подготовки обычно равен значению Силы.<br>
                </div>
                <img src="/images/icons/strength.png" alt="." width="12" height="12"> У тебя: <span><?= $player['strength'] ?></span>
                <span class="minor">(удар ~<span><?= $player['damage'] ?></span>)</span>
            </div>
        <?php endif; ?>

        <?php if ($statId === 2): ?>
            <div class="pb">
                <div class="pb">
                    <b>Защита</b> снижает урон, получаемый от врагов.<br>Чем выше защита, тем меньше урона ты получаешь.<br>
                </div>
                <img src="/images/icons/armor.png" alt="." width="12" height="12"> У тебя: <span><?= $player['defense'] ?></span>
            </div>
        <?php endif; ?>

        <?php if ($statId === 3): ?>
            <div class="pb">
                <div class="pb">
                    <b>Критический урон</b> увеличивает шанс нанесения критического удара, который наносит удвоенный урон.<br>Критический урон рассчитывается как процент от общего урона.<br>
                </div>
                <img src="/images/icons/crit.png" alt="." width="12" height="12"> У тебя: <span><?= $critChance ?>%</span>
            </div>
        <?php endif; ?>

        <?php if ($statId === 4): ?>
            <div class="pb">
                <div class="pb">
                    <b>Опыт</b> показывает, сколько опыта ты набрал для повышения уровня.<br>Опыт можно получить, выполняя квесты и побеждая врагов.<br>
                </div>
                <img src="/images/icons/experience_stroke.png" alt="." width="12" height="12"> У тебя: <span><?= $player['exp'] ?></span>
            </div>
        <?php endif; ?>

    </div>



