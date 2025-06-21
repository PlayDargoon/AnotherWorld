<!-- templates/pages/profile.html.php -->
<body id="body_id" ignorewebview="true">

    <div class="body">
        <div class="small">
            <h1><span>Игра "Иной Мир" - Нет достижения (в разработке), <?= $player['char_name'] ?></span></h1>
        </div>
        <div class="small">
            <span><?= $player['side'] === 'Light' ? 'Светлая' : 'Тёмная' ?> сторона</span>
            <span><?= $player['class'] === 'Warrior' ? 'Воин' : ($player['class'] === 'Monk' ? 'Монах' : 'Маг') ?></span>,
            <span><?= $player['level'] ?></span> ур.
            <img src="/images/icons/sex_<?= $player['gender'] === 'Male' ? 'male' : 'female' ?>.png" alt="<?= $player['gender'] === 'Male' ? 'муж.' : 'жен.' ?>" width="12" height="12">
        </div>

        <h2>Ваш профиль</h2>
        <div style="text-align:center;" class="p2">
            <img src="/images/maneken/<?= $player['side'] ?>_<?= $player['class'] ?>_<?= $player['gender'] ?>.jpg" width="320" height="190">


        </div>

        <div class="pb pt">
            <h2><a href="#">Характеристики</a></h2>
            <div>
                <ol class="mt3">
                    <li><img src="/images/icons/health.png" alt="." width="12" height="12" class="link-icon"><span class="minor">Здоровье:</span> <span> <?= $player['health'] ?></span> (<span><?= $player['vitality'] ?></span> живучести)</li>
                    <li><img src="/images/icons/strength.png" alt="." width="12" height="12" class="link-icon"><span class="minor">Сила:</span> <span><?= $player['strength'] ?></span> (удар ~<span><?= $player['damage'] ?></span>)</li>
                    <li>
                        <img src="/images/icons/crit.png" alt="." width="12" height="12" class="link-icon"><span class="minor">Крит:</span>
                        <span>52.9%</span> <span class="minor">(удар ~<span><?= $critChance ?></span>)</span>
                    </li>
                    <li><img src="/images/icons/armor.png" alt="." width="12" height="12" class="link-icon"><span class="minor">Защита:</span> <span><?= $player['defense'] ?></span> (<span>95,23%, мин: <img src="/images/icons/absolute_def_12.png" alt="a" width="12" height="12"> 2,53%</span>)</li>
                    <li><img src="/images/icons/xswords.png" alt="." width="12" height="12" class="link-icon"><span class="minor">Сумма характеристик:</span> <span>34669</span></li>
                    <span class="minor">(без учета бонусов)</span><br>

                    <li>
                        <img src="/images/icons/experience_stroke.png" alt="" class="link-icon"><span class="minor">Опыт:</span> <?= $player['exp'] ?>
                    </li>


                </ol>


            </div>


            <div class="pt">
                <div class="pt">

                    <div>
                        <img src="/images/icons/clock.png" alt="."> <span>Игровое время: <?= $gameTime ?></span>
                    </div>
                    <div>
                        <span><?= $status ?>, </span>
                    </div>
                    <div>
                        <span class="minor"><?= $registrationDate ?></span>
                    </div>

                </div>
                <div class="pt">


                    <div class="pt small minor"><img src="/images/icons/game_master.png" alt="." width="12" height="12"> ID персонажа: <span><?= $characterId ?></span></div>
                </div>




        </div>


        <!-- Кнопка выхода -->
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <a href="/logout" class="logout-button">Выйти</a>
        <?php endif; ?>

    </div>

    </div>




