<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

$colorsGraph = [
        '#4e73df',
        '#4edf95',
        '#cff114',
        '#28a745',
        '#17a2b8',
        '#dc3545',
        '#FF4500',
        '#006400',
        '#7FFFD4',
        '#4169E1',
        '#EE82EE',
];
?>
<?= $this->Html->css('painel.css') ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Vendas Delivery (Este Mês)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$<?= $lucroMensalDelivery ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Vendas Comandas (Este Mês)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$<?= $lucroMensalComandas ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Novos Pedidos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pedidos ?></:></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hamburger fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Novas Mensagens
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mensagens?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Produtos Mais Vendidos Este Mês</h6>
                </div>
                <div class="card-body">
                    <div id="grafico_produtos" class="chart-area chart-pie">

                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Vendas Dia Da Semana Deste Mês</h6>
                </div>
                <div class="card-body">
                    <div id="grafico_semana" class="chart-area chart-pie">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChartProdutos);


    function drawChartProdutos() {
        var data = google.visualization.arrayToDataTable([
            ["Produto", "Quantidade Vendidos", { role: "style" } ],
            <?php
            foreach ($produtos as $key => $produto){
            ?>
            ["Produto # <?php echo $produto['nome']?>", <?php echo $produto['quantidade']?> , "<?php echo $colorsGraph[$key]?>"],
            <?php
            }
            ?>
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" },
            2]);

        var options = {
            title: "",
            width: '50%',
            height: 'auto',
            bar: {groupWidth: "92%"},
            legend: { position: "none" },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("grafico_produtos"));
        chart.draw(view, options);
    }
</script>

<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChartUsers);
    function drawChartUsers() {
        var data = google.visualization.arrayToDataTable([
            ["Dias Semana", "Quantidade vendas efetuadas por dia da semana este mes", { role: "style" } ],
            <?php
            foreach ($vendasFormatadas as $key => $venda){
            ?>
            ["<?php echo $venda['dia_semana']?>", <?php echo $venda['vendas']?> , "<?php echo $colorsGraph[$key]?>"],
            <?php
            }
            ?>
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" },
            2]);

        var options = {
            title: "",
            width: '50%',
            height: 'auto',
            legend: { width: "auto" },
        };
        var chart = new google.visualization.PieChart(document.getElementById("grafico_semana"));
        chart.draw(view, options);
    }
</script>