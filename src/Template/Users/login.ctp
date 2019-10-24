<?php
/**
 * @var \App\View\AppView $this
 */

?>
<div class="col-sm-12">
    <?= $this->Html->css('login.css') ?>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Icon -->
            <div style="padding: 15px" class="fadeIn first">
               <?php echo $this->Html->image(\App\Model\Utils\EmpresaUtils::IMAGE_LOGIN_PATH, ['width' => '50%']) ?>
            </div>

            <!-- Login Form -->
            <?= $this->Form->create() ?>
            <?php
                echo $this->Form->control('redirectUrl', ['label'=>'', 'value' => $redirectUrl, 'style' => 'display: none;']);
                echo $this->Form->control('login', ['label'=>'', 'class'=>"fadeIn second", 'placeholder'=>'E-mail']);
                echo $this->Form->control('password', ['label'=>'', 'class'=>"fadeIn second", 'placeholder'=>'Senha']);
            ?>
            <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-home')).' Cancelar', $this->request->referer(), array('escape' => false , 'class' => 'btn btn-sm btn-danger')) ?>
            <?= $this->Form->button($this->Html->tag('i', '', array('class' => 'fas fa-sign-in-alt')).' Entrar', ['class' => 'btn btn-sm btn-primary']) ?>
            <br/>
            <!-- Acoes -->
            <div id="formFooter">
                <span>Ainda não possui conta?&nbsp;<?= $this->Html->link(__('Registrar-se'), ['controller' => 'Users', 'action' => 'registrar']) ?></span>
                <br/>
                <span>Esqueceu sua senha?&nbsp;<?= $this->Html->link(__('Recuperar'), ['controller' => 'AlteracaoSenhas', 'action' => 'solicitar']) ?></span>
                <br/>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>`