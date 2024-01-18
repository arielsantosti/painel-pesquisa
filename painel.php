<?php  include_once 'header.php'; ?>

  <main id="main" class="main">

    <section class="section container-fluid">

    <span class="badge bg-secondary"><!--Meu ip: <?=$ip_usuario?> - <?php echo $ip_server[0];?>--></span>
          <div class="card" style="width:auto; height:900px;">
            
              <?php if($ip_usuario == '172.22.0.101'){?>
              
                <iframe src="https://ceadis.org.br/pesquisa/<?=$login?>" title="Dashboard - Painel" style="width:100%; height:100%;"></iframe>
              
                  <?php }else{ ?>
              
                    <iframe src="http://<?=$ip_server[0]?><?=$http_porta?>/pesquisa/<?=$login?>" title="Dashboard - Painel" style="width:100%; height:100%;"></iframe>
              
                      <?php } ?>
              
              </div>

    </section>

  </main><!-- End #main -->


  <?php include_once 'footer.php'; ?>