<div class="box day{{$position}}">
        <div class="day-view">
            <p>{{$title}}</p>
            <?php if (count($weeks)) : ?>
                <?php foreach ($weeks as $week) : ?>
                    <div class="punch-view">
                        <span class="clr-green"><?php echo ucfirst($week->discipline) ?></span>
                        <br>
                        <span><?php echo "Período: $week->classes" ?></span>
                        <br>
                        <span style="font-size: .90em;">
                            <?php
                            echo "professor(a) $week->name é o $week->status da disciplina ";
                            ?>
                        </span>

                    </div>
                <?php endforeach ?>
            <?php else : ?>
                <div class="punch-view">
                    Esta semana não possui nenhuma aula marcada
                </div>
            <?php endif ?>
        </div>
    </div>