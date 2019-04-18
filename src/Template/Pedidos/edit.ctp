<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<w3-test-directive></w3-test-directive>

<script>
    var app = angular.module("myApp", []);
    app.directive("w3TestDirective", function() {
        return {
            template : "<h1>Made by a directive!</h1>"
        };
    });
</script>
