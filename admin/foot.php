</div>
</section>
</div>

<footer class="main-footer">
  <strong>Copyright &copy; 2024 <a href="">GTH</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 4.0
  </div>
</footer>
</div>

<script>
  $(document).ready(function() {
    $('.Manhdev-dataTable').DataTable();
  });

</script>
<!-- <script src="<?= BASE_URL("admin/plugins/jquery/jquery.min.js"); ?>"></script> -->
<script src="<?= BASE_URL("admin/plugins/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
<script src="<?= BASE_URL("admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"); ?>"></script>
<script src="<?= BASE_URL("admin/dist/js/adminlte.js"); ?>"></script>
<script src="<?= BASE_URL("admin/plugins/summernote/summernote-bs4.min.js"); ?>"></script>
<script src="<?= BASE_URL("admin/plugins/codemirror/codemirror.jss"); ?>"></script>
<script src="<?= BASE_URL("admin/plugins/jquery-mousewheel/jquery.mousewheel.js"); ?>"></script>
<script src="<?= BASE_URL("admin/plugins/raphael/raphael.min.js"); ?>"></script>
<script src="<?= BASE_URL("admin/plugins/jquery-mapael/jquery.mapael.min.js"); ?>"></script>
<script src="<?= BASE_URL("admin/plugins/jquery-mapael/maps/usa_states.min.js"); ?>"></script>
<script src="<?= BASE_URL("admin/plugins/chart.js/Chart.min.js"); ?>"></script>
<script src="<?= BASE_URL("admin/dist/js/pages/dashboard2.js"); ?>"></script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    $('.summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
<script src="<?=BASE_URL("js/ManhDev.js?".time());?>"></script>
</body>
</html>