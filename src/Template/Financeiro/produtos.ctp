<?php
?>
<div class="col-sm-12">
    <div class="alert alert-info">
        <span>Listagem referentes a dados deste mês.</span>
    </div>
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a data-toggle="collapse" href="#produtos">Produtos <i class="fas fa-arrow-circle-down"></i></a>
                </h6>
            </div>
            <div id="produtos" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php
                    $posicao = 1;
                    if($produtos){
                        foreach ($produtos as $produto){ ?>
                            <b><?= $posicao?> º</b> <span><?= $produto['nome']?> - Vendidos: <?= $produto['quantidade']?></span>
                            <br/>
                            <?php
                            $posicao++;
                        }
                    }else{
                        echo '<span>Sem dados para o período</span>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a data-toggle="collapse" href="#categorias">Categorias <i class="fas fa-arrow-circle-down"></i></a>
                </h6>
            </div>
            <div id="categorias" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php
                    $posicao = 1;
                    if($categorias){
                        foreach ($categorias as $categoria){ ?>
                            <b><?= $posicao?> º</b> <span><?= $categoria['nome_categoria']?> - Vendidos: <?= $categoria['total']?></span>
                            <br/>
                            <?php
                            $posicao++;
                        }
                    }else{
                        echo '<span>Sem dados para o período</span>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a data-toggle="collapse" href="#zonas">Entregas <i class="fas fa-arrow-circle-down"></i></a>
                </h6>
            </div>
            <div id="zonas" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php
                    if($entregas){?>
                        <span>Sua empresa realizou este mês um total de: <strong><?= intval($entregas['realizadas']) ?> entregas</strong>, com um preço médio de <strong>R$ <?= floatval($entregas['media']) ?></strong></span>
                        <br>
                        <span>A entrega mais cara foi no valor de <strong>R$ <?= floatval($entregas['cara']) ?></strong>, já a mais barata foi no valor de <strong>R$: <?= floatval($entregas['barata']) ?></strong></span>
                       <?php
                    }else{
                        echo '<span>Sem dados para o período</span>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
