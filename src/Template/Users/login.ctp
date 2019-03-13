<?php
/**
 * @var \App\View\AppView $this
 */

?>
<div class="col-sm-12">
    <?= $this->Html->css('login.css') ?>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
               <?php echo $this->Html->image('empresa/logologin', ['width' => '50%']) ?>
            </div>

            <!-- Login Form -->
            <?= $this->Form->create() ?>
            <?php
                echo $this->Form->control('login', ['label'=>'', 'class'=>"fadeIn second", 'placeholder'=>'E-mail']);
                echo $this->Form->control('password', ['label'=>'', 'class'=>"fadeIn second", 'placeholder'=>'Senha']);
            ?>
            <?= $this->Form->button(__('Entrar')) ?>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <span>Ainda não possui conta?&nbsp;<?= $this->Html->link(__('Registrar-se'), ['controller' => 'Users', 'action' => 'registrar']) ?></span>
                <br/>
                <span>Esqueceu sua senha?&nbsp;<?= $this->Html->link(__('Recuperar'), ['controller' => 'AlteracaoSenhas', 'action' => 'solicitar']) ?></span>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>`