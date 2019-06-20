<?php
$cacheControl = new \App\Model\Utils\CacheControl();
$cacheVersion = $cacheControl->getCacheVersion();
echo $this->Html->css('kanban.css'.$cacheVersion);
echo $this->Html->script('kanban-produto.js'.$cacheVersion);
?>
<div class="col-sm-12">
    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-primary kanban-col">
                <div class="panel-heading">
                    Aguardando Produção
                </div>
                <div class="panel-body">
                    <div id="TODO" class="kanban-centered">
                        <article class="kanban-entry grab" id="item1" draggable="true">
                            <div class="kanban-entry-inner">
                                <div class="kanban-label">
                                    <h2><a href="#">Art Ramadani</a> <span>posted a status update</span></h2>
                                    <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary kanban-col">
                <div class="panel-heading">
                    Em Produção
                </div>
                <div class="panel-body">
                    <div id="DOING" class="kanban-centered">
                        <article class="kanban-entry grab" id="item5" draggable="true">
                            <div class="kanban-entry-inner">
                                <div class="kanban-label">
                                    <h2><a href="#">Art Ramadani</a> <span>posted a status update</span></h2>
                                    <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary kanban-col">
                <div class="panel-heading">
                    Produção Concluída
                </div>
                <div class="panel-body">
                    <div id="DONE" class="kanban-centered">
                        <article class="kanban-entry grab" id="item5" draggable="true">
                            <div class="kanban-entry-inner">
                                <div class="kanban-label">
                                    <h2><a href="#">Art Ramadani</a> <span>posted a status update</span></h2>
                                    <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-static fade" id="processing-modal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-refresh fa-5x fa-spin"></i>
                        <h4>Processando...</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
