<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<div class="in-tab">
    <div ng-controller="DashboardController as controllerMetricas" router="fn_dasboard_indicador_performance" class="dashboard-fornecedor">
        <div class="panel panel-admin">
            <div class="panel-heading">Métricas - SLA
                <div style="float: right; margin-top: -4px;" class="form-inline">
                    <select style="color:#00b99b;"  ng-change="controllerMetricas.refresh()" ng-model="filtro.tipo" name="filtro" ng-options="value *1 as description for (value, description) in periodoList" class="form-control" convert-to-number></select>
                    <!--                        <ui-date style="color:#00b99b;" ng-blur="controllerMetricas.refresh()" ng-show="filtro.tipo == 0" ng-model="filtro.dataInicio"></ui-date>-->
                    <ui-date-time filter="true" only-date="true" style="color:#00b99b;" ng-change="controllerMetricas.refresh()" ng-blur="controllerMetricas.refresh()" ng-show="filtro.tipo == 0" ng-model="filtro.dataInicio"></ui-date-time>
                    <!--                        <ui-date style="color:#00b99b;" ng-blur="controllerMetricas.refresh()" ng-show="filtro.tipo == 0" ng-model="filtro.dataFim"></ui-date>-->
                    <ui-date-time filter="true" only-date="true" style="color:#00b99b;" ng-change="controllerMetricas.refresh()" ng-blur="controllerMetricas.refresh()" ng-show="filtro.tipo == 0" ng-model="filtro.dataFim"></ui-date-time>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <div class="dummy">
                                <span class="thumbnail">
                                    <div>Média Dias Faturamento</div>
                                    <span class="info">{{data.dias_faturado}}</span>
                                </span>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <div class="dummy">
                                <span class="thumbnail">
                                    <div>Média Dias Carregamento</div>
                                    <span class="info">{{data.dias_carregamento}}</span>
                                </span>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <div class="dummy">
                                <span class="thumbnail">
                                    <div>Média Dias Atrasados</div>
                                    <span class="info">{{data.media_dias_atrasados}}</span>
                                </span>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <div class="dummy">
                                <span class="thumbnail">
                                    <div>N° Pedidos Atrasados</div>
                                    <span class="info">{{data.quantidade_total_atrasados}}</span>
                                </span>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <div class="dummy">
                                <span class="thumbnail">
                                    <div>% Assistência</div>
                                    <span class="info">{{data.media_assistencia}}</span>
                                </span>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <div class="dummy">
                                <span class="thumbnail">
                                    <div>N° Pedidos</div>
                                    <span class="info">{{data.total_pedidos}}</span>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div ng-controller="DashboardController as controller" router="fn_dasboard_situacao_ordem_compra" class="dashboard-fornecedor">
        <div class="panel panel-admin">
            <div class="panel-heading">Performance dos Pedidos de Compra Fluxo de Venda Ordem</div>
            <div class="panel-body">
                <table class="table table-responsive table-condensed table-striped" >
                    <tr>
                        <td>&nbsp;</td>
                        <td style="text-align: center; font-size: 14px;" ng-repeat="label in labels">{{label}}</td>
                    </tr>
                    <tr ng-repeat="row in data">
                        <td ng-show="$index == 0" ng-class="colors[$index]">Situações Atual</td>
                        <td ng-show="$index == 1" ng-class="colors[$index]">Pedidos Atrasados</td>
                        <td ng-show="$index == 2" ng-class="colors[$index]">Performance (finalizados)</td>
                        <td  style="text-align: center;"
                             ng-repeat="value in row track by $index"
                             ng-class="colors[$parent.$index]"><span>{{value}}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div ng-controller="DashboardController as controller" router="fn_dasboard_produto_mais_vendidos" class="dashboard-fornecedor">
        <div class="panel panel-admin">
            <div class="panel-heading">Produtos mais vendidos
                <div style="float: right; margin-top: -4px;" class="form-inline">
                    <select  style="color:#00b99b;"  ng-change="controller.refresh()" ng-model="filtro.tipo" name="filtro" ng-options="value *1 as description for (value, description) in periodoList" class="form-control" convert-to-number></select>
                    <ui-date-time filter="true" only-date="true" style="color:#00b99b;" ng-change="controller.refresh()" ng-blur="controller.refresh()" ng-show="filtro.tipo == 0" ng-model="filtro.dataInicio"></ui-date-time>
                    <ui-date-time filter="true" only-date="true" style="color:#00b99b;" ng-change="controller.refresh()" ng-blur="controller.refresh()" ng-show="filtro.tipo == 0" ng-model="filtro.dataFim"></ui-date-time>
                </div>
            </div>
            <div class="panel-body">
                <div ng-show="data.length == 0" style="text-align: center;">Nenhum registro localizado</div>
                <table class="table table-responsive table-condensed table-striped table-bordered" >
                    <tr ng-repeat="row in data" ng-hide="$index > 4">
                        <td>
                            <div class="dashboard-mais-vendidos-numero">{{$index + 1}}</div>
                            <div class="dashboard-mais-vendidos-produto">
                                <span style="font-weight: bold;"><span style="color: #06c7a6; padding-right: 5px;">{{row.quantidade}} itens</span>{{row.valor|currency}}</span>
                                <div class="descricao-produto">{{row.modelo}} - {{row.produto}}</div>
                            </div>
                        </td>
                        <td ng-show="data[$index + 5].quantidade >= 0">
                            <div class="dashboard-mais-vendidos-numero">{{$index + 6}}</div>
                            <div class="dashboard-mais-vendidos-produto">
                                <span style="font-weight: bold;"><span style="color: #06c7a6; padding-right: 5px;">{{data[$index + 5].quantidade}} itens</span>{{data[$index + 5].valor|currency}}</span>
                                <div class="descricao-produto">{{data[$index + 5].modelo}} - {{data[$index + 5].produto}}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div ng-controller="DashboardGraficoVendasController as controllerVendas" router="fn_dasboard_ordem_compra_periodo" class="dashboard-fornecedor" >
        <div class="panel panel-admin">
            <div class="panel-heading">Gráfico de Vendas
                <div style="float: right; margin-top: -4px;" class="form-inline">
                    <select style="color:#00b99b;"  ng-change="controllerVendas.refresh()" ng-model="filtro.tipo" name="filtro" ng-options="value *1 as description for (value, description) in periodoList" class="form-control" convert-to-number></select>
                    <ui-date-time filter="true" only-date="true" style="color:#00b99b;" ng-change="controllerVendas.refresh()" ng-blur="controllerVendas.refresh()" ng-show="filtro.tipo == 0" ng-model="filtro.dataInicio"></ui-date-time>
                    <ui-date-time filter="true" only-date="true" style="color:#00b99b;" ng-change="controllerVendas.refresh()" ng-blur="controllerVendas.refresh()" ng-show="filtro.tipo == 0" ng-model="filtro.dataFim"></ui-date-time>
                </div>
            </div>
            <div class="panel-body">
                <div id="render_chart_grafico_vendas" style="height: 350px;"></div>
            </div>
        </div>
    </div>
</div>
