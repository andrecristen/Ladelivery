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
                            <b><?= $posicao?> º</b> <span><?= $categoria['nome']?> - Vendidos: <?= $categoria['quantidade']?></span>
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
                    <a data-toggle="collapse" href="#zonas">Zonas de Venda <i class="fas fa-arrow-circle-down"></i></a>
                </h6>
            </div>
            <div id="zonas" class="panel-collapse collapse">
                <div class="panel-body">Panel Body</div>
                <div class="panel-footer">Panel Footer</div>
            </div>
        </div>
    </div>
</div>
