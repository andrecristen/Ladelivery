var app = angular.module('web-app', []);
app.directive('uiGridForm', function($templateCache) {
        var template_for = function(attrs) {
            var temp = $templateCache.get( attrs.ngModel + '.html');
            if(!temp){
                console.log('Não localizado template para '+attrs.ngModel + '.html');
            }

            temp = temp.replace(/ng-model="(.*?)"/g,function(name, ngModel){
                    var models = ngModel.split('.');
                    var newModelMapping = 'data.'  + attrs.ngModel + "[$index]";
                    angular.forEach(models, function(model){
                        newModelMapping += "['"+model+"']";
                    });
                    var retorno = 'ng-model="'+newModelMapping+'"';
                    return retorno;
                }
            );

            temp = temp.replace(/ng-bind="(.*?)"/g,function(name, ngModel){
                    var models = ngModel.split('.');
                    var newModelMapping = 'data.'  + attrs.ngModel + "[$index]";
                    angular.forEach(models, function(model){
                        newModelMapping += "['"+model+"']";
                    });
                    var retorno = 'ng-bind="'+newModelMapping+'"';
                    return retorno;
                }
            );

            temp = temp.replace(/name="(.*?)"/g,function(name, nameField){
                var retorno = 'name="'+attrs.ngModel+'[{{$index}}]['+nameField+']"';
                return retorno;
            });

            temp = temp.replace(/for="(.*?)"/g, function(name, nameFor){
                var retorno = 'for="'+attrs.ngModel+'-'+nameFor+'-{{$index}}"';
                return retorno;
            });

            var template =
                '<div class="panel panel-default ui-grid-form">' +
                '  <div class="panel-heading" ng-show="title"><strong>&nbsp;{{title}}</strong></div>'+
                '  <div class="panel-body">'+
                '    <div ng-repeat="row in rows track by $index" class="ui-grid-form-item">'+
                '    <div class="form-grid">'+
                temp +
                '    </div>'+
                '    <div class="panel-actions if-not-readonly buttons-grid-right" ng-show="!(hide_button)">'+
                '      <button type="button" ng-click="remove($index)" class="btn btn-sm btn-remove-row" style="margin-left:3px; font-size: 10px;"><i class="fa fa-minus" aria-hidden="true"></i></button>'+
                '      <button type="button" ng-click="add()" class="btn btn-sm btn-add-row" style="margin-left:-2px; font-size: 10px;"><i class="fa fa-plus" aria-hidden="true"></i></button>'+
                '    </div>'+
                '  </div>'+
                '</div>'+
                '</div>';
            return template;
        };

        return {
            replace: true,
            restrict: 'E',
            require: ['ngModel'],
            transclude: false,
            list: '=',
            template: function(element, attrs){
                return template_for(attrs);
            },
            //templateUrl: '../../../view/ui-grid-form-template.html?v=0',
            link: function(scope, element, attrs, ctrl, transclude) {
                scope.title = attrs.title || false;
                if(attrs.hideButtons == 'false'){
                    attrs.hideButtons = false;
                }
                scope.hide_button = attrs.hideButtons || false;

                scope.rows = attrs.rows   || 1;
                var modelName = attrs.ngModel;
                scope.ngModelParent = modelName;
                scope.rows = [];
                if(!scope.data){
                    scope.data = {};
                }
                if(!scope['data'][modelName]){
                    scope['data'][modelName] = [];
                }
                scope.add = function(){
                    scope.rows.push(1);
                    refreshSelects();
                };

                scope.getFormName = function(){
                    angular.forEach(scope.$parent.$parent.$parent, function (value, index) {
                        if(value != null){
                            if(value.$submitted != undefined){
                                scope.formName = index;
                                return;
                            }
                        }
                    })
                };

                scope.remove = function(row){
                    //Exclui da view a linha
                    scope.rows.splice(row, 1);
                    //Exclui do data a linha
                    delete scope['data'][modelName][row];
                    //Vamos refatorar as posicoes;
                    var position = 0;
                    var reindex = [];
                    angular.forEach(scope['data'][modelName], function (value, row) {
                        reindex[position] = value;
                        position++;
                    });
                    scope['data'][modelName] = [];
                    scope['data'][modelName] = reindex;
                    //se foi removido tudo, adicionado uma linha
                    if(scope.rows.length === 0){
                        setTimeout(function(){
                            scope['data'][modelName] = [];
                            scope.rows.push(1);
                            scope.$apply();
                        },0);
                    }
                    refreshSelects();
                };

                function refreshSelects() {
                    setTimeout(function () {
                        allSelectSearch();
                        $('select').selectpicker('refresh');
                    },100);
                }

                if(attrs.list !== undefined){
                    var list = $.extend({},JSON.parse(attrs.list));
                    scope.data[modelName] = Object.values(list);
                }

                var adicionados = 0;
                angular.forEach(scope['data'][modelName], function (value, row) {
                    adicionados++;
                    scope.add();
                });
                if(adicionados === 0){
                    scope.add();
                }
            }
        }
    });