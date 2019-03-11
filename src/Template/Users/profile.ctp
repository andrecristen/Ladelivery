<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-4"><!--left col-->
            <div class="text-center">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="/" class="pull-left btn btn-danger"><i class="fas fa-home"></i> Início</a>
                    <a href="/pedidos/meus-pedidos/<?= $_SESSION['Auth']['User']['id'] ?>" class="btn btn-success"><i class="fas fa-cart-arrow-down"></i> Pedidos</a>
                    <a href="/enderecos/meus-enderecos/<?= $_SESSION['Auth']['User']['id'] ?>" class="btn btn-primary"><i class="fas fa-map-marked-alt"></i> Endereços</a>
                </div>
            </div>
            </hr>
            <br>
        </div>
        <div class="col-sm-8">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Pessoa') ?></legend>
                <?php
                echo $this->Form->control('nome_completo');
                echo $this->Form->control('apelido');
                ?>
            </fieldset>
            <fieldset>
                <legend>Login</legend>
                <?php
                echo $this->Form->control('login', ['type' => 'email']);
                echo $this->Form->control('password', ['label' => 'Senha']);
                echo $this->Form->control('confirm_password', ['label' => 'Confirmar Senha', 'type' => 'password', 'required' => 'required']);
                ?>
            </fieldset>
            <fieldset>
                <legend>Nascimento</legend>
                <?php
                echo $this->Form->control('dia_nascimento', ['label' => 'Dia']);
                echo $this->Form->control('mes_nascimento', ['label' => 'Mês']);
                echo $this->Form->control('ano_nascimento', ['label' => 'Ano']);
                ?>
            </fieldset>
            <button class="btn btn-lg btn-success pull-right" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Salvar</button>
            <br/>
            <br/>
        </div>
    </div>
</div>
</div>
