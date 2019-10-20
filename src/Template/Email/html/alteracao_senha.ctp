<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

?>
<table style="width:100%;border-spacing:0;border-collapse:collapse;vertical-align:top;text-align:inherit;margin:0 auto;padding:0">
    <tbody>
    <tr>
        <td style="padding:20px;color:#555;line-height:25px;font-size:16px">
            <p>
                <center>
                Olá <b><?= $userName?></b>,
                <br>
                <br>
                <span>Recebemos uma solicitação de alteração de senha para sua conta no sistema LaDelivery</span>
                <br>
                <br>
                </center>
            </p>
            <center>
                <a href="<?= \App\Model\Utils\EmpresaUtils::LINK_SITE?>/alteracao-senhas/novaSenha/<?= $token?>" style="padding:10px;display:block;border-radius:6px;background:#1e9ed0;color:#fff;text-decoration:none;font-size:24px; width: 285px;" target="_blank">ALTERAR MINHA <span class="m_9139932422997049828il">SENHA</span></a>
            </center>
            <br>
            <br>
            <br>
            <br>
            <center>
                <span>Se você não solicitou está alteração recomendamos alterar a senha da sua conta LaDelivery e também sua senha da conta de e-mail</span>.
            </center>
            <br>
            <br>
            <br>
        </td>
    </tr>
    </tbody>
</table>
<center>
    <h2>Atenciosamente equipe LaDelivery</h2>
    <span style="padding:20px;color:#555;line-height:25px;font-size:16px">Não responda este e-mail</span>
</center>
