<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$siteUtils = new \App\Model\Utils\SiteUtils();
$dataAtual = new \DateTime();
$siteUtils->menuSite();
?>
<div style="margin-top: 67px;" class="container bootstrap snippet">
    <div style="margin: 0px!important;" class="row">
        <div class="col-sm-4"><!--left col-->
            <div class="text-center">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                <div class="btn-group-top">
                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-cart-arrow-down')).' Meus Pedidos', array('controller' => 'pedidos', 'action' => 'meusPedidos'), array('escape' => false , 'class' => 'btn btn-success')) ?>
                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-map-marked-alt')).' Endereços', array('controller' => 'enderecos', 'action' => 'meusEnderecos'), array('escape' => false , 'class' => 'btn btn-primary')) ?>
                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-phone')).' Contatos', array('controller' => 'usersContatos', 'action' => 'meusContatos'), array('escape' => false , 'class' => 'btn btn-danger')) ?>
                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-key')).' Senha', array('controller' => 'users', 'action' => 'alterarSenha'), array('escape' => false , 'class' => 'btn btn-dark', 'style' => 'color: #fff')) ?>
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
                echo $this->Form->control('nome_completo', ['type' => 'text']);
                echo $this->Form->control('apelido');
                ?>
            </fieldset>
            <fieldset>
                <legend>Login</legend>
                <?php
                echo $this->Form->control('login', ['type' => 'email']);
                ?>
            </fieldset>
            <fieldset>
                <legend>Nascimento</legend>
                <?php
                echo $this->Form->control('dia_nascimento', ['label' => 'Dia', 'min' => 1 , 'max' => 31]);
                echo $this->Form->control('mes_nascimento', ['label' => 'Mês', 'min' => 1 , 'max' => 12]);
                echo $this->Form->control('ano_nascimento', ['label' => 'Ano', 'min' => 1900 , 'max' => $dataAtual->format('Y')]);
                ?>
            </fieldset>
            <button class="btn btn-lg btn-success pull-right" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Salvar</button>
            <br/>
            <br/>
        </div>
    </div>
</div>
<style>
    .btn-group-top{
        display: grid;
    }
    .btn-group-top .btn{
       margin: 2px;
    }
</style>
</div>
