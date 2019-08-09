<?php
$colorsGraph = \App\Model\Utils\SiteUtils::getColorGraphs();
?>
<?= $this->Html->css('painel.css') ?>
<?= $this->Html->script('graph.js') ?>
<?= $this->Form->create(false) ?>
<div class="col-sm-12">
    <div class="alert alert-info">
        <span>Utilize a opções de ano e mês para visualizar dados de outros períodos.</span>
    </div>
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="col-sm-9">
                    <h6 class="m-0 font-weight-bold text-primary">Vendas este ano</h6>
                </div>
                <div class="col-sm-2">
                    <?= $this->Form->select('ano_vendas', \App\Model\Utils\SiteUtils::getAnoList(), ['value' => $anoVendas, 'class' => 'select-operador']); ?>
                </div>
                <div class="col-sm-1">
                    <?= $this->Form->button($this->Html->tag('i', '', array('class' => 'fas fa-sync-alt')) . '', ['class' => 'btn btn-sm btn-info', 'style' => 'margin-right: 3px;']); ?>
                </div>
            </div>
            <div class="card-body">
                <div id="grafico_vendas" class="chart-area chart-pie">

                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="col-sm-7">
                    <h6 class="m-0 font-weight-bold text-primary">Produtos Mais Vendidos</h6>
                </div>
                <div class="col-sm-2">
                    <?= $this->Form->select('mes_produtos', \App\Model\Utils\SiteUtils::getMesList(), ['value' => $mesProduto, 'class' => 'select-operador']); ?>
                </div>
                <div class="col-sm-2">
                    <?= $this->Form->select('ano_produtos', \App\Model\Utils\SiteUtils::getAnoList(), ['value' => $anoProduto, 'class' => 'select-operador']); ?>
                </div>
                <div class="col-sm-1">
                    <?= $this->Form->button($this->Html->tag('i', '', array('class' => 'fas fa-sync-alt')) . '', ['class' => 'btn btn-sm btn-info', 'style' => 'margin-right: 3px;']); ?>
                </div>
            </div>
            <div class="card-body">
                <?php
                $posicao = 1;
                if ($produtos) {
                    foreach ($produtos as $produto) { ?>
                        <b><?= $posicao ?> º</b>
                        <span><?= $produto['nome'] ?> - Vendidos: <?= $produto['quantidade'] ?></span>
                        <br/>
                        <?php
                        $posicao++;
                    }
                    ?>
                    <div id="grafico_produtos" class="chart-area chart-pie">

                    </div>
                    <?php
                } else {
                    echo '<div class="sem-registros">';
                    echo '<span>Sem dados para o período</span>';
                    echo '</div>';
                } ?>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="col-sm-7">
                    <h6 class="m-0 font-weight-bold text-primary">Categorias Mais Vendidas</h6>
                </div>
                <div class="col-sm-2">
                    <?= $this->Form->select('mes_categorias', \App\Model\Utils\SiteUtils::getMesList(), ['value' => $mesCategoria, 'class' => 'select-operador']); ?>
                </div>
                <div class="col-sm-2">
                    <?= $this->Form->select('ano_categorias', \App\Model\Utils\SiteUtils::getAnoList(), ['value' => $anoCategoria, 'class' => 'select-operador']); ?>
                </div>
                <div class="col-sm-1">
                    <?= $this->Form->button($this->Html->tag('i', '', array('class' => 'fas fa-sync-alt')) . '', ['class' => 'btn btn-sm btn-info', 'style' => 'margin-right: 3px;']); ?>
                </div>
            </div>
            <div class="card-body">
                <?php
                $posicao = 1;
                if ($categorias) {
                    foreach ($categorias as $categoria) { ?>
                        <b><?= $posicao ?> º</b>
                        <span><?= $categoria['nome_categoria'] ?> - Vendidos: <?= $categoria['total'] ?></span>
                        <br/>
                        <?php
                        $posicao++;
                    }
                    ?>
                    <div id="grafico_categorias" class="chart-area chart-pie">

                    </div>
                    <?php
                } else {
                    echo '<div class="sem-registros">';
                    echo '<span>Sem dados para o período</span>';
                    echo '</div>';
                } ?>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="col-sm-7">
                    <h6 class="m-0 font-weight-bold text-primary">Entregas</h6>
                </div>
                <div class="col-sm-2">
                    <?= $this->Form->select('mes_entregas', \App\Model\Utils\SiteUtils::getMesList(), ['value' => $mesEntregas, 'class' => 'select-operador']); ?>
                </div>
                <div class="col-sm-2">
                    <?= $this->Form->select('ano_entregas', \App\Model\Utils\SiteUtils::getAnoList(), ['value' => $anoEntregas, 'class' => 'select-operador']); ?>
                </div>
                <div class="col-sm-1">
                    <?= $this->Form->button($this->Html->tag('i', '', array('class' => 'fas fa-sync-alt')) . '', ['class' => 'btn btn-sm btn-info', 'style' => 'margin-right: 3px;']); ?>
                </div>
            </div>
            <div class="card-body">
                <?php
                if ($entregas) {
                    ?>
                    <span>Sua empresa realizou este mês um total de: <strong><?= intval($entregas['realizadas']) ?> entregas</strong>, com um preço médio de <strong>R$ <?= floatval($entregas['media']) ?></strong></span>
                    <br>
                    <span>A entrega mais cara foi no valor de <strong>R$ <?= floatval($entregas['cara']) ?></strong>, já a mais barata foi no valor de <strong>R$: <?= floatval($entregas['barata']) ?></strong></span>
                    <?php
                } else {
                    echo '<div class="sem-registros">';
                    echo '<span>Sem dados para o período</span>';
                    echo '</div>';
                } ?>
            </div>
        </div>
    </div>
</div>
<style>
    .col-sm-2 {
        padding: 1px;
    }

    .col-sm-1 {
        padding: 5px;
    }

    .sem-registros {
        text-align: center !important;
    }
</style>
<?= $this->Form->end() ?>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['line']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Mês');
        data.addColumn('number', 'Valor');

        data.addRows([
            <?php foreach ($meses as $mes){ ?>
            [<?php echo $mes['mes'] ?>, <?php echo $mes['valor'] ?>],
            <?php } ?>
        ]);

        var options = {
            legend: {position: "none"}
        };

        var chart = new google.charts.Line(document.getElementById('grafico_vendas'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }
</script>
<script type="text/javascript">
    google.charts.load("current", {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChartProdutos);


    function drawChartProdutos() {
        var data = google.visualization.arrayToDataTable([
            ["Produto", "Quantidade Vendidos", {role: "style"}],
            <?php
            foreach ($produtos as $key => $produto){
            ?>
            ["<?php echo $produto['nome']?>", <?php echo $produto['quantidade']?> , "<?php echo $colorsGraph[$key]?>"],
            <?php
            }
            ?>
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2]);

        var options = {
            title: "",
            width: '50%',
            height: 'auto',
            bar: {groupWidth: "92%"},
            legend: {position: "none"},
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("grafico_produtos"));
        chart.draw(view, options);
    }
</script>
<script type="text/javascript">
    google.charts.load("current", {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChartCategorias);


    function drawChartCategorias() {
        var data = google.visualization.arrayToDataTable([
            ["Categoria", "Quantidade Vendidos", {role: "style"}],
            <?php
            foreach ($categorias as $key => $categoria){
            ?>
            ["<?php echo $categoria['nome_categoria']?>", <?php echo $categoria['total']?> , "<?php echo $colorsGraph[$key]?>"],
            <?php
            }
            ?>
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2]);

        var options = {
            title: "",
            width: '50%',
            height: 'auto',
            bar: {groupWidth: "92%"},
            legend: {position: "none"},
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("grafico_categorias"));
        chart.draw(view, options);
    }
</script>