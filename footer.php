<!-- ======= Footer ======= -->
  <footer id="footer" class="footer fixed-bottom bg-white opacity-75" style="height: 20px;">
    <div class="copyright" style="margin-top: -8px;">
      &copy; Copyright <strong><span>CEADIS - Portal Pesquisas - <?php echo date('Y');?></span></strong>
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- TECLAS DE ATALHOS -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


  <script type="text/javascript">
    $(document).bind('keypress', function(event) {

      if( event.which === 67 && event.shiftKey ) {
        location.replace("./unidades.php");
        //Pressione a tecla Shift + C para abrir a tela de Clientes
      }

      if( event.which === 78 && event.shiftKey ) {
        location.replace("./notificacao.php");
      }
        //Pressione a tecla Shift + N para abrir a tela de Notificação de Pesquisas

      if( event.which === 80 && event.shiftKey ) {
        location.replace("./painel.php");
      }
        //Pressione a tecla Shift + P para abrir a tela de Painel

      if( event.which === 85 && event.shiftKey ) {
        location.replace("./usuarios.php");
      }
        //Pressione a tecla Shift + U para abrir a tela de Usuários

      if( event.which === 77 && event.shiftKey ) {
        location.replace("./perfil-usuario.php");
      }
        //Pressione a tecla Shift + M para abrir a tela de Meu Perfil

      if( event.which === 75 && event.shiftKey ) {
        location.replace("./senhas-divergentes.php");
      }
        //Pressione a tecla Shift + Y para abrir a tela de Meu Perfil

      });
  </script>

  <!-- TECLAS DE ATALHOS -->

</body>

</html>

